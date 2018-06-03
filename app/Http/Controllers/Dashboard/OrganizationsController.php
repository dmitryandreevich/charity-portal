<?php

namespace App\Http\Controllers\Dashboard;

use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizationsController extends Controller
{
    public function index(){
        $orgs = Organization::all();

        return view('dashboard.organizations', ['orgs' => $orgs]);
    }
}
