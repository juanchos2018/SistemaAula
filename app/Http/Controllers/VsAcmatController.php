<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsEcmat;
use Maatwebsite\Excel\Excel;
use App\Http\Resources\VsActmatCollection;

class VsAcmatController extends Controller
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
		$this->USU_NO="1";
		$this->USU_ROL=5;
        switch($this->USU_ROL)
        {
            case 5:  // Docente		      
              
				$result =  VsEcmat::selectVsactmat($this->USU_NO);     
				$data   =  new VsActmatCollection($result->paginate(10));  			

                break;
          
            default:	
 
                 $result =  VsEcmat::selectVsactmat($this->USU_NO->paginate(10));    
                 $data   =  new VsActmatCollection($result);           
	           
                break;
        }
        return $data;
    } 
}
