<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsEcmatCollection extends ResourceCollection
{
     

    public function toArray($request)
    {
       return [ 'data'=>  $this->collection->transform(function($row, $key) {         
            return [
                'SEC_ID' => $row->SEC_ID,
                'MAT_NO' => $row->MAT_NO,
                'PERIOS' => $row->PERIOS,
                'CLINKS' => $row->CLINKS,
                'ORDERS' => $row->ORDERS,
                'SEC_NM' => $row->vsections->SEC_NM."-".$row->vsections->PARALE,
                'PARALE' => $row->vsections->PARALE,
                'NIV_NO' => $row->vsections->NIV_NO,
                'MAT_NM' => $row->vsematers->MAT_NM,              
                'REGIME' => $row->vsematers->REGIME,              
                'CALIFI' => $row->vsematers->CALIFI,              
                'LAS_NM' => $row->vsemplox->LAS_NM,              
                'FIR_NM' => $row->vsemplox->FIR_NM,                          
            ];              
        }),'pagination'=>[
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage()
        ]
       ]; 
    }


    // public function toArrayold($request)
    // {
    //     return $this->collection->transform(function($row, $key) {
    //         return [
    //             'SEC_ID' => $row->SEC_ID,
    //             'MAT_NO' => $row->MAT_NO,
    //             'PERIOS' => $row->PERIOS,
    //             'CLINKS' => $row->CLINKS,
    //             'ORDERS' => $row->ORDERS,
    //             'SEC_NM' => $row->vsections->SEC_NM."-".$row->vsections->PARALE,
    //             'PARALE' => $row->vsections->PARALE,
    //             'NIV_NO' => $row->vsections->NIV_NO,
    //             'MAT_NM' => $row->vsematers->MAT_NM,              
    //             'REGIME' => $row->vsematers->REGIME,              
    //             'CALIFI' => $row->vsematers->CALIFI,              
    //             'LAS_NM' => $row->vsemplox->LAS_NM,              
    //             'FIR_NM' => $row->vsemplox->FIR_NM,              
    //         ];
    //     });
    // }
}
