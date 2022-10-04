<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VsNotify extends Model
{
    use HasFactory;


    protected $primaryKey = 'SEC_ID';
    protected $table = "vsnotify";


    protected $fillable = [       
        'SEC_NO',    
        'MAT_NO',
        'STD_NO'  
    ];

    public function vsections() {
       
        return $this->belongsTo(VsEction::class, 'SEC_NO');
    }
    public function vsematers() {
       
        return $this->belongsTo(VsMatter::class, 'MAT_NO');
    }

    public function vstudent() {
       
        return $this->belongsTo(VsTudent::class, 'STD_NO');
    }

}
