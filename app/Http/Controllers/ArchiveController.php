<?php

namespace App\Http\Controllers;

use App\Classes\StatusOfNeed;
use App\Need;
use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index(Organization $organization){
        // показ определённой организации
        // вернуть массив путей фотографий
        $id = $organization->id;
        $photos = Storage::allFiles("/public/organizations/$id/photos/");
        foreach ($photos as $key => $photo)
            $photos[$key] = str_replace('public', 'storage', $photo);
        $needs = Need::where('id_org', $organization->id)->where('status', StatusOfNeed::STATUS_ARCHIVE)->get();
        // Если организацию просматривает волонтёр

        /*if(Auth::user()->type == TypeOfUser::VOLUNTEER){
            $needIds = $needsBuilder->where('type_need', TypeOfNeed::VOLUNTEERS)->pluck('id')->toArray();

            $volHistory = HistoryOfVolunteering::where('id_vol', Auth::id())
                ->whereIn('id_need', $needIds)->get();

            foreach ($needs as $i => $need) {
                foreach($volHistory as $j => $history){
                    if($need->id == $history->id_need)
                        $needs[$i]->isVolunteer = true;
                }
            }
        }*/


        return view('organization.archive',
            ['organization' => $organization,
                'photos' => $photos,
                'needs' => $needs]
        );
    }
}
