<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConsumerController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('profile.consumer.main',['user' => $user, 'data' => User::getData($user)->individual->data]);
    }
}
