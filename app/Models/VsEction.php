<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VsEction extends Model
{
    //use HasFactory;
    protected $primaryKey = 'SEC_NO';
    protected $table = "vsection";


    protected $fillable = [       
      'SEC_NO',    
      'EMP_NO'

    ];

    public function vsections() {
      
        return $this->belongsTo(VsEction::class, 'SEC_NO');
    }
    public function vsemploxs() {
      
        return $this->belongsTo(VsEmplox::class, 'EMP_NO');
    }


    //protected $with = ['vssecmat'];



    //esto argrege recien     
  //  public function vssecmat()
   // {
        //return $this->belongsTo(VsEcmat::class);
       // return $this->belongsTo(VsEcmat::class,'SEC_NO');
       // return $this->hasMany(VsEcmat::class);
   // }

}
