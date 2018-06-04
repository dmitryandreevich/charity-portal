<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function store(User $user){
        $user->password = Hash::make('111');
        $user->save();

        return redirect()->back()->with('success', 'Пароль успешно сброшен!');
    }
}
