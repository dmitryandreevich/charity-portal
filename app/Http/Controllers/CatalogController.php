<?php

namespace App\Http\Controllers;

use App\Classes\StatusOfNeed;
use App\Classes\StatusOfOrganization;
use App\Need;
use App\Organization;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index(){
        $organizations = Organization::where('status', StatusOfOrganization::ENABLED)->get(); // ?????????????????????????????
        return view('catalog.index', ['organizations' => $organizations]);
    }
    public function sort(Request $request){

        $typeOrg = $request->get('typeOrg');
        $typeNeed = $request->get('typeNeed');
        $city = $request->get('city');
        $sortBy = $request->get('sortBy');

        $organizations = Organization::all();

        $formated = $this->format($organizations, $city, $typeNeed, $typeOrg, $sortBy);



        return view('catalog.blocks.organizations', ['organizations' => $formated]);
    }
    protected function format($orgs, $city, $typeOfNeed, $typeOfOrg, $sortBy = null){
        $filtered = collect($orgs);

        if( isset($city) )
            $filtered = $filtered->filter(function($org) use($city){
                return $org->city == $city;
            });

        if( isset($typeOfOrg) )
            $filtered = $filtered->filter(function ($org) use ($typeOfOrg){
                return $org->type_consumer == $typeOfOrg;
            });

        if( isset($typeOfNeed) ){
            $needs = Need::all();

            $filtered = $filtered->filter(function($item, $key) use ($needs, $typeOfNeed){
                return ($needs->where('id_org', $item->id)->where('type_need', $typeOfNeed)->first()) != null;
            });
        }

        if( isset($sortBy) ) {

            if($sortBy == 'date'){
               $filtered = $filtered->sortByDesc('created_at');
            }elseif ('actual_needs'){
                $needs = Need::all();
                $filtered = $filtered->sortByDesc(function($item) use($needs){
                    return count($needs->where('id_org', $item->id)->where('status', StatusOfNeed::STATUS_ACTUAL)->toArray());
                });
            }
        }

        return $filtered;
    }
}
