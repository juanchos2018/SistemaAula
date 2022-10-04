<?php

namespace App\Exports;

use App\Models\VsChedul;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\VStudentCollection;


class VsChedulExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function view():View
    {       

       return view('vschedul.export',
       [
           'vscheduls'=> $this->vscheduls            
       ]);
    }


    public function vscheduls($vscheduls) {
        $this->vscheduls = $vscheduls;
        
        return $this;
    }
}
