<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsEcmat;
use Maatwebsite\Excel\Excel;
use App\Exports\VsActsavExport;


use App\Http\Resources\VsActsavCollection;

class VsActsavController extends Controller
{
    //

    public $USU_ROL;
    public $USU_NO;


    public function index($search){

        $this->USU_ROL =   session()->get('USU_ROL');
        $this->USU_NO  =   session()->get('USU_NO'); 

        $data=$this->records();
        
     
        return response()->json(['status' => 200,'result' => $data,'use_No'=> $this->USU_ROL]);   
    }

    function records(){

        $data=array();
		//$this->USU_NO="1";
		//$this->USU_ROL=5;
        switch($this->USU_ROL)
        {
            case 5:  // Docente		      
              
				$result=  VsEcmat::selectVsactsav($this->USU_NO);     
				$data   = new VsActsavCollection($result->paginate(10));  			

                break;
          
            default:	
 
                 $result=  VsEcmat::selectVsactsav($this->USU_NO->paginate(10));    
                 $data   = new VsActsavCollection($result);           
	           
                break;
        }
        return $data;
    } 

    public function exportExcel(){       
		$data = $this->dataExport();
        return (new VsActsavExport)->vsactsavs($data)->download('vsaactsavs.xlsx', Excel::XLSX);
     //   exit();
    }

    public function exportPdf(){    
		
		$data = $this->dataExport();
        return (new VsActsavExport)->vsactsavs($data)->download('vsaactsavs.pdf', Excel::DOMPDF);     
    }


    function dataExport(){

        $this->USU_ROL =   session()->get('USU_ROL');
        $this->USU_NO  =   session()->get('USU_NO'); 

        $data=array();

        switch($this->USU_ROL)
        {
            case 5:  // Docente		
              
                $data=VsEcmat::selectVsactsav($this->USU_NO)->get();           
                break;        

            default:					
                
              $data=VsEcmat::selectVsactsav($this->USU_NO)->get();
			 	
              break;
        }
        return $data;
    }  

}
