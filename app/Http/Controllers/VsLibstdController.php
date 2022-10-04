<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\VStudentCollection;
use App\Models\VsTudent;


class VsLibstdController extends Controller
{
    //
    public $USU_ROL;
    public $USU_NO;

    public function index($search){

        $this->USU_ROL =   session()->get('USU_ROL');
        $this->USU_NO  =   session()->get('USU_NO'); 

        $data=$this->records();
        $total=1;
     
        return response()->json(['status' => 200,'result' => $data,'total'=>$total,'use_No'=> $this->USU_ROL]);   
    }

    function records(){

        $data=array();
		//$this->USU_NO="1";
        switch($this->USU_ROL)
        {
            case 5:  // Docente		
              
				$result=  VsTudent::students($this->USU_NO);        
				$data   = new VStudentCollection($result->paginate(15));  			

                break;
            case 7: // Estudiante		
     
				$data=VsTudent::students($this->USU_NO); 
                break;

             case 8:  // Representante			
 
				$data=VsTudent::students($this->USU_NO); 
                    break;
            default:					
               
				 $result=VsTudent::students($this->USU_NO);        
				 $data   = new VStudentCollection($result->paginate(15));              
                break;
        }
        return $data;
    }  

}
