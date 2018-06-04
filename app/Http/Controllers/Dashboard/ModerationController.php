<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\StatusOfNeed;
use App\Classes\StatusOfOrganization;
use App\Need;
use App\Organization;
use App\Report;
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
    public function orgBlock(Organization $organization){
        $organization->status = StatusOfOrganization::DISABLED_BY_MODERATOR;
        $organization->save();

        return redirect()->back()->with('success', 'Организация была отклонена');
    }
    public function orgUnBlock(Organization $organization){
        $organization->status = StatusOfOrganization::ENABLED;
        $organization->save();

        return redirect()->back()->with('success', 'Организация была разблокирована.');
    }
    public function needBlock(Need $need){
        $need->status = StatusOfNeed::STATUS_BLOCK;
        $need->save();

        $reports = Report::where('id_need', $need->id)->get();
        foreach ($reports as $report)
            $report->delete();

        return redirect()->back()->with('success', 'Потребность была заблокирована');
    }
    public function needUnBlock(Need $need){
        $need->status = StatusOfNeed::STATUS_ACTUAL;
        $need->save();

        return redirect()->back()->with('success', 'Потребность была разблокирована');
    }

}
