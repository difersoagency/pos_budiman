<?php

namespace App\Http\Middleware;

use App\Models\LevelUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $role
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ... $allowed_roles)
    {
        $allow = array();
        foreach($allowed_roles as $a){
           $l =  LevelUser::where('nama',$a)->first();
            $allow[] = $l->id;
        }


        $role = strtolower( request()->user()->level_user_id );

        if( in_array($role, $allow) ) {
            return $next($request);
        }
        if (Auth::check() && Auth::user()->level_user_id == 1) {
            return redirect()->route('home_owner');
          }else if(Auth::check() && Auth::user()->level_user_id == 2){
            return redirect()->route('home_admin');
          }elseif(Auth::check() && Auth::user()->level_user_id == 3){
            return redirect()->route('home_kasir');
          }


    }
}
