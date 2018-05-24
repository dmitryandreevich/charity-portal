<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 10:32
 */

namespace App\Http\Controllers\Profile;


use App\Classes\Utils;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{

    /**
     * Show index page profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        $userData = User::getData($user);
        if(!isset($userData->individual) || $userData->individual->active)
            return view('profile.donor.individual',['user' => $user, 'data' => $userData] );
        else
            return view('profile.donor.org', ['user' => $user,'data' => $userData]);
    }


}