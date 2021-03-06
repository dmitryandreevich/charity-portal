<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 24.05.2018
 * Time: 10:32
 */

namespace App\Http\Controllers\Profile;


use App\Classes\StatusOfNeed;
use App\Classes\TypeOfDonate;
use App\Classes\Utils;
use App\Classes\ValidateMessages;
use App\HistoryOfDonate;
use App\HistoryOfMaterialDonate;
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

        if ($request->get('type') == 'financeSend'){
            $validator = Validator::make($request->all(),
                [
                    'need_data' => 'required|integer',
                    'amount' => 'required|integer|between:1,100000'
                ], ValidateMessages::DONOR_DONATION_FINANCE);

            if($validator->fails()) {
                $error = $validator->messages()->toJson();
                return json_encode(['status' => 400, 'messages' => $error]);
            }

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
                        return json_encode(['status' => 400, 'messages' => json_encode(['Введённая сумма больше нужной!']) ]);

                    $user->balance -= $amount;
                    $need->collected += $amount;

                    if($need->collected >= $need->amount)
                        $need->status = StatusOfNeed::STATUS_COLLECTED;
                    //save donate to history
                    HistoryOfDonate::create([
                        'id_sender' => $user->id,
                        'id_need' => $need->id,
                        'amount' => $amount,
                        'id_org' => $need->id_org,
                        'type' => TypeOfDonate::FINANCE
                    ]);

                    $user->save();
                    $need->save();

                    //session('success', 'Вы успешно пожертвовали сумму денег!');
                    return json_encode(['status' => 200]);
                }
                return json_encode(['status' => 400, 'messages' => json_encode(['У вас недостаточно средств!']) ]);
            }
        }elseif ( $request->get('type') == 'materialSend' ){
            $validator = Validator::make($request->all(),
                ['need_data' => 'required|integer',
                    'info' => 'required'
                ], ValidateMessages::DONOR_DONATION_MATERIAL);

            if($validator->fails()) {
                $error = $validator->messages()->toJson();
                return json_encode(['status' => 400, 'messages' => $error]);
                //return redirect()->back()->withErrors($validator);
            }
            $info = $request->get('info');

            $need = Need::find( $request->get('need_data') );

            $creatorEmail = $need->getCreatorEmail();

            mail($creatorEmail, "Заявка на материальное пожертвование.", "Здравствуйте! Вам пришла новая заявка на материальное пожертвование. Текст\n" . $info);

            HistoryOfDonate::create([
                'id_sender' => Auth::id(),
                'id_need' => $need->id,
                'id_org' => $need->id_org,
                'materialDonateInfo' => $info,
                'type' => TypeOfDonate::MATERIAL
            ]);
           // session('success', 'Вы успешно отправили заявку!');

            return json_encode(['status' => 200]);

        }

        return json_encode(['status' => 400, 'messages' => json_encode(['Произошла ошибка, попробуйте ещё раз!']) ]);
    }
}

