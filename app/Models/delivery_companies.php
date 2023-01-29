<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_companies extends Model
{
    use HasFactory;
    protected $table='delivery_companies';
    protected $fillable=
        ['Delivery_Comid','Delivery_Comname','Delivery_Comphone','Delivery_Comcity','created_at','updated_at','id'];
}
