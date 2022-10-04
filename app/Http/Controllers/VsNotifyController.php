<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsNotify;

use App\Http\Resources\VsNotifyCollection;



class VsNotifyController extends Controller
{
    //

    public $USU_ROL;
    public $USU_NO;

    public function index(){

        $this->USU_ROL =  session()->get('USU_ROL');
        $this->USU_NO  =  session()->get('USU_NO'); 

        $data=$this->records();
     
     
        return response()->json(['status' => 200,'result' => $data]);   
    }

    function records(){

        $data=array();
       
        switch($this->USU_ROL)
        {
            case 1:  // System Manager				
                $data=array();              
                break;
            case 5:  // Docente				
                $result=VsNotify::where('EMP_NO',$this->USU_NO);
                $data   = new VsNotifyCollection($result->paginate(10));               
                break;
            default:				

                $result = VsNotify::where('EMP_NO',$this->USU_NO);
                $data   = new VsNotifyCollection($result->paginate(10));  
                break;
        }
        return $data;
    }  
}
