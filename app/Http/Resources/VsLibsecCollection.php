<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VsLibsecCollection extends ResourceCollection
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
    
                    'SEC_NO' => $row->SEC_NO,               
                    'SEC_NM' => $row->SEC_NM,
                    'NIV_NO' => $row->NIV_NO,
                    'PARALE' => $row->PARALE,
                    'JOR_NO' => $row->JOR_NO                             
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
    function pagi(){
    
            // 'pagination'=>[
            //     'total' => $this->total(),
            //     'count' => $this->count(),
            //     'per_page' => $this->perPage(),
            //     'current_page' => $this->currentPage(),
            //     'total_pages' => $this->lastPage()
            // ]
    }
}
