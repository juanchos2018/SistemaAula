<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsBanker;

class VsBankerController extends Controller
{
    //

    public function index()
    {    

        $data=VsBanker::get();
      //  return compact('data');
        return response()->json(['status' => 200,'result' => $data]);
       // return $data;

    }

}
