<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VsAbsent;
use App\Http\Resources\VsAbsentCollection;
use App\Exports\VsAbsentExport;

use Maatwebsite\Excel\Excel;


class VsAbsentController extends Controller
{
    //
    public $USU_ROL;
    public $USU_NO;

    public function index(Request $request){

        $this->USU_ROL =   $request->session()->get('USU_ROL');
        $this->USU_NO  =   $request->session()->get('USU_NO'); 

        $data=$this->records();
     
     
        return response()->json(['status' => 200,'result' => $data]);   
    }


    function records(){

        $data=array();
        $this->USU_NO="1";
        switch($this->USU_ROL)
        {
            case 1:  // System Manager				
                $data=array();              
                break;
            case 5:  // Docente				
                $result=VsAbsent::where('EMP_NO',$this->USU_NO);
                $data   = new VsAbsentCollection($result->paginate(10));
               // $data=VsAbsent::listAll($this->USU_NO);     
                break;
            default:				

                $result = VsAbsent::where('EMP_NO',$this->USU_NO);
                $data   = new VsAbsentCollection($result->paginate(10));  
                break;
        }
        return $data;
    }   

    public function exportExcel(){       
		$data = $this->dataExport();
        return (new VsAbsentExport)->vsabsents($data)->download('vsabsents.xlsx', Excel::XLSX);
     //   exit();
    }

    public function exportPdf(){    
		
		$data = $this->dataExport();
        return (new VsAbsentExport)->vsabsents($data)->download('vsabsents.pdf', Excel::DOMPDF);     
    }
    function dataExport(){

        $this->USU_ROL =   session()->get('USU_ROL');
        $this->USU_NO  =   session()->get('USU_NO'); 

        $data=array();

        switch($this->USU_ROL)
        {
            case 5:  // Docente		
              
                $data=VsAbsent::where('EMP_NO',$this->USU_NO)->get();
           //     $data=  VsTudent::students($this->USU_NO)->get(); 
                break;
            case 1: // Estudiante		
                
                $data=VsAbsent::where('EMP_NO',$this->USU_NO)->get();
                break;

            default:					
                
                 $data=VsAbsent::where('EMP_NO',$this->USU_NO)->get();    
				
                break;
        }
        return $data;
    }  

}
