<?php

namespace App\Http\Controllers\Profile;

use App\Classes\FbApiHelper;
use App\Classes\VkApiHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * Attach vk
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vkAttach(Request $request){

        $vkApiHelper = new VkApiHelper();
        $at = $vkApiHelper->getAccessData($request->input('code'), route('profile.vkAttach'));

        $user = Auth::user();
        $user->vkId = $at['user_id'];
        $user->save();
        // Attach signal
        return redirect()->back()->with('success', 'Аккаунт Вконтакте был успешно привязан!');
    }

    /**
     * Attach facebook
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fbAttach(Request $request){
        $fbApiHelper = new FbApiHelper();
        $at = $fbApiHelper->getAccessData($request->input('code'), route('profile.fbAttach'));

        $data = $fbApiHelper->getInfoUser($at['access_token']);

        $user = Auth::user();
        $user->fbId = $data['id'];
        $user->save();
        // Attach signal
        return redirect()->back()->with('success', 'Аккаунт Facebook был успешно привязан!');

    }
}
