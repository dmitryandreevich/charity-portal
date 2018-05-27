<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index(){
        return view('catalog');
    }
    public function sort(Request $request){

        $typeOrg = $request->get('typeOrg');
        $typeNeed = $request->get('typeNeed');
        $city = $request->get('city');

        $orgs = Organization::where($request->all())->get();

        return count($orgs);
    }
}
