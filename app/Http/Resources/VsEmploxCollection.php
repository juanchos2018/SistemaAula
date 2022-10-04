<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsEmploxCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

   
    public function toArray($request)
    {
       return [ 'data'=>  $this->collection->transform(function($row, $key) {         
            return [

                'EMP_NO' => $row->EMP_NO,               
                'LAS_NM' => $row->LAS_NM,               
                'FIR_NM' => $row->FIR_NM,
                'IDTYPE' => $row->IDTYPE,
                'IDE_NO' => $row->IDE_NO,
                'ESTATU' => $row->ESTATU,                             
                'ADDRES' => $row->ADDRES,                             
                'TPHONE' => $row->TPHONE                          
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
