<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\VsChedul;
use App\Models\VsDefault;

use App\Http\Resources\VsChedulCollection;
use App\Exports\VsChedulExport;
use Maatwebsite\Excel\Excel;


class VsChedulController extends Controller
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
        $default =VsDefault::first();
        switch($this->USU_ROL)
        {
            case 1:  // System Manager				
                $data=array();              
                break;
            case 5:  // Docente				
                $result=VsChedul::where('EMP_NO',$this->USU_NO)->where('PERIOS',$default->PERIOS);
                $data   = new VsChedulCollection($result->paginate(15));
         
                break;
            default:				

                $result = VsChedul::where('EMP_NO',$this->USU_NO);
                $data   = new VsChedulCollection($result->paginate(15));  
                break;
        }
        return $data;
    }   



    public function exportExcel(){       
		$data = $this->dataExport();
        return (new VsChedulExport)->vscheduls($data)->download('vscheduls.xlsx', Excel::XLSX);
     //   exit();
    }

    public function exportPdf(){    
		
		$data = $this->dataExport();
        return (new VsChedulExport)->vscheduls($data)->download('vscheduls.pdf', Excel::DOMPDF);     
    }
    function dataExport(){

        $this->USU_ROL =   session()->get('USU_ROL');
        $this->USU_NO  =   session()->get('USU_NO'); 

        $data=array();
        $default =VsDefault::first();
        switch($this->USU_ROL)
        {
            case 5:  // Docente		
              
                $data=VsChedul::where('EMP_NO',$this->USU_NO)->where('PERIOS',$default->PERIOS)->get();
           //     $data=  VsTudent::students($this->USU_NO)->get(); 
                break;
            case 1: // Estudiante		
                
                $data=VsChedul::where('EMP_NO',$this->USU_NO)->where('PERIOS',$default->PERIOS)->get();
                break;

            default:					
                
                $data=VsChedul::where('EMP_NO',$this->USU_NO)->where('PERIOS',$default->PERIOS)->get()   ;
				
                break;
        }
        return $data;
    }  

}
