<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_bill extends Model
{
    use HasFactory;
    protected $table='detail_bills';
    protected $fillable=
        ['Bill_Id','Food_Id','Food_Count','id','created_at','updated_at'];
}
