<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VsEcmat extends Model
{
    use HasFactory;
    
    //protected $primaryKey = 'MAT_NO';
    protected $table = "vssecmat";
    protected $primaryKey = 'SEC_ID';
    public $timestamps = false;

    protected $fillable = [       
        'SEC_NO',    
        'MAT_NO',
        'EMP_NO',  
        'PERIOS',  
        'ORDERS',  
        'CLINKS',  
    ];

    public function vsections() {
       
        return $this->belongsTo(VsEction::class, 'SEC_NO');
       // return $this->belongsTo(VsEction::class);
      // return $this->hasMany(VsEction::class);
    }

    public function vsematers() {
       
        return $this->belongsTo(VsMatter::class, 'MAT_NO');
    }

    public function vsemplox() {
       
        return $this->belongsTo(VsEmplox::class, 'EMP_NO');
    }

    public static function selectVslibsec($USU_NO){
        return DB::table('vssecmat')
        ->join("vsection", "vsection.SEC_NO", "=", "vssecmat.SEC_NO")        
        ->join("vsemplox", "vsemplox.EMP_NO", "=", "vssecmat.EMP_NO")        
        ->select('vssecmat.SEC_NO','vsection.SEC_NM','vsection.NIV_NO','vsection.PARALE', 'vsection.JOR_NO')      
        ->where("vssecmat.EMP_NO",$USU_NO)
        ->orderBy('vsection.NIV_NO','DESC')
        ->paginate(10);  
    }

    public static function selectVsactsav($USU_NO){
        return DB::table('vssecmat')
        ->join("vsection", "vsection.SEC_NO", "=", "vssecmat.SEC_NO")        
        ->join("vsmatter", "vsmatter.MAT_NO", "=", "vssecmat.MAT_NO")        
        ->join("vsemplox", "vsemplox.EMP_NO", "=", "vssecmat.EMP_NO")        
        ->select('vssecmat.SEC_ID','vsection.SEC_NM','vsection.PARALE','vsmatter.MAT_NM', 'vsmatter.REGIME','vsemplox.LAS_NM','vsemplox.FIR_NM')      
        ->where("vssecmat.EMP_NO",$USU_NO)
        ->orderBy('vsection.NIV_NO','DESC');  
    }
 
    public static function selectVsactmat($USU_NO){
        return DB::table('vssecmat')
        ->join("vsection", "vsection.SEC_NO", "=", "vssecmat.SEC_NO")        
        ->join("vsmatter", "vsmatter.MAT_NO", "=", "vssecmat.MAT_NO")        
        ->join("vsemplox", "vsemplox.EMP_NO", "=", "vssecmat.EMP_NO")        
        ->select('vssecmat.SEC_ID','vssecmat.PERIOS','vsection.SEC_NM','vsection.PARALE','vsmatter.MAT_NM', 'vsmatter.REGIME','vsemplox.LAS_NM','vsemplox.FIR_NM','vssecmat.CLINKS','vssecmat.ORDERS')      
        ->where("vssecmat.EMP_NO",$USU_NO)
        ->orderBy('vssecmat.PERIOS','DESC');      
    }

    public static function selectVsection($USU_NO){
        //esto creee pero no lo utiilizo we 
        return DB::table('vssecmat')
        ->join("vsection", "vsection.SEC_NO", "=", "vssecmat.SEC_NO")   
        ->join("vsemplox", "vsemplox.EMP_NO", "=", "vssecmat.EMP_NO")        
        ->select('vssecmat.SEC_NO','vsection.SEC_NM','vsection.PARALE','vsection.NIV_NO', 'vsection.PARALE','vsection.JOR_NO')      
        ->where("vssecmat.EMP_NO",$USU_NO)
        ->groupBy("vssecmat.SEC_NO")
        ->orderBy('vsection.NIV_NO','DESC')->get();      
    }

    public static function selectVsmatter($USU_NO){
      
        return DB::table('vssecmat')
        ->join("vsmatter", "vsmatter.MAT_NO", "=", "vssecmat.MAT_NO")   
        ->join("vsemplox", "vsemplox.EMP_NO", "=", "vssecmat.EMP_NO")        
        ->join("vsection", "vsection.SEC_NO", "=", "vssecmat.SEC_NO")        
        ->select('vssecmat.SEC_ID','vssecmat.MAT_NO','vsmatter.MAT_NM','vsmatter.REGIME','vsmatter.CALIFI','vsection.SEC_NM','vsection.PARALE','vsection.NIV_NO')      
        ->where("vssecmat.EMP_NO",$USU_NO)

        ->orderBy('vsection.NIV_NO','DESC')->get();      
    }

    
}
