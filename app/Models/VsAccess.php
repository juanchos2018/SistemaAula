<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \stdClass;

class VsAccess extends Model
{
    protected $table = "vsaccess";

    static  function login($USU_ID,$USU_PAS){            
       $result = new stdClass();     

        $exis=DB::table('vsaccess')->select('vsaccess.ALI_NO','vsaccess.USU_ROL','vsaccess.USU_NO')->where('vsaccess.USU_ID', $USU_ID)->first();

        if ($exis) {                
          $user = DB::table('vsaccess')         
          ->select('vsaccess.USU_ID','vsaccess.ALI_NO','vsaccess.USU_ROL','vsaccess.USU_NO','vsaccess.ESTADO')     
          ->where('vsaccess.USU_ID', $USU_ID)     
          ->where('vsaccess.USU_PAS', $USU_PAS)         
          ->first();     

          if ($user) {
            
            $result->status = 200;
            $result->message = 'Ingreso con Exito';
            $result->user = $user;       
            $result->userData = self::sessionLogin($USU_ID);       
            return $result;     

          }else{
           
            $result->status = 400;
            $result->message = 'error clave';          
            return $result;
          }      
        }else{

          $result->status = 400;
          $result->message='Usuario no Existe';
          return $result;
        }         
         return null;           
  }
 static function sessionLogin($USU_ID)
	{	
			return DB::table('vsaccess')
      ->join("vsrolusr", "vsaccess.USU_ROL", "=", "vsrolusr.rol_id")    
      ->select('vsaccess.USU_SEC','vsaccess.USU_ID','vsaccess.ALI_NO','vsaccess.USU_NM', 'vsaccess.USU_NO', 'vsrolusr.rol_id', 'vsrolusr.rol_name','vsaccess.PTO_NO','vsaccess.ESTADO')      
      ->where("vsaccess.USU_ID",$USU_ID)
      ->first();   		
		}
}
