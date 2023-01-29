<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Trait\GeneralTrait;
use App\Models\bills;
use App\Models\customers;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class UserController extends Controller
{
    use GeneralTrait;

    public function logout(Request $request){
        $token="";
        try {
                $q="UPDATE customers SET Customer_Token='$token' WHERE Customer_Token='$request->Customer_Token'";
                $b=customers::query();
                $b->fromQuery($q);
            }catch (\Exception $ex){
            return  $this->returenError(300,$q) ;
        }
        return  $this->returenSuccessMassage(5000,msg: $token) ;
    }

    public function login(Request $request){
        $token="";
        $email=$request->header("Customer_Email");
        if ($email!=""){
            try {
                $c=customers::all()->where('Customer_Email',value:$email );
                $c=$c->firstWhere('Customer_Password',value: $request->Customer_Password);
                try {
                    if ($c)
                    {
                        $token=Random::generate(250);
                        $q="UPDATE customers SET Customer_Token='$token' WHERE Customer_Email='$email'";
                        $b=customers::query();
                        $b->fromQuery($q);
                        $c["Customer_Token"]=$token;
                    }else
                        return  $this->returenError(300,'the password or Email not true') ;
                }catch (\Exception $ex){
                    return  $this->returenError(300,$q) ;
                }
                return  $this->returenData(value: $c) ;
            }catch (\Exception $ex){
                return  $this->returenError(300,"$ex") ;
            }
        }
    }

    public function register(Request $request){
        $token="";
        $email=$request->header("Customer_Email");
        $name=$request->header("Customer_Name");
        $phone=(int)$request->header("Customer_Phone");
        /*$img=$request->header("Customer_Image");*/
        if ($email!="" && $name!="" && $phone !=0 /*&& $img!="" */){
            $mass="false";
            $id=customers::all()->count()+1;
            try {
                $token=Random::generate(250);
                if (customers::all()->where('Customer_Email',value: $email)->isEmpty()){
                  customers::create([
                            'customer_Id'=>$id,
                            'Customer_Name'=>$name,
                            'Customer_Phone'=>$phone,
                            'Customer_Image'=>""/*$img*/,
                            'Customer_Password'=>$request->Customer_Password,
                            'Customer_Email'=>$email,
                            'Customer_Regdate'=>now(),
                            'Customer_Block'=>0,
                            'Customer_Token'=>$token,
                            'created_at'=>now(),
                            'updated_at'=>now(),
                            'id'=>$id,
                        ]);
                }
                else
                {
                    $mass="the email exists";
                    return  $this->returenError(300,$mass) ;
                }
            }catch (\Exception $ex){
                $m=['Customer_Token'=>$token , 'customer_Id'=>$id];
                return  $this->returenData(value:$m);
            }
            $m=['Customer_Token'=>$token , 'customer_Id'=>$id];
            return  $this->returenData(value:$m);
        }
    }

    public function changename(Request $request){
        $token=$request->Customer_Token;
        $name=$request->header("Customer_Name");
        $pas=$request->header("Customer_Password");
        if ($name!="" && $pas!="" && $token!="" ){
            try {
                $c=customers::all()->firstWhere('Customer_Token',value:$token );
                try {
                    if ($c &&$c["Customer_Password"]==$pas)
                    {
                        $q="UPDATE customers SET Customer_Name='$name' WHERE Customer_Token='$token'";
                        $b=customers::query();
                        $b->fromQuery($q);
                    }else
                        return  $this->returenError(100,'the password not true') ;
                }catch (\Exception $ex){
                    return  $this->returenError(200,$q) ;
                }
                return  $this->returenSuccessMassage(5000,msg: "success");
            }catch (\Exception $ex){
                return  $this->returenError(300,"$ex") ;
            }
        }
    }

    public function changephone(Request $request){
        $token=$request->Customer_Token;
        $phone=(int)$request->header("Customer_Phone");
        $pas=$request->header("Customer_Password");
        if ($phone!=0 && $pas!="" && $token!="" ){
            try {
                $c=customers::all()->firstWhere('Customer_Token',value:$token );
                try {
                    if ($c &&$c["Customer_Password"]==$pas)
                    {
                        $q="UPDATE customers SET Customer_Phone='$phone' WHERE Customer_Token='$token'";
                        $b=customers::query();
                        $b->fromQuery($q);
                    }else
                        return  $this->returenError(100,'the password not true') ;
                }catch (\Exception $ex){
                    return  $this->returenError(200,$q) ;
                }
                return  $this->returenSuccessMassage(5000,msg: "success");
            }catch (\Exception $ex){
                return  $this->returenError(300,"$ex") ;
            }
        }
    }

    public function changeemail(Request $request){
        $token=$request->Customer_Token;
        $email=$request->header("Customer_Email");
        $pas=$request->header("Customer_Password");
        if ($email!="" && $pas!="" && $token!="" ){
            try {
                $c=customers::all()->firstWhere('Customer_Token',value:$token );
                try {
                    if ($c &&$c["Customer_Password"]==$pas)
                    {
                        $q="UPDATE customers SET Customer_Email='$email'WHERE Customer_Token='$token'";
                        $b=customers::query();
                        $b->fromQuery($q);
                    }else
                        return  $this->returenError(100,'the password not true') ;
                }catch (\Exception $ex){
                    return  $this->returenError(200,$q) ;
                }
                return  $this->returenSuccessMassage(5000,msg: "success");
            }catch (\Exception $ex){
                return  $this->returenError(300,"$ex") ;
            }
        }
    }

    public function changepassword(Request $request){
        $token=$request->Customer_Token;
        $newpass=$request->header("New_Customer_Password");
        $oldpas=$request->header("Old_Customer_Password");
        if ($newpass!="" && $oldpas!="" && $token!="" ){
            try {
                $c=customers::all()->firstWhere('Customer_Token',value:$token );
                try {
                    if ($c &&$c["Customer_Password"]==$oldpas)
                    {
                        $q="UPDATE customers SET Customer_Password='$newpass' WHERE Customer_Token='$token'";
                        $b=customers::query();
                        $b->fromQuery($q);
                    }else
                        return  $this->returenError(100,'the password not true') ;
                }catch (\Exception $ex){
                    return  $this->returenError(200,$q) ;
                }
                return  $this->returenSuccessMassage(5000,msg: "success");
            }catch (\Exception $ex){
                return  $this->returenError(300,"$ex") ;
            }
        }
    }


    public function changeimage(Request $request){
        $token=$request->Customer_Token;
        $image=$request->header("Customer_Image");
        $pass=$request->header("Customer_Password");
        if ($pass!="" && $token!="" ){
            try {
                $c=customers::all()->firstWhere('Customer_Token',value:$token );
                try {
                    if ($c &&$c["Customer_Password"]==$pass)
                    {
                        $q="UPDATE customers SET Customer_Image='$image' WHERE Customer_Token='$token'";
                        $b=customers::query();
                        $b->fromQuery($q);
                    }else
                        return  $this->returenError(100,'the password not true') ;
                }catch (\Exception $ex){
                    return  $this->returenError(200,$q) ;
                }
                return  $this->returenSuccessMassage(5000,msg: "success");
            }catch (\Exception $ex){
                return  $this->returenError(300,"$ex") ;
            }
        }
    }


}
