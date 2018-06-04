<?php

namespace App\Http\Controllers\Dashboard;

use App\Need;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request){

        $this->validate($request, ['searchAttr' => 'required', 'page' => 'required']);

        $searchAttr = $request->get('searchAttr');
        $page = $request->get('page');

        switch ($page){
            case 'users':{
                $users = User::where('email', 'regexp', "\\$searchAttr")
                            ->orWhere('phone', 'regexp', "\\$searchAttr")
                            ->orWhere('id', '=', $searchAttr)
                            ->orWhere('city', 'regexp', "\\$searchAttr")->get();


                return view('dashboard.blocks.tableUsers', ['users' => $users]);
            }

            case 'organizations':{
                $orgs = Organization::where('address', 'regexp', "\\$searchAttr")
                    ->orWhere('name', 'regexp', "\\$searchAttr")
                    ->orWhere('description', 'regexp', "\\$searchAttr")
                    ->orWhere('id', '=', $searchAttr)
                    ->orWhere('city', 'regexp', "\\$searchAttr")->get();

                return view('dashboard.blocks.tableOrganizations', ['orgs' => $orgs]);

            }

            case 'needs':{
                $needs = Need::where('title', 'regexp', "\\$searchAttr")
                    ->orWhere('link', 'regexp', "\\$searchAttr")
                    ->orWhere('description', 'regexp', "\\$searchAttr")
                    ->orWhere('id', '=', $searchAttr)
                    ->orWhere('amount', '=', $searchAttr)
                    ->orWhere('collected', '=', $searchAttr)
                    ->orWhere('id_org', '=', $searchAttr)->get();

                return view('dashboard.blocks.tableNeeds', ['needs' => $needs]);
            }
        }
    }
}
