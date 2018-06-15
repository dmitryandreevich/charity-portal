<?php

namespace App\Http\Controllers\Auth;

use App\Classes\FbApiHelper;
use App\Classes\Utils;
use App\Classes\ValidateMessages;
use App\Classes\VkApiHelper;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|max:2',
        ], ValidateMessages::REGISTER);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $dataTemplate = Utils::getUserDataJsonTemplate();
        $dataTemplate['individual']['active'] = true;
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $data['typeOfUser'],
            'data' => json_encode($dataTemplate)
        ]);
    }

    public function ajaxRegister(Request $request){
        $credentials = $request->only(['email', 'password', 'password_confirmation', 'type']);

        $v = $this->validator($credentials);

        if($v->fails()) {
            $error = $v->messages()->toJson();
            return json_encode(['status' => 400, 'messages' => $error]);
        }
        $dataTemplate = Utils::getUserDataJsonTemplate();
        $dataTemplate['individual']['active'] = true;

        $credentials['data'] = json_encode($dataTemplate);
        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);

        Auth::login($user);

        return json_encode(['status' => 200, $request->all()]);
    }
    /**
     * Registration by user in VK
     *
     * @param Request $request
     */
    public function registerByVk(Request $request)
    {
        try{
            $typeOfUser = $request->session()->get('typeOfUser');
            $vkApiHelper = new VkApiHelper();
            $at = $vkApiHelper->getAccessData($request->input('code'), route('register.vk'));
        }catch (\Exception $exception){
            return redirect('/')->with('error', 'Произошла ошибка при получении данных VK API!');
        }
        $data = $vkApiHelper->getInfoUser($at['access_token']);

        // шаблон json объекта, для хранения всех второстепенных данных пользователя
        $dataTemplate = Utils::getUserDataJsonTemplate();
        $dataTemplate['individual']['active'] = true;
        try {
            $user = User::create([
                'email' => isset($at['email']) ? $at['email'] : "",
                'vkId' => $at['user_id'],
                'type' => $typeOfUser,
                'data' => json_encode($dataTemplate)
            ]);

            $request->session()->remove('typeOfUser');

            Auth::login($user);

            return redirect('/')->with('success', ' Вы успешно зарегистрировались!');
        } catch (QueryException $exception) {
            $request->session()->remove('typeOfUser');

            return redirect('/')->with('error', 'Произошла ошибка. Данный Email или VK уже привязаны!');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function registerByFb(Request $request){
        $typeOfUser = $request->session()->get('typeOfUser');
        try{
            $fbApiHelper = new FbApiHelper();
            $at = $fbApiHelper->getAccessData( $request->input('code'), route('register.fb') );

            $data = $fbApiHelper->getInfoUser($at['access_token']);
        }catch (\Exception $exception){
            return redirect('/')->with('error', 'Произошла ошибка при получении данных Facebook API!');
        }
        // шаблон json объекта, для хранения всех второстепенных данных пользователя
        $dataTemplate = Utils::getUserDataJsonTemplate();
        $dataTemplate['individual']['active'] = true;
        try{
            $user = User::create([
                'email' => isset($data['email']) ? $data['email'] : '',
                'fbId' => $data['id'],
                'type' => $typeOfUser,
                'data' => json_encode($dataTemplate)
            ]);

            Auth::login($user);

            $request->session()->remove('typeOfUser');

            return redirect('/')->with('success', ' Вы успешно зарегистрировались. Можете войти!');
        }catch (QueryException $exception){
            $request->session()->remove('typeOfUser');

            return redirect('/')->with('error', 'Произошла ошибка. Данный Email или Facebook уже привязаны!');
        }

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
}
