<?php

namespace App\Http\Controllers\Need;

use App\Classes\StatusOfNeed;
use App\Classes\StatusOfOrganization;
use App\Classes\TypeOfNeed;
use App\Classes\TypeOfUser;
use App\HistoryOfDonate;
use App\Http\Controllers\Controller;
use App\Need;
use App\Organization;
use App\User;
use App\WithdrawMoneyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Auth::user();

        switch ($user->type){
            case TypeOfUser::DONOR:{

                $needs = User::getNeedsWithDonateByUser($user);
                $orgs = User::getOrgsWithDonateByUser($user);

                return view('profile.donor.needs', ['needs' => $needs, 'organizations' => $orgs]);

            }
            case TypeOfUser::CONSUMER:{
                $orgBuilder = Organization::where('creator', Auth::id());
                $orgIds = $orgBuilder->pluck('id')->toArray();

                $needs = Need::whereIn('id_org', $orgIds)->get();
                $orgs = $orgBuilder->get();

                $withdrawRequests = WithdrawMoneyRequest::whereIn('id_need', $needs->pluck('id')->toArray() )->get();

                for($i = 0; $i < count($needs); $i++){
                    for($j = 0; $j < count($withdrawRequests); $j++){
                        if($needs[$i]->id == $withdrawRequests[$j]->id_need){
                            $needs[$i]->is_paid = $withdrawRequests[$j]->is_paid;
                            continue;
                        }
                    }
                }

                for($i = 0; $i < count($orgs); $i++){
                    for($j = 0; $j < count($needs); $j++){
                        if($needs[$j]->id_org == $orgs[$i]->id){
                            $needs[$j]->orgName = $orgs[$i]->name;
                            continue;
                        }
                    }
                }
                return view('profile.consumer.needs', ['needs' => $needs, 'organizations' => $orgs]);
            }
            case TypeOfUser::VOLUNTEER:{
                $orgs = User::getAllOrgsWhereIsVolunteer($user);
                $needs = User::getAllNeedsWhereIsVolunteer($user);

                return view('profile.volunteer.needs', ['needs' => $needs, 'organizations' => $orgs]);
            }
        }
        return redirect()->back()->with('error', 'Произошла ошибка!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::where('creator', Auth::id())->where('status', StatusOfOrganization::ENABLED)->get();

        return view('need.new',['orgs' => $organizations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typeNeed = $request->get('type_need');
        if($typeNeed == TypeOfNeed::VOLUNTEERS){
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:5|max:100',
                'organization' => 'required|integer',
                'date_time' => 'required|string|max:180',
                'count_vols' => 'required|integer',
                'description' => 'required|min:20|max:500',
                'cover' => 'required|image|max:5120',
                'doc' => 'required|file|max:5120',
            ]);
            if($validator->fails())
                return redirect()->back()->withErrors($validator);

        }elseif ($typeNeed == TypeOfNeed::COLLECT_MONEY){

            $validator = Validator::make($request->all(), [
               'title' => 'required|min:5|max:100',
                'organization' => 'required|integer',
                'amount' => 'required|integer',
                'description' => 'required|min:20|max:500',
                'cover' => 'required|image|max:5120',
                'doc' => 'required|file|max:5120',
                'link' => 'required|string|max:189'
            ]);
            if($validator->fails())
                return redirect()->back()->withErrors($validator);
        }
        // получаем индекс последней потребности для генерации папки
        $latestOrg = Need::all()->last();
        $nextNeedId = (isset($latestOrg) ? $latestOrg->id + 1 : 1);

        // какой будет путь до папки
        $orgPath = "/public/needs/$nextNeedId";

        // генерация имени фала и создание его
        $cover = $request->file('cover');
        $coverName = 'cover.' . $cover->getClientOriginalExtension();
        $coverContent = file_get_contents( $cover->getRealPath() );
        Storage::put("$orgPath/$coverName", $coverContent);

        // генерация имени фала и создание его
        $docs = $request->file('doc');
        $docName = 'document.' . $docs->getClientOriginalExtension();
        $docsContent = file_get_contents($docs->getRealPath());
        Storage::put("$orgPath/$docName", $docsContent);

        $fieldsToCreate = [
            'title' => $request->get('title'),
            'id_org' => $request->get('organization'),
            'type_need' => $typeNeed,
            'description' => $request->get('description'),
            'link' => $request->get('link'),
            'cover_path' => "needs/$nextNeedId/$coverName",
            'doc_path' => "needs/$nextNeedId/$docName"
        ];
        if($typeNeed == TypeOfNeed::COLLECT_MONEY)
            $fieldsToCreate['amount'] = $request->get('amount');
        elseif ($typeNeed == TypeOfNeed::VOLUNTEERS){
            $fieldsToCreate['count_vols'] = $request->get('count_vols');
            $fieldsToCreate['date_time'] = $request->get('date_time');
        }

        Need::create($fieldsToCreate);

        return redirect( route('organizations.index') )->with('success', 'Постребность успешно создана!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Need  $need
     * @return \Illuminate\Http\Response
     */
    public function show(Need $need)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Need  $need
     * @return \Illuminate\Http\Response
     */
    public function edit(Need $need)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Need  $need
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Need $need)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Need  $need
     * @return \Illuminate\Http\Response
     */
    public function destroy(Need $need)
    {
        //
    }
}
