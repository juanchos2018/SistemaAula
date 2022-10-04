<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsEcmat;
use App\Models\VsTudent;

use App\Exports\VsMatterExport;
use Maatwebsite\Excel\Excel;


use App\Http\Resources\VsEcmatCollection;

use App\Traits\SelecUser;

class VsSecmatController extends Controller
{
    
    public $USU_ROL;
    public $USU_NO;

    use SelecUser;
   
    public function index(Request $request){      

        $this->USU_NO  =   $this->getSelecUser(); 
        $this->USU_ROL  =  $this->getSelecRol(); 
      
        $perPage = $request->input('limit'); // User input 
        //$search = json_encode( $request );
        $data=$this->records($perPage); 
    
        return response()->json(['status' => 200,'result' => $data,'perPage'=>$perPage, 'USU_NO'=>$this->USU_NO]);   
    }

    function records($perPage){

        $data=array();
        switch($this->getSelecRol())
        {
            case 5:  // Docente				
                $result = VsEcmat::where('EMP_NO', $this->getSelecUser());
                $data   = new VsEcmatCollection($result->paginate($perPage));               
                break;

            case 7:  // Estudiante		
                $seccio = VsTudent::find($this->getSelecUser()); 
                $result = VsEcmat::where('SEC_NO',$seccio->SEC_NO);
                $data   = new VsEcmatCollection($result->paginate(10));             
                break;
           
            default:					
                $result  = VsEcmat::orderBy('SEC_NO');   
                $data    = new VsEcmatCollection($result->paginate(10));       
                break;
        }
        return $data;
    }   

    public function store(Request $request){
        try
        {           
            $message="Agregado con exito";
            $SEC_ID = $request->SEC_ID;            
            if ($SEC_ID) {

                $result =VsEcmat::where('PERIOS',$request->PERIOS)->where('SEC_NO',$request->SEC_NO)->where('MAT_NO',$request->MAT_NO)->where('SEC_ID','<>',$SEC_ID)->first();
                if ($result) {

                    $message="Existe 1";
                    return response()->json(['status' => 400,'message'=>$message,'result'=>$result]);

                }else{

                    $message="Actualizado con exito";
                    $obj = VsEcmat::find($request->SEC_ID);
                    $obj->SEC_NO = $request->SEC_NO;
                    $obj->MAT_NO = $request->MAT_NO;
                    $obj->EMP_NO = $request->EMP_NO;
                    $obj->PERIOS = $request->PERIOS;
                    $obj->CLINKS = $request->CLINKS;
                    $obj->ORDERS = $request->ORDERS;
                    $obj->update();

                    return response()->json(['status' => 200,'result' => $obj,'message'=>$message]);
                }
                
            }else{

                $result =VsEcmat::where('PERIOS',$request->PERIOS)->where('SEC_NO',$request->SEC_NO)->where('MAT_NO',$request->MAT_NO)->first();

                if ($result) {
                    $message="Existe 2";
                    return response()->json(['status' => 400,'message'=>$message]);
                }

                $obj = new VsEcmat();
                $obj->SEC_NO = $request->SEC_NO;
                $obj->MAT_NO = $request->MAT_NO;
                $obj->EMP_NO = $request->EMP_NO;
                $obj->PERIOS = $request->PERIOS;
                $obj->CLINKS = $request->CLINKS;
                $obj->ORDERS = $request->ORDERS;
                $obj->save();            
    
                return response()->json(['status' => 200,'result' => $obj,'message'=>$message]);
            }          
            
        } catch (\Exception $e){      

            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function vsdupmat(Request $request){
        try
        {       
            $message="resultado";
            $this->validate($request, [
                'SEC_NO' => 'required',
                'SEC_NO_END' => 'required',
                'PERIOS' => 'required'               
            ]);

            $result_one = VsEcmat::where('PERIOS',$request->PERIOS)->where('SEC_NO',$request->SEC_NO)->first();
            if ($result_one) {
                $message="Existe ";
                return response()->json(['status' => 400,'message'=>$message]);
            }

            $result_two = VsEcmat::where('PERIOS',$request->PERIOS)->where('SEC_NO',$request->SEC_NO_END)->get();

            if (count($result_two)==0) {
                $message="No Existe ";
                return response()->json(['status' => 400,'message'=>$message]);
            }else{
                foreach ($result_two as $item) {

                    $obj = new VsEcmat();
                    $obj->SEC_NO = $item->SEC_NO;
                    $obj->MAT_NO = $item->MAT_NO;
                    $obj->EMP_NO = $item->EMP_NO;
                    $obj->PERIOS = $item->PERIOS;
                    $obj->CLINKS = $item->CLINKS;
                    $obj->ORDERS = $item->ORDERS;
                    $obj->save();                     
                }
            }

            return response()->json(['status' => 200,'result' => $result_two,'message'=>$message]);
            
        } catch (\Exception $e){      

            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function exportExcel(){       
     
        return (new VsMatterExport)->download('VsSecmat.xlsx', Excel::XLSX);
        exit();
    }

    public function exportPdf(){    
    
        return (new VsMatterExport)->download('VsSecmat.pdf', Excel::DOMPDF);     
    }

    function validateSesion(){
        
    }
    function  oldQuerys(){
        // $obj = VsEcmat::firstOrNew(['SEC_ID' => $SEC_ID]);
        // $obj->fill($request->all());
        // $obj->save();
        // $message =$request->SEC_ID==null?'Agregado con exito':'Actualizado con exito';
    }

}
