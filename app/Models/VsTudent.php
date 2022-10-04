<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VsTudent extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'STD_NO';
    protected $table = "vstudent";

    protected $fillable = [       
        'SEC_NO'          
    ];

    public function vsections() {
       
        return $this->belongsTo(VsEction::class, 'SEC_NO');
    }
   
    public  function vsecmat() {
   
        return $this->belongsTo(VsEcmat::class,'SEC_NO');
    }

    public static function students($EMP_NO){
        return DB::table('vstudent')
        ->join("vsection", "vsection.SEC_NO", "=", "vstudent.SEC_NO")        
        ->join("vssecmat", "vssecmat.SEC_NO", "=", "vstudent.SEC_NO")        
        ->select('vstudent.STD_NO','vstudent.SEC_NO','vstudent.PERIOS','vstudent.LAS_NM', 'vstudent.FIR_NM',
                 'vstudent.IDTYPE','vstudent.IDE_NO','vstudent.ESTATU','vsection.SEC_NM','vsection.PARALE')      
        ->where("vssecmat.EMP_NO",$EMP_NO);        
    }   

    function oldQuerys(){
            //, 'SEC_NO'
         // ->orderBy('charges.id_charge','DESC')
       // ->paginate(15);   
    }
}
