<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\VStudentCollection;
use App\Models\VsTudent;

use App\Exports\VsStudentExport;
use Maatwebsite\Excel\Excel;

use App\Traits\SelecUser;

class VsStudentController extends Controller
{
    //
	public $USU_ROL;
    public $USU_NO;


	use SelecUser;


    public function index($search){

        $this->USU_NO  =   $this->getSelecUser(); 
        $this->USU_ROL  =  $this->getSelecRol(); 

        $data=$this->records();     
     
        return response()->json(['status' => 200,'result' => $data,'use_No'=> $this->USU_ROL]);   
    }

    function records(){

        $data=array();
		
        switch($this->getSelecRol())
        {
            case 5:  // Docente		
              
				$result=  VsTudent::students($this->getSelecUser());        
				$data   = new VStudentCollection($result->paginate(15));  
				
				//$data=VsTudent::students($this->USU_NO);        
				//$data   = new VStudentCollection($result->paginate(15));  

                break;
            case 7: // Estudiante		
                //$data=VsTudent::where('EMP_NO',$this->USU_NO)-> get(); 
				$data=VsTudent::students($this->getSelecUser()); 
                break;

             case 8:  // Representante			
             //   $data=VsTudent::where('EMP_NO',$this->USU_NO)-> get(); 
				$data=VsTudent::students($this->getSelecUser()); 
                    break;
            default:					
                 //  $result=VsTudent::get(); 
				 //vsecmat()->where('EMP_NO','1')
				 //->limit(10)
				 $result=VsTudent::students($this->getSelecUser());        
				 $data   = new VStudentCollection($result->paginate(15));  
                //   $data=VsTudent::students($this->USU_NO); 
                   //$result=VsTudent::limit(1)->get(); 
				  // $data =new VStudentCollection($result);
                break;
        }
        return $data;
    }  

	public function exportExcel(){       
		$data = $this->dataExport();
        return (new VsStudentExport)->vstudents($data)->download('VsStudent.xlsx', Excel::XLSX);
        exit();
    }

    public function exportPdf(){    
		
		$data = $this->dataExport();
        return (new VsStudentExport)->vstudents($data)->download('VsStudent.pdf', Excel::DOMPDF);     
    }

	function dataExport(){      

        $data=array();

        switch($this->getSelecRol())
        {
            case 5:  // Docente		
              
				$data=  VsTudent::students($this->getSelecUser())->get(); 
                break;
            case 7: // Estudiante		
                
				$data=VsTudent::students($this->getSelecUser())->get(); 
                break;

             case 8:  // Representante			
             
				$data=VsTudent::students($this->getSelecUser())->get(); 
                break;
            default:					
                
				 $data=VsTudent::students($this->getSelecUser())->get();        
				
                break;
        }
        return $data;
    }  

    function selectVstudent()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			$ide = $_SESSION['idUser'];
			switch($rol)
			{
				case 5:  // Docente
					$sql = "SELECT a.STD_NO,
								   a.SEC_NO,
								   a.PERIOS,
								   a.LAS_NM,
								   a.FIR_NM,
								   a.IDTYPE,
								   a.IDE_NO,
								   a.ESTATU,
								   s.SEC_NM,
								   s.PARALE
					FROM vstudent a
					INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
					INNER JOIN vssecmat t ON t.SEC_NO = a.SEC_NO AND t.EMP_NO = $usu
					ORDER BY a.LAS_NM,a.FIR_NM";
					break;
				case 7:  // Estudiante
						$sql = "SELECT a.STD_NO,
						               a.PERIOS,
				    			       a.LAS_NM,
			    				       a.FIR_NM,
									   a.IDTYPE,
									   a.IDE_NO,
						               a.ESTATU,
		            				   s.SEC_NM,
									   s.PARALE
				        FROM vstudent a
			    	    INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
			        	WHERE a.STD_NO = $usu
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
				case 8:  // Representante
						$sql = "SELECT a.STD_NO,
									   a.PERIOS,
									   a.LAS_NM,
									   a.FIR_NM,
									   a.IDTYPE,
									   a.IDE_NO,
									   a.ESTATU,
									   s.SEC_NM,
									   s.PARALE
						FROM vstudent a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						WHERE a.REPCED = $ide
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
				default:
						$sql = "SELECT  a.STD_NO,
										a.PERIOS,
										a.LAS_NM,
										a.FIR_NM,
										a.IDTYPE,
									    a.IDE_NO,
										a.ESTATU,
										s.SEC_NM,
										s.PARALE
						FROM vstudent a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
			}
			$request = $this->select_all($sql);
			return $request;
		}

}
