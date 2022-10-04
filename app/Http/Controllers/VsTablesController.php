<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vstables;


use App\Http\Resources\VsTablesCollection;

class VsTablesController extends Controller
{
    
    public $strTab_no;

    public function selectTable($tabla){

        if ($tabla=='ACT') {
            $this->strTab_no='CAL';
            $result = Vstables::where('TAB_NO',$this->strTab_no)->get();
            $data = new VsTablesCollection($result);

        }
        else{
            $this->strTab_no=$tabla;
            $result = Vstables::where('TAB_NO',$this->strTab_no)->where('ESTATU',1)->get();
            $data = new VsTablesCollection($result);
        }

        return response()->json(['status' => 200,'result' => $data]);   
        
    }

}
