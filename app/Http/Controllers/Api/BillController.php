<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Trait\GeneralTrait;
use App\Models\bills;
use App\Models\customers;
use App\Models\deliveries;
use App\Models\delivery_companies;
use App\Models\detail_bill;
use Cassandra\Date;
use Cassandra\Time;
use Doctrine\DBAL\Types\StringType;
use Dotenv\Validator;
use Faker\Provider\ar_EG\Internet;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;
use Ramsey\Uuid\Type\Integer;

class BillController extends Controller
{
    use GeneralTrait;

    public function getAllBills(Request $request){
        try {
            $c=customers::all()->firstWhere("Customer_Token",value: $request->Customer_Token);
            $id=$c["customer_Id"];
            $bill=bills::all()->Where("Customer_Id",value: $id);
            return  $this->returenData($bill->values());
        }catch (\Exception $exception){
            return  $this->returenError(100);
        }
    }


    public function getDeliveryCompanies(Request $request){
        try {
            $delinerycomp=delivery_companies::all();
            return  $this->returenData($delinerycomp);
        }catch (\Exception $exception){
            return  $this->returenError(100);
        }
    }


    public function getDetailBills(Request $request){
        $c=customers::all()->firstWhere("Customer_Token",value: $request->post("Customer_Token"));
        $id=$c["customer_Id"];
        $bid=(int)$request->header("Bill_Id");
        if ($bid!=0){
            $bill=bills::all()->firstWhere("Bill_Id",$bid);
            if ($id==$bill["Customer_Id"]){
                $detailbill=detail_bill::all()->Where("Bill_Id",$bid);
                return  $this->returenData($detailbill->values()) ;}
            else
                return  $this->returenError(300,msg: $bill["Customer_Id"]) ;
        }
    }


    public function setBill(Request $request){
        $c=customers::all()->firstWhere("Customer_Token",value: $request->post("Customer_Token"));
        $cid=$c["customer_Id"];
        $id=bills::all()->count()+1;
        try {
            $deliveryId=(int)$request->header("Delivery_Id");
            $billAddress=(string)$request->header("Bill_Address");
            $deliveryComid=(int)$request->header("Delivery_Comid");
            $lat=(double)$request->header("Lat");
            $long=(double)$request->header("Long");
            $btype=(int)$request->header('Bill_Type');
            $Delive_Time=(int)$request->header("Delive_Time");
            $now1=now();
            if ($btype!=0 && $Delive_Time>29/*$billAddress!="" && $long!=0.0 && $lat!=0.0*/){
                bills::create([
                    'Bill_Id'=>$id,
                    'Customer_Id'=>$cid,
                    'Delivery_Id'=>$deliveryId,
                    'Bill_Regdate'=>now(),
                    'Bill_Address'=>$billAddress,
                    'Delivery_Comid'=>$deliveryComid,
                    'Bill_Status'=>0,
                    'Lat'=>$lat,
                    'Long'=>$long,
                    'created_at'=>$now1,
                    'id'=>$id,
                    'Delive_Time'=>date_time_set(hour:($now1->addHour((int)($Delive_Time/60))),minute:($now1->addMinutes($Delive_Time%60))),
                    'Bill_Type'=>$btype]);
            }
        }catch (\Exception $ex){
            return  $this->returenError(300) ;
        }
        return  $this->returenData(value: $id) ;
    }

    public function setDetailBill(Request $request){
        $c=customers::all()->firstWhere("Customer_Token",value: $request->post("Customer_Token"));
        $cid=$c["customer_Id"];
        $id=detail_bill::all()->count()+1;
        try {
                $bid=(int)$request->header("Bill_Id");
                $fid=(int)$request->header("Food_Id");
                $fc=(int)$request->header("Food_Count");
            if ($bid!=0  && $fid!=0 && $fc!=0){
                if ($cid==bills::all()->firstWhere("Bill_Id",$bid)["Customer_Id"]){
                    detail_bill::create([
                        'Bill_Id'=>$bid,
                        'Food_Id'=>$fid,
                        'Food_Count'=>$fc,
                        'id'=>$id,
                        'created_at'=>now(),
                    ]);
                }
            }
        }catch (\Exception $ex){
            return  $this->returenError(300) ;
        }
        return  $this->returenData(value: $id);
    }

    public function removeBill(Request $request){
        $c=customers::all()->firstWhere("Customer_Token",value: $request->post("Customer_Token"));
        $cid=$c["customer_Id"];
        $bid=(int)$request->header("Bill_Id");
        if ($bid!=0){
            if ($cid==bills::all()->firstWhere("Bill_Id",$bid)["Customer_Id"])
                try {
                    $q="DELETE FROM bills WHERE Bill_Id=$bid";
                    $b=bills::query();
                    $b->fromQuery($q);
                    $q1="DELETE FROM detail_bills WHERE Bill_Id=$bid";
                    $b1=bills::query();
                    $b1->fromQuery($q1);
                }catch (\Exception $ex){
                    return  $this->returenError(300) ;
                }
            return  $this->returenSuccessMassage(5000,) ;}
    }
}
