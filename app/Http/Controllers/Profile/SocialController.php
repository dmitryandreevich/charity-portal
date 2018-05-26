<?php

namespace App\Http\Controllers\Profile;

use App\Classes\FbApiHelper;
use App\Classes\VkApiHelper;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        // not isset in table
        if(User::where('vkId', $at['user_id'])->first() == null){
            $user = Auth::user();
            $user->vkId = $at['user_id'];
            $user->save();
            // Attach signal
            return redirect()->back()->with('success', 'Аккаунт Вконтакте был успешно привязан!');
        }

        return redirect()->back()->with('error', 'Данный аккаунт Вконтакте уже привязан к системе!');
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
        if(User::where('fbId', $data['id'])->first() == null) {
            $user = Auth::user();
            $user->fbId = $data['id'];
            $user->save();
            // Attach signal
            return redirect()->back()->with('success', 'Аккаунт Facebook был успешно привязан!');
        }
        return redirect()->back()->with('error', 'Данный аккаунт Facebook уже привязан к системе!');
    }
}
