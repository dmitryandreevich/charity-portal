<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(Request $request){
        $this->validate($request, ['image' => 'image|max:5240']);

        $user = Auth::user();
        // delete avatar if he is exist
        Storage::deleteDirectory("public/avatars/$user->id");

        $file = $request->file('image');
        $aName = time()."_avatar.".$file->getClientOriginalExtension();
        $fileContent = file_get_contents( $file->getRealPath() );

        Storage::put("public/avatars/$user->id/$aName", $fileContent);

        $user->avatar = "avatars/$user->id/$aName";
        $user->save();

        return redirect( route('profile.index') );
    }
}
