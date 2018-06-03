<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\StatusOfOrganization;
use App\Need;
use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModerationController extends Controller
{
    public function index(){
        $orgs = Organization::where('status', StatusOfOrganization::DISABLED)->get();
        $needs = Need::all();//
        return view('dashboard.moderation',
            ['organizations' => $orgs,
                'needs' => $needs]);
    }
}
