<?php

namespace App\Http\Middleware;

use App\Http\Trait\GeneralTrait;
use App\Models\customers;
use Closure;
use Illuminate\Http\Request;
use function MongoDB\BSON\fromJSON;
use function Symfony\Component\String\b;

class CheckToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token=$request->Customer_Token;
        if($token!=null){
        if ($token!=""&&customers::all()->where("Customer_Token",value:$token)->isNotEmpty())
            return $next($request);
        else return $this->returenError(100,"not auth");
        } else
        return $this->returenError(200,"no token");
    }
}
