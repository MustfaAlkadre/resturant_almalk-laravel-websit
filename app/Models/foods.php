<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foods extends Model
{
    use HasFactory;
    protected $table='foods';
    protected $fillable=
        ['Food_Id','Food_Name','Food_Detels','Food_Category_Id','Food_Price','Food_Image','Food_Create_Date',
            'Food_Rate','created_at','updated_at','id'];
}
