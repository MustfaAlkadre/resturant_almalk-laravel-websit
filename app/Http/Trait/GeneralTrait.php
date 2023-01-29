<?php

namespace App\Http\Trait;

use Illuminate\Http\JsonResponse;

trait GeneralTrait
{
public function returenData($value,$msg=""): JsonResponse
{
return response()->json([
   'status'=>true,
   'errNum'=>"5000",
   'msg'=>$msg,
   'data'=>$value
]);
}
    public function returenError($errNum,$msg=""): JsonResponse
    {
        return response()->json([
            'status'=>false,
            'errNum'=>$errNum,
            'msg'=>$msg,
        ]);
    }
    public  function returenSuccessMassage($errNum,$msg="true"): JsonResponse
    {
        return response()->json([
            'status'=>true,
            'errNum'=>$errNum,
            'msg'=>$msg,
        ]);
    }


}
