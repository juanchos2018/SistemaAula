<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsActsavCollection extends ResourceCollection
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
                    'SEC_NM' => $row->SEC_NM,
                    'PARALE' => $row->PARALE,
                    'MAT_NM' => $row->MAT_NM,
                    'REGIME' => $row->REGIME,                             
                    'LAS_NM' => $row->LAS_NM,                             
                    'FIR_NM' => $row->FIR_NM                          
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
}
