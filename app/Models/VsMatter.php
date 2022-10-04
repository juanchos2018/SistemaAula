<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VsMatter extends Model
{
    
    protected $primaryKey = 'MAT_NO';
    protected $table = "vsmatter";

    protected $fillable = [       
        'SEC_NO',    
        'MAT_NO' 
    ];

    


}
