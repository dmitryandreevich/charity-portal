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
                'organizationId' => 'integer']);
        if($v->fails())
            return 'errors';

        $orgId = $request->get('organizationId');
        $status = $request->get('status');

        switch (Auth::user()->type){
            case TypeOfUser::DONOR: {
                $needs = User::getNeedsWithDonateByUser( Auth::user() );
                $filtered = $this->filter($needs, $orgId, $status);
                return view('profile.donor.blocks.needsContent',['needs' => $filtered]);
                //return $this->donorNeedsFilter($orgId, $status);
            }
            case TypeOfUser::CONSUMER:{
                $needs = User::getAllConsumerNeeds( Auth::user() );

                $filtered = $this->filter($needs, $orgId, $status);

                return view('profile.consumer.blocks.needsContent', ['needs' => $filtered]);
            }

        }
    }



    protected function consumerNeedsFilter($orgId, $status){



    }
    protected function filter($needs, $orgId, $status, $typeDonor = null){
        $filtered = collect([]);

        if( isset($orgId) )
            $filtered = $needs->filter(function($need, $key) use($orgId){
                return $need->id_org == $orgId;
            });

        if( isset($status) )
            $filtered = $needs->filter(function ($need) use ($status){
                return $need->status == $status;
            });

        return $filtered;
    }
}
