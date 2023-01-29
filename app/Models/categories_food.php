<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories_food extends Model
{
    use HasFactory;
    protected $table='categories_foods';
    protected $fillable=
        ['Category_Id','Category_Name','Category_Image','created_at','updated_at','id'];
}
