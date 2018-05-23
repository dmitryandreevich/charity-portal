<?php

namespace App\Http\Controllers\Auth;

use App\Classes\FbApiHelper;
use App\Classes\VkApiHelper;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Logout of account
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Login into account with VK
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function loginByVk(Request $request){
        $vkApiHelper = new VkApiHelper();
        try{
            // проверить если нет доступа к мылу
            $at = $vkApiHelper->getAccessData( $request->input('code'),route('login.vk') );
            $user = User::where('vkId', $at['user_id'])->first();
            if($user !== null){
                Auth::login($user);

                return redirect($this->redirectTo);
            }
            return redirect($this->redirectTo);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
    public function loginByFb(Request $request){
        $fbApiHelper = new FbApiHelper();
        try{
            $at = $fbApiHelper->getAccessData( $request->input('code'),route('login.fb') );
            $data = $fbApiHelper->getInfoUser($at['access_token']);
            $user = User::where('fbId', $data['id'])->first();
            if($user !== null){
                Auth::login($user);

                return redirect($this->redirectTo);
            }
            return redirect($this->redirectTo);
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }
}
