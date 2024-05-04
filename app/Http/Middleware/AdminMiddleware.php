<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        //only allow users that are logged in AND admin users
        if(Auth::check() && Auth::user()->role_id == User::ADMIN_ROLE){
            return $next($request);//allow all
        }else{
            return redirect()->route('home');//not allow
        }
        
    }
}
