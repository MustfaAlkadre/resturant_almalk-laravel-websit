<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class customers extends Model
{
    use HasFactory;
    protected $table='customers';
    protected $fillable=
        ['customer_Id','Customer_Name','Customer_Phone','Customer_Image','Customer_Password',
            'Customer_Email','Customer_Regdate','Customer_Block','Customer_Token',
            'created_at','updated_at','id'];

}
