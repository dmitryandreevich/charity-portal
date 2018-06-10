<?php

namespace App\Http\Controllers;

use App\Classes\StatusOfNeed;
use App\Classes\StatusOfOrganization;
use App\Need;
use App\Organization;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $realizedNeeds = Need::where('status', StatusOfNeed::STATUS_COLLECTED)->limit(8)->get();
        $orgs = Organization::where('status', StatusOfOrganization::ENABLED)->limit(8)->get();

        for ($i = 0; $i < count($realizedNeeds); $i++)
            $realizedNeeds[$i]->orgCity = $realizedNeeds[$i]->getParentOrganization()->city;

        return view('home', [
            'realizedNeeds' => $realizedNeeds,
            'organizations' => $orgs
        ]);
    }
}
