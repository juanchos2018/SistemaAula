<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsAccess;
use  Illuminate\Support\Facades\Auth;
use \stdClass;

class AuthController extends Controller
{

    public function authenticate(Request $request){
     
        try {
            $result = VsAccess::login($request->USU_ID,hash('sha256',$request->USU_PAS));          
     
            if ($result->status==200) {
              $request->session()->put('USU_ROL',$result->user->USU_ROL);
              $request->session()->put('USU_NO',$result->user->USU_NO);
                  //  $request->session()->put('CREATED',time());
              // $request->session()->put('EXPIRE',session()->get('CREATED')+ (5 * 60));  ,'seccion'=> $request->session()
              return response()->json(['status' => 200,'result' => $result]);   
            }else{  

              return response()->json(['status' => 400,'result' => $result]);
            }
            // if ($result) {           

           
            //    return response()->json(['status' => 200,'result' => $result,'seccion'=> $request->session()]);   
            // }else{                  
            //     return response()->json(['status' => 400,'message' => "error en campos"]);
            // }  
        } catch (\Exception $e){  
            return response()->json(['status' => 400,'msg' =>$e->getMessage()]);
        }                
  }

  public function Message(){
    $data = ['status' => '200','message'=>'error clave'];
    $object = new stdClass();
    $object->property = 'Here we go';
    return response()->json(['status' => 200,'data' =>$object]);
  }
  public function verifiqueSession(Request $request){   
    $now = time();

    // if ($request->session()->has('USU_ROL')) {
    //     if ($now>$request->session()->get('EXPIRE')) {        
    //         $request->session()->forget('USU_ROL');
    //         return response()->json(['status' => 400,'result' => 'Expirado']);   
    //     }else{
    //         return response()->json(['status' => 200,'result' => 'activo']);   
    //     }
    // }else{
    //     return response()->json(['status' => 400,'result' => 'Expirado y No sesion destriuda']);   
    // }  
   
  }
}
