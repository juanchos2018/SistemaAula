<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsAbsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);
      return [
        'data'=>  $this->collection->transform(function($row, $key) {         
            return [

                'SEC_ID' => $row->SEC_ID,
                'PERIOS' => $row->PERIOS,
                'FECREG' => $row->FECREG,
                'ABSTIP' => $row->ABSTIP,            
                'PARCIA' => $row->PARCIA       ,                 
                'mi' => "caga"                       
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
