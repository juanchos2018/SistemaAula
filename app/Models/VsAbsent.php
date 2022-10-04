<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class VsAbsent extends Model
{
    use HasFactory;


    protected $primaryKey = 'SEC_ID';
    protected $table = "vsabsent";

    protected $fillable = [       
        'SEC_NO',    
        'MAT_NO',
        'STD_NO'  
    ];

    public static function listAll($USU_NO){
        //esto ya no va we
        return DB::table('vsabsent')
        ->join("vsection", "vsection.SEC_NO", "=", "vsabsent.SEC_NO")        
        ->join("vsmatter", "vsmatter.MAT_NO", "=", "vsabsent.MAT_NO")        
        ->join("vstudent", "vstudent.STD_NO", "=", "vsabsent.STD_NO")
        ->select('vsabsent.SEC_ID','vsabsent.PERIOS','vsabsent.FECREG','vsabsent.ABSTIP', 'vsabsent.PARCIA',
                 'vsection.SEC_NM','vsection.PARALE','vsmatter.MAT_NM','vsmatter.REGIME','vstudent.LAS_NM','vstudent.FIR_NM')      
        ->where("vsabsent.EMP_NO",$USU_NO)
        ->paginate(15); 
    }

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
