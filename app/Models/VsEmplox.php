<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VsEmplox extends Model
{
    protected $table = "vsemplox";
    protected $primaryKey = 'EMP_NO';
    
    public $timestamps = false;

    protected $fillable = [        
         
          'LAS_NM',
          'FIR_NM',
          'IDTYPE',
          'IDE_NO',
          'CAT_NO',
          'ADDRES',
          'TPHONE',
          'PARROQ',
          'CIUDAD',
          'PROVIN',
          'PAISES',
          'EMPGEN',
          'ESTADO',
          'FECBIR',
          'FECING',
          'EMPMAI',
          'BAN_NO',
          'CTATYP',
          'CTABAN',
          'SERVIC',
          'MAGIST',
          'SECCOD',
          'POSCOD',
          'EMPRLG',
          'CARGAS',
          'ESTATU',
          'PROFIL',
          'TITULO',
          'REMARK',
          'SALARY',

    ];
    
}
