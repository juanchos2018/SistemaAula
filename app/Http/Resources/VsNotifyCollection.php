<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsNotifyCollection extends ResourceCollection
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
                    'HORREG' => $row->HORREG,            
                    'CLAIMS' => $row->CLAIMS,
                    'SEC_NM' => $row->vsection->SEC_NM,
                    'PARALE' => $row->vsection->PARALE,
                    'MAT_NM' => $row->vsmatter->MAT_NM,             
                    'LAS_NM' => $row->vstudent->LAS_NM,             
                    'FIR_NM' => $row->vstudent->FIR_NM,             
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
