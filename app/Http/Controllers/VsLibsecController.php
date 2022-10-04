<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\VsEcmat;
use App\Http\Resources\VsLibsecCollection;
use Illuminate\Support\Facades\DB;

class VsLibsecController extends Controller
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
		//$this->USU_ROL=5;
        switch($this->USU_ROL)
        {
            case 5:  // Docente		
      
              
				$result=  VsEcmat::selectVslibsec($this->USU_NO);        
				//$data=  VsEcmat::selectVslibsec($this->USU_NO)->paginate(15);        
                //$data=VsEcmat::where('EMP_NO',$this->USU_NO)->paginate(15);         
				$data   = new VsLibsecCollection($result);  			

                break;
          
            default:					
               
				 //$data=VsTudent::selectVslibsec($this->USU_NO)->paginate(15);        
                 $result=  VsEcmat::selectVslibsec($this->USU_NO);    
                 $data   = new VsLibsecCollection($result);           
				// $data   = new VsLibsecCollection($result->paginate(15));              
                break;
        }
        return $data;
    }  
}
