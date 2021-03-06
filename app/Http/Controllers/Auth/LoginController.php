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
    public function showLoginForm()
    {
        return view('auth.login');
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
     * Login with ajax
     * @param Request $request
     * @return string
     */
    public function ajaxLogin(Request $request){

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials))
            return json_encode(['status' => 200, 'message' => ''] );
        else
            return json_encode(['status' => 400, 'message' => 'Введённый email или пароль неверны!'] );
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

            return redirect()->back()->with('error', 'Данный аккаунт не зарегистрирован!');
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage() );
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
    public function guestPage(){
        return 'true;';
    }
}
