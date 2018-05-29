<?php

namespace App\Http\Controllers;

use App\Need;
use App\Organization;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index(){
        $organizations = Organization::all();
        return view('catalog.index', ['organizations' => $organizations]);
    }
    public function sort(Request $request){

        $typeOrg = $request->get('typeOrg');
        $typeNeed = $request->get('typeNeed');
        $city = $request->get('city');
        $rules = [];
        if(isset($typeOrg))
            $rules['type_consumer'] = $typeOrg;
        if(isset($city))
            $rules['city'] = $city;

        $orgsBuilder = Organization::where($rules);

        // if 0 then any type need
        if(isset($typeNeed) && $typeNeed != 0){
            // get organizations ids by filter
            $org_ids = $orgsBuilder->pluck('id')->toArray();
            // get needs by organizations
            $orgIdsWithNeedType = Need::whereIn('id_org', $org_ids)->where('type_need', $typeNeed)
                                                                    ->pluck('id_org')->toArray();
            // delete duplicate ids
            $org_ids = array_unique($orgIdsWithNeedType);
            // get organizations with type need
            $organizations = Organization::whereIn('id', $org_ids)->get();
            //ддополнить массив ключами типо : things->true, false для сортировки
            return count($organizations);
        }

        $organizations = $orgsBuilder->get();
        return count($organizations);
    }
}
