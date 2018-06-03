<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\TypeOfUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('dashboard.users.index', ['users' => $users]);
    }
    public function show(User $user){
        $data = User::getData($user);

        switch ($user->type){
            case TypeOfUser::CONSUMER:{
                return view('dashboard.users.consumer.main', ['data' => $data, 'user' => $user]);
            }
            case TypeOfUser::DONOR:{
                if(!isset($data->individual) || $data->individual->active)
                    return view('dashboard.users.donor.individual',['user' => $user, 'data' => $data] );
                else
                    return view('dashboard.users.donor.org', ['user' => $user,'data' => $data]);
            }
            case TypeOfUser::VOLUNTEER:{
                if(!isset($data->individual) || $data->individual->active)
                    return view('dashboard.users.volunteer.individual',['user' => $user, 'data' => $data] );
                else
                    return view('dashboard.users.volunteer.org', ['user' => $user,'data' => $data]);
            }
        }
    }
}
