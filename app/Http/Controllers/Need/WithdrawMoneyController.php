<?php

namespace App\Http\Controllers\Need;

use App\Need;
use App\WithdrawMoneyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithdrawMoneyController extends Controller
{
    public function store(Need $need){

        $user = Auth::user();

        $creator = $need->getCreator();

        if($user->id === $creator){

            WithdrawMoneyRequest::create([
                'id_need' => $need->id,
                'id_org' => $need->id_org,
                'id_sender' => $user->id,
                'amount' => $need->collected
            ]);

            return redirect()->back()->with('success', 'Заявка успешно отправлена. С вами свяжуться!');
        }

        return redirect()->back()->with('error', 'Произошла ошибка! Вы не создатель этой потребности/организации.');
    }
    public function markWithdraw($id){
        $request = WithdrawMoneyRequest::find($id);

        if($request) {
            $request->is_paid = true;
            $request->save();

            return redirect()->back()->with('success', 'Заявка успешно отмечена как оплачена.');
        }
        return redirect()->back()->with('error', 'Произошла ошибка!');
    }
}
