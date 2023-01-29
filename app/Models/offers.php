<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offers extends Model
{
    use HasFactory;
    protected $table='offers';
    protected $fillable=
        ['Offer_Id','Food_Id','Offer_Newprice','Offer_Note','Offer_Start','Offer_End','created_at','updated_at','id'];
}
