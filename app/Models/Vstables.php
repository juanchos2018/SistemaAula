<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vstables extends Model
{
    use HasFactory;

    protected $primaryKey = 'SEC_ID';
    protected $table = "vstables";

}
