<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsChedulCollection extends ResourceCollection
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
                    'SEC_NM' => $row->vsections->SEC_NM,                 
                    'PARALE' => $row->vsections->PARALE,                 
                    'MAT_NM' => $row->vsematers->MAT_NM,                 
                    'REGIME' => $row->vsematers->REGIME,   
                    'SCHEDU' => $row->SCHEDU,  
                    'PARCIA' => $row->PARCIA,  
                    'INSUMO' => $row->INSUMO,  
                    'PUNTAJ' => $row->PUNTAJ,  
                    'LAS_NM' => $row->vstudent->LAS_NM,                 
                    'FIR_NM' => $row->vstudent->FIR_NM,  
                    'ELAS_NM' => $row->vsemplox->LAS_NM,  
                    'EFIR_NM' => $row->vsemplox->FIR_NM,  
                    'FLNAME' => $row->FLNAME,  
                    'FLTASK' => $row->FLTASK  
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
