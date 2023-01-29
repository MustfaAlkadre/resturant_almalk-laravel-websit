<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deliveries extends Model
{
    use HasFactory;
    protected $table='deliveries';
    protected $fillable=
        ['Delivery_Id','Delivery_Name','Delivery_Phone','Delivery_Passworld','Delivery_Regdate','Delivery_Image','Delivery_Thumbnail',
            'Delivery_Email','Delivery_Token','created_at','updated_at','id'];
}
