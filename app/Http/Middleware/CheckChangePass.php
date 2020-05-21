<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class CheckChangePass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        if((Hash::check('12345', $this->auth->user()->password))){
            // dd($this->auth->user()->password, !(Hash::check('12345', $this->auth->user()->password)));
            return redirect('/change_password');
        }



        return $next($request);
    }
}
