<?php

namespace App\Exports;

use App\Models\VsTudent;
use App\Models\VsMatter;
use App\Models\VsEcmat;


use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\VStudentCollection;


class VsStudentExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $request; // request 

    public function view():View
    {
     
        $USU_ROL =   session()->get('USU_ROL');
        $USU_NO  =   session()->get('USU_NO'); 
     
        return view('vstudent.export',
        [
            'vstudents'=> $this->vstudents,
            'USU_ROL'=>$USU_ROL
        ]);
    }
    public function vstudents($vstudents) {
        $this->vstudents = $vstudents;
        
        return $this;
    }

}
