<?php

namespace App\Http\Middleware;

use App\Classes\TypeOfAdmin;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRules
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
        $roles = array_slice(func_get_args(), 2);
        foreach ($roles as $role) {
            if($role == 'admin') {
                if (Auth::user()->admin_type == TypeOfAdmin::ADMINISTRATOR)
                    return $next($request);
            }
            elseif($role == 'moderator') {
                if (Auth::user()->admin_type == TypeOfAdmin::MODERATOR)
                    return $next($request);
            }
        }



        return redirect( route('home.index') )->with('error', 'Вы не являетесь Администратором!');
    }
}
