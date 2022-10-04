<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsAbsentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    { 
     return [
        'data'=>  $this->collection->transform(function($row, $key) {         
            return [

                'SEC_ID' => $row->SEC_ID,
                'PERIOS' => $row->PERIOS,
                'FECREG' => $row->FECREG,
                'ABSTIP' => $row->ABSTIP,            
                'PARCIA' => $row->PARCIA,                 
                'SEC_NM' => $row->vsections->SEC_NM,                 
                'PARALE' => $row->vsections->PARALE,                 
                'MAT_NM' => $row->vsematers->MAT_NM,                 
                'REGIME' => $row->vsematers->REGIME,                 
                'LAS_NM' => $row->vstudent->LAS_NM,                 
                'FIR_NM' => $row->vstudent->FIR_NM    
            ];              
        }),
        'pagination'=>[
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage()
          ]
       ];  
    }
}
