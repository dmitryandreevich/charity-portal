<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index(){
        $user = Auth::user();
        $userData = User::getData($user);
        if(!isset($userData->individual) || $userData->individual->active)
            return view('profile.volunteer.individual',['user' => $user, 'data' => $userData] );
        else
            return view('profile.volunteer.org', ['user' => $user,'data' => $userData]);
    }
}
