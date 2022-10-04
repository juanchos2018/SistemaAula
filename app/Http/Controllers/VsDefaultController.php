<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsDefault;

class VsDefaultController extends Controller
{
    

    public function default(){
        
        $default =VsDefault::first();
        return response()->json(['status' => 200,'result' => $default]);  
    }

}
