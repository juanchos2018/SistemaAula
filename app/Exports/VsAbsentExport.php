<?php

namespace App\Exports;

use App\Models\VsAbsent;
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


class VsAbsentExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $request; // request 

    public function view():View
    {       
        return view('vsabsent.export',
        [
            'vsabsents'=> $this->vsabsents            
        ]);
    }

    public function vsabsents($vsabsents) {
        $this->vsabsents = $vsabsents;
        
        return $this;
    }
}
