<?php

namespace App\Http\Controllers\Profile;

use App\Classes\TypeOfUser;
use App\Classes\Utils;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    /**
     * Valid keys for request data
     * @var array
     */
    protected $whiteListKeys = ['organization', 'individual', 'name','sec_name'
        ,'th_name','name_org', 'address_org',
        'inn', 'ogrn', 'bank', 'bik', 'ch_account', 'corp_account',
        'kpp', 'ceo'];
    /**
     * Choose controller
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();

        switch ($user->type){
            case TypeOfUser::DONOR:{
                return (new DonorController())->index();
            }
            case TypeOfUser::CONSUMER:{
                return (new ConsumerController())->index();
                break;
            }
            case TypeOfUser::VOLUNTEER:{
                return 'volunteer;';
                break;
            }
        }
        return view('profile.donor');
    }
    /**
     * Update profile data
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){

        // Валидация на уникального этого email`a

        if(Auth::user()->email !== $request->get('email')){
            $validator = Validator::make($request->all(), [
                'email' => 'unique:users',
            ]);
            if($validator->fails())
                return redirect()->back()->withErrors($validator);
        }

        // фильтруем ключи по белому списку
        $data = $request->only($this->whiteListKeys);
        // шаблон json строки
        //$dataTemplate = Utils::getUserDataJsonTemplate();
        // существующие json данные
        $userData = json_decode(Auth::user()->data);
        // заполняем старыми данными массив, который потом преобразуется в json строку
        //$dataTemplate['organization'] = $userData->organization;
        //$dataTemplate['individual'] = $userData->individual;


        // если равен NULL, значит только зарегистрировался и нету никакой информации
        // если выбран тип аккаунта - организация
        if(array_key_exists('organization', $request->input())){
            //$dataTemplate['organization']['data'] = $data;
            $userData->organization->data = $data;
        } elseif(array_key_exists('individual', $request->input())){
            //    $dataTemplate['individual']['data'] = $data;
            $userData->individual->data = $data;
        }
        Auth::user()->update([
            'data' => json_encode($userData),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city')
        ]);

        // validate
        return redirect()->back()->with('success','Изменения были успешно сохранены!');
    }
    public function toggle(Request $request){
        $radioChecked = $request->get('radio');

        $user = Auth::user();
        $data = User::getData($user);
        if($radioChecked === 'individual'){
            $data->individual->active = true;
            $data->organization->active = false;
        }elseif($radioChecked === 'organization'){
            $data->individual->active = false;
            $data->organization->active = true;
        }
        $user->data = json_encode($data);
        $user->save();
        return redirect()->back();
    }
}
