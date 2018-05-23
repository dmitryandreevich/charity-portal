<?php

namespace App\Http\Controllers\Auth;

use App\Classes\FbApiHelper;
use App\Classes\VkApiHelper;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'typeOfUser' => 'required|max:2'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $data['typeOfUser'],
        ]);
    }
    // Узнаём какая кнопка была нажата, какой тип пользователя был выбран
    public function getSocialAccess(Request $request){
        $request->session()->put('typeOfUser', $request->input('typeOfUser'));
        if($request->has('vkAuth')){
            // ложим в сессию тип выбранного пользователя
            return redirect( VkApiHelper::getLinkAuthCode( route('register.vk') ) );
        } elseif ($request->has('fbAuth')){
            return redirect( FbApiHelper::getLinkAuthCode( route('register.fb') ) );
        }
    }

    /**
     * Registration by user in VK
     *
     * @param Request $request
     */
    public function registerByVk(Request $request)
    {
        $typeOfUser = $request->session()->get('typeOfUser');
        $vkApiHelper = new VkApiHelper();
        $at = $vkApiHelper->getAccessData($request->input('code'), route('register.vk'));

        $data = $vkApiHelper->getInfoUser($at['access_token']);
        try {
            User::create([
                'email' => isset($at['email']) ? $at['email'] : "",
                'vkId' => $at['user_id'],
                'type' => $typeOfUser
            ]);
            $request->session()->remove('typeOfUser');

            return redirect('/catalog');
        } catch (QueryException $exception) {
            $request->session()->remove('typeOfUser');

            return redirect('/');
            // not unique email address or vkid
        }
    }
    public function registerByFb(Request $request){

        $typeOfUser = $request->session()->get('typeOfUser');
        $fbApiHelper = new FbApiHelper();
        $at = $fbApiHelper->getAccessData( $request->input('code'), route('register.fb') );

        $data = $fbApiHelper->getInfoUser($at['access_token']);
        try{
            User::create([
                'email' => isset($data['email']) ? $data['email'] : '',
                'fbId' => $data['id'],
                'type' => $typeOfUser
            ]);
            $request->session()->remove('typeOfUser');

            return redirect('/catalog');
        }catch (QueryException $exception){
            $request->session()->remove('typeOfUser');

            return $exception->getMessage();
            // not unique email address or fbid
        }

    }
}
