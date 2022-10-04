<?php

namespace App\Exports;

use App\Models\VsMatter;
use App\Models\VsEcmat;
use App\Models\VsTudent;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\VsEcmatCollection;


class VsMatterExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $request; // request 

    public function view():View
    {
        //return VsEmplox::all();
        $USU_ROL =   session()->get('USU_ROL');
        $USU_NO  =   session()->get('USU_NO'); 
     
        return view('vsmatter.export',
        [
            'vsmatter'=> $this->records(),
            'USU_ROL'=>$USU_ROL
        ]);
    }

    public function records(){

        $data=array();
        $USU_ROL =   session()->get('USU_ROL');
        $USU_NO  =   session()->get('USU_NO'); 
        switch($USU_ROL)
        {
            case 5:  // Docente				
                $result = VsEcmat::where('EMP_NO', $USU_NO)->get();
                $data   = new VsEcmatCollection($result);               
                break;

            case 7:  // Estudiante		
                $seccio = VsTudent::find($USU_NO); //  "SELECT SEC_NO FROM vstudent WHERE STD_NO = ".$usu;
                $result = VsEcmat::where('SEC_NO',$seccio->SEC_NO)->get();
                $data   = new VsEcmatCollection($result);             
                break;
           
            default:					
                $data   = VsEcmat::get()->orderBy('LAS_NM');   
                break;
        }
        return $data;
    }
}
