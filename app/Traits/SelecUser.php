<?php

namespace App\Traits;


trait SelecUser
{ 
    private function getSelecUser() {

        $USU_NO = session('USU_NO', 'nulo');      
       
        return  $USU_NO;
    } 
    
    private function getSelecRol() {

        $USU_ROL = session('USU_ROL', 'nulo');
       
        return  $USU_ROL;
    } 
}
