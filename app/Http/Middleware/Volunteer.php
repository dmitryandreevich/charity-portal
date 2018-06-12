<?php

namespace App\Http\Middleware;

use App\Classes\TypeOfUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class Volunteer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::user()->type == TypeOfUser::VOLUNTEER )
            return $next($request);

        return redirect( route('home.index') )->with('error', 'Вы не являетесь волонтёром!');
    }
}
