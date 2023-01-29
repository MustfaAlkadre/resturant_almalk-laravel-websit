<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
    use HasFactory;
    protected $table='bills';
    protected $fillable=
        ['Bill_Id','Customer_Id','Delivery_Id',
            'Bill_Regdate','Bill_Address',
            'Delivery_Comid','Bill_Status',
            'Lat','Long','created_at','updated_at','id','Delive_Time','Bill_Type'];
}
