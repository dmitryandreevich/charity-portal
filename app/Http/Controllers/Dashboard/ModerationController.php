<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\StatusOfNeed;
use App\Classes\StatusOfOrganization;
use App\Need;
use App\Organization;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModerationController extends Controller
{
    public function index(){
        $orgs = Organization::where('status', StatusOfOrganization::DISABLED)->get();

        $reports = Report::all();

        $ids = $reports->pluck('id_need')->toArray();

        $needs = Need::whereIn('id', $ids)->get();


        return view('dashboard.moderation',
            ['organizations' => $orgs,
                'reports' => $reports,
                'needs' => $needs]);
    }
    public function orgApply(Organization $organization){
        $organization->status = StatusOfOrganization::ENABLED;
        $organization->save();

        return redirect()->back()->with('success', 'Организация была опубликована');
    }
    public function orgBlock(Request $request){
        $this->validate($request,['need_data' => 'required|integer', 'message' => 'required']);

        $organization = Organization::find( $request->get('need_data') );
        $organization->status = StatusOfOrganization::DISABLED_BY_MODERATOR;
        $organization->save();

        $userEmail = User::where('id', $organization->creator)->pluck('email')->first();
        if( $userEmail )
            mail($userEmail, "Администрация портала", "Ваша организация '$organization->name' была заблокирована по причине\n" . $request->get('message'));

        return redirect()->back()->with('success', 'Организация была отклонена');
    }
    public function orgUnBlock(Organization $organization){
        $organization->status = StatusOfOrganization::ENABLED;
        $organization->save();

        return redirect()->back()->with('success', 'Организация была разблокирована.');
    }
    public function needBlock(Request $request){
        $this->validate($request,['need_data' => 'required|integer', 'message' => 'required']);

        $need = Need::find( $request->get('need_data') );
        $need->status = StatusOfNeed::STATUS_BLOCK;
        $need->save();

        $reports = Report::where('id_need', $need->id)->get();
        foreach ($reports as $report)
            $report->delete();

        $creatorId = Organization::where('id', $need->id_org)->pluck('creator')->first();
        if( $creatorId ){
            $userEmail = User::where('id', $creatorId)->pluck('email')->first();
            if( $userEmail )
                mail($userEmail, "Администрация портала", "Ваша потребность '$need->title' была заблокирована по причине\n " . $request->get('message'));
        }

        return redirect()->back()->with('success', 'Потребность была заблокирована');
    }
    public function needUnBlock(Need $need){
        if($need->collected >= $need->amount || $need->collected >= $need->count_vols)
            $need->status = StatusOfNeed::STATUS_COLLECTED;
        else
            $need->status = StatusOfNeed::STATUS_ACTUAL;

        $need->save();

        return redirect()->back()->with('success', 'Потребность была разблокирована');
    }

    public function reportDelete(Report $report){
        try {
            $report->delete();
        } catch (\Exception $e) {

        }

        return redirect()->back()->with('success', 'Жалоба была удалена.');
    }

}
