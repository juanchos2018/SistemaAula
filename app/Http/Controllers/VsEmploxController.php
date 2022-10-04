<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VsEmplox;
use Illuminate\Support\Facades\Auth;
use App\Exports\VsEmploxExport;

use Maatwebsite\Excel\Excel;

use App\Http\Resources\VsEmploxCollection;


//use Maatwebsite\Excel\Facades\Excel;
//use Excel;

class VsEmploxController extends Controller
{   
    public $USU_ROL;
    public $USU_NO;


    //protected $request; // request 

    public function __construct()
    {
         
    }

    public function index(Request $request){

        $this->USU_ROL =   $request->session()->get('USU_ROL');
        $this->USU_NO  =   $request->session()->get('USU_NO'); 

        $data=$this->records();
        $total=count($data);
     
        return response()->json(['status' => 200,'result' => $data,'total'=>$total,'use_No'=> $this->USU_ROL]);   
    }
    
    public function record($EMP_NO){

        $result = VsEmplox::find($EMP_NO);

        if ($result) {
            
            return response()->json(['status' => 200,'result' => $result,'use_No'=> $this->USU_ROL]);   
        }
        else{
            return response()->json(['status' => 404]);
        }
    }


    public function store(Request $request){

        try
        {           
            $EMP_NO = $request->EMP_NO;            
            $obj = VsEmplox::firstOrNew(['EMP_NO' => $EMP_NO]);
            $obj->fill($request->all());
            $obj->save();
            $message =$request->EMP_NO==null?'Agregado con exito':'Actualizado con exito';

            return response()->json(['status' => 200,'result' => $obj,'message'=>$message]);
            
        } catch (\Exception $e){      

            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }   

    }





    public function exportExcel(){    

		$data = $this->dataExport();

        return (new VsEmploxExport)->vsemploxs($data)->download('vsemploxs.xlsx', Excel::XLSX);
     
    }
    public function exportPdf(){

    	$data = $this->dataExport();
     
        return (new VsEmploxExport)->vsemploxs($data)->download('vsemploxs.pdf', Excel::DOMPDF);     
    }

    function records(){

        $data=array();
        switch($this->USU_ROL)
        {
            case 1:  // System Manager				
             
                $result = VsEmplox::orderBy('LAS_NM');
                $data   = new VsEmploxCollection($result->paginate(10));            
                break;
            case 5:  // Docente				
                $result = VsEmplox::where('EMP_NO',$this->USU_NO)->orderBy('LAS_NM');
                $data   = new VsEmploxCollection($result->paginate(10));

                break;
            default:					
              
                $result = VsEmplox::where('ESTATU',1)->orderBy('LAS_NM');
                $data   = new VsEmploxCollection($result->paginate(10));   
                break;
        }
        return $data;
    }   

    function dataExport(){

        $this->USU_ROL =   session()->get('USU_ROL');
        $this->USU_NO  =   session()->get('USU_NO'); 

        $data=array();

        switch($this->USU_ROL)
        {  
            case 1:  // System Manager				
             
              $data = VsEmplox::orderBy('LAS_NM')->get();
                  
              break;

            case 5:  // Docente		
              
                $data = VsEmplox::where('EMP_NO',$this->USU_NO)->get();         
                break;        

            default:					
                
               $data = VsEmplox::where('ESTATU',1)->orderBy('LAS_NM')->get();
			 	
              break;
        }
        return $data;
    } 

}
