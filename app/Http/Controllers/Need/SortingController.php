<?php

namespace App\Http\Controllers\Need;

use App\Classes\TypeOfUser;
use App\Need;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SortingController extends Controller
{
    public function show(Request $request){
        $v = Validator::make($request->all(),
            ['status' => 'integer',
                'organizationId' => 'integer',
                'typeOfNeed' => 'integer']);
        if($v->fails())
            return 'errors';

        $orgId = $request->get('organizationId');
        $status = $request->get('status');
        $typeOfNeed = $request->get('typeOfNeed');

        switch (Auth::user()->type){
            case TypeOfUser::DONOR: {
                $needs = User::getNeedsWithDonateByUser( Auth::user() );
                $filtered = $this->filter($needs, $orgId, $status);

                return view('profile.donor.blocks.needsContent',['needs' => $filtered]);
            }
            case TypeOfUser::CONSUMER:{
                $needs = User::getAllConsumerNeeds( Auth::user() );
                $filtered = $this->filter($needs, $orgId, $status, $typeOfNeed);

                return view('profile.consumer.blocks.needsContent', ['needs' => $filtered]);
            }
            case TypeOfUser::VOLUNTEER:{
                $needs = User::getAllNeedsWhereIsVolunteer( Auth::user() );
                $filtered = $this->filter($needs, $orgId, $status);

                return view('profile.volunteer.blocks.needsContent', ['needs' => $filtered]);
            }
        }
    }
    protected function filter($needs, $orgId, $status, $typeOfNeed = null, $typeDonor = null){
        $filtered = collect($needs);

        if( isset($orgId) )
            $filtered = $filtered->filter(function($need, $key) use($orgId){
                return $need->id_org == $orgId;
            });

        if( isset($status) )
            $filtered = $filtered->filter(function ($need) use ($status){
                return $need->status == $status;
            });

        if( isset($typeOfNeed) )
            $filtered = $filtered->filter(function ($need) use ($typeOfNeed){
                return $need->type_need == $typeOfNeed;
            });
        return $filtered;
    }
}
