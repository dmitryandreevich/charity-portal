<?php

namespace App\Http\Controllers\Dashboard;

use App\WithdrawMoneyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    //
    public function index(){
        $requests = WithdrawMoneyRequest::where('is_paid', false)->get();

        return view('dashboard.payments', ['requests' => $requests]);
    }

}
