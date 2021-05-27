<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if ($guard == "admin" && Auth::guard($guard)->check()) {
    //         return redirect('/admin');
    //     }
    //     if ($guard == "user" && Auth::guard($guard)->check()) {
    //         return redirect('/user');
    //     }
    //     if (Auth::guard($guard)->check()) {
    //         return redirect('/home');
    //     }

    //     return $next($request);
    // }


    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        if ($guard == "user" && Auth::guard($guard)->check()) {
            return redirect('/user');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);



        // switch($guard){
        //     case 'admin':
        //         if (Auth::guard($guard)->check()) {
        //             return redirect()->route('admin.dashboard') ;
        //         }
        //         break;
        //     case 'user':
        //         if (Auth::guard($guard)->check()) {
        //             return redirect()->route('login') ;
        //         }
        //         break;
        //     default:
        //     if (Auth::guard($guard)->check()) {
        //         return redirect()->route('home') ;
        //         // return view('beranda');
        //     } 
        //         break;
        // }

        // return $next($request);
    }
}