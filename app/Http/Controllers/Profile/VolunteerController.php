<?php

namespace App\Http\Controllers\Profile;

use App\Classes\StatusOfNeed;
use App\Classes\ValidateMessages;
use App\HistoryOfVolunteering;
use App\Need;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VolunteerController extends Controller
{
    public function index(){
        $user = Auth::user();
        $userData = User::getData($user);
        if(!isset($userData->individual) || $userData->individual->active)
            return view('profile.volunteer.individual',['user' => $user, 'data' => $userData] );
        else
            return view('profile.volunteer.org', ['user' => $user,'data' => $userData]);
    }

    /**
     * Add one volunteer to need
     * @param Request $request
     */
    public function addVolunteer(Need $need){

        if(! isset($need) )
            return redirect()->back()->with('error','Ошибка! Не найдена потребность.');
        // осталось собрать волонтёров
        $leftVols = $need->count_vols - $need->collected;

        if($leftVols > 0){
            $need->collected++;
            $need->save();

            HistoryOfVolunteering::create([
                'id_vol' => Auth::id(),
                'id_need' => $need->id,
                'id_org' => $need->id_org
            ]);

            return redirect()->back()->with('success','Вы успешно стали волонтёром.');
        }
        return redirect()->back()->with('error','Ошибка! Для данной потребности больше не нужны волонтёры.');
    }

    /**
     * Add some volunteers to need
     * @param Request $request
     */
    public function addVolunteers(Request $request){
        $v = Validator::make($request->all(), [
            'count' => 'required|integer|between:1,10000',
            'need_data' => 'required|integer'
        ], ValidateMessages::VOLUNTEERS_ADD);

        if($v->fails()){
            return redirect()->back()->withErrors($v);
        }

        $need = Need::find( $request->get('need_data') );
        $leftVols = $need->count_vols - $need->collected;
        $countVols = $request->get('count');

        if($leftVols > 0 && $countVols <= $leftVols){

            $need->collected += $countVols ;

            if($need->collected >= $need->count_vols)
                $need->status = StatusOfNeed::STATUS_COLLECTED;

            $need->save();

            HistoryOfVolunteering::create([
                'id_vol' => Auth::id(),
                'id_need' => $need->id,
                'amount' => $countVols,
                'id_org' => $need->id_org
            ]);

            return redirect()->back()->with('success','Ваша организация успешно стала волонтёрами.');
        }
        return redirect()->back()->with('error','Ошибка! Для данной потребности больше не нужны волонтёры.');
    }
}
