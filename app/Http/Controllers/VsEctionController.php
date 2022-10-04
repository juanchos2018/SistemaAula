<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\VsEcmat;
use App\Models\VsEmplox;

use App\Traits\SelecUser;

class VsEctionController extends Controller
{
    
    protected $USU_ROL;
    protected $USU_NO;

    use SelecUser;

     
    public function selectVsmatter()
    {    
    
      $this->USU_NO  =   $this->getSelecUser(); 
     
      $matter   = VsEcmat::selectVsmatter($this->USU_NO);
      $secction = VsEcmat::selectVsection($this->USU_NO);

   
      return response()->json(['status' => 200,'matter' => $matter,'secction' => $secction]);      
    }


    public function selectVsemplox()
    {    

      $this->USU_ROL =  $this->getSelecRol();
      $this->USU_NO  =  $this->getSelecUser();   
      switch($this->USU_ROL)
			{
				case 1:  // System Manager

          $data = VsEmplox::get();
					break;
				case 5:  // Docente

          $data = VsEmplox::where('EMP_NO',$this->USU_NO)->get();
					break;
				default:
          $data = VsEmplox::where('ESTATU',1)->get();
					break;
			}

   
      return response()->json(['status' => 200,'result' => $data]);      
    }

    public function oneVssecmat($SEC_ID){
      $arrData   = VsEcmat::where('SEC_ID',$SEC_ID)->first();
      if ($arrData) {
        
        return response()->json(['status' => 200,'result' => $arrData]);      
      }
      else{
        return response()->json(['status' => 400]);  
      }

    }



}
