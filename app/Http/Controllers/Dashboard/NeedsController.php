<?php

namespace App\Http\Controllers\Dashboard;

use App\Need;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NeedsController extends Controller
{
    public function index(){
        $needs = Need::all();

        return view('dashboard.needs', ['needs' => $needs]);
    }
}
