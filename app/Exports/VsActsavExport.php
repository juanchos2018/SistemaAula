<?php

namespace App\Exports;

use App\Models\VsEcmat;
use Maatwebsite\Excel\Concerns\FromCollection;


use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\VStudentCollection;


class VsActsavExport implements  FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function view():View
    {
        return view('vsactsav.export',
        [
            'vsactsavs'=> $this->vsactsavs            
        ]);
    }

    public function vsactsavs($vsactsavs) {
        $this->vsactsavs = $vsactsavs;
        
        return $this;
    }
}
