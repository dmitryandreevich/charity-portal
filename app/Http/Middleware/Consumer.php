<?php

namespace App\Http\Middleware;

use App\Classes\TypeOfUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class Consumer
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
        if( Auth::user()->type == TypeOfUser::CONSUMER )
            return $next($request);

        return redirect( route('home.index') )->with('error', 'Вы не являетесь потребителем!');
    }
}
