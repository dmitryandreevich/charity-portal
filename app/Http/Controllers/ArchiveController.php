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
        $needs = Need::where('id_org', $id)->where('status', StatusOfNeed::STATUS_ARCHIVE)
            ->orWhere('id_org', $id)
            ->where('status', StatusOfNeed::STATUS_COLLECTED)->get();


        return view('organization.archive',
            ['organization' => $organization,
                'photos' => $photos,
                'needs' => $needs]
        );
    }
}
