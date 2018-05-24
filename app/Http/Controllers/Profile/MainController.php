<?php

namespace App\Http\Controllers\Profile;

use App\Classes\TypeOfUser;
use App\Classes\Utils;
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
                return 'consumer';
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

        //$request->validate([
        //    'email' => 'email|unique:users'
        //]);
        // фильтруем ключи по белому списку
        $data = $request->only($this->whiteListKeys);
        // шаблон json строки
        $dataTemplate = Utils::getUserDataJsonTemplate();
        // если выбран тип аккаунта - организация
        if(array_key_exists('organization', $request->input())){
            $dataTemplate['organization']['data'] = $data;

        } elseif(array_key_exists('individual', $request->input())){
            $dataTemplate['individual']['data'] = $data;
        }
        Auth::user()->update([
            'data' => json_encode($dataTemplate),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city')
        ]);

        // validate
        return redirect()->back()->with('success','Изменения были успешно сохранены!');
    }
    public function toggle(Request $request){

    }
}
