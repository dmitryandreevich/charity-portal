<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 10:32
 */

namespace App\Http\Controllers\Profile;


use App\Classes\Utils;
use App\HistoryOfDonate;
use App\Http\Controllers\Controller;
use App\Need;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonorController extends Controller
{

    /**
     * Show index page profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        $userData = User::getData($user);
        if(!isset($userData->individual) || $userData->individual->active)
            return view('profile.donor.individual',['user' => $user, 'data' => $userData] );
        else
            return view('profile.donor.org', ['user' => $user,'data' => $userData]);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function donation(Request $request){
        $validator = Validator::make($request->all(),
            ['need_data' => 'required|integer',
                'amount' => 'required|integer']);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        $needId = $request->get('need_data');
        $amount = $request->get('amount');

        $user = Auth::user();

        $need = Need::where('id', $needId)->first();

        if( count($need) !== 0 ){
            $balance = $user->balance;
            if($balance >= $amount){
                // высчитываем сколько можно ещё пожертвовать
                $leftToDonate = $need->amount - $need->collected;

                // если эта сумма не больше требуемой, продолжаем
                if($amount > $leftToDonate)
                    return redirect()->back()->with('error', 'Введённая сумма больше нужной!');

                $user->balance -= $amount;
                $need->collected += $amount;
                //save donate to history
                HistoryOfDonate::create([
                    'id_sender' => $user->id,
                    'id_need' => $need->id,
                    'amount' => $amount,
                    'id_org' => $need->id_org
                ]);

                $user->save();
                $need->save();
                return redirect()->back()->with('success', 'Вы успешно пожертвовали деньг!');
            }
            return redirect()->back()->with('error', 'У вас недостаточно средств!');
        }
        return redirect()->back()->with('error', 'Произошла ошибка, попробуйте ещё раз!');
    }
}