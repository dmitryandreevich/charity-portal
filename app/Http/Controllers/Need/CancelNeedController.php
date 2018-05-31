<?php

namespace App\Http\Controllers\Need;

use App\Classes\StatusOfNeed;
use App\Classes\TypeOfNeed;
use App\HistoryOfDonate;
use App\Need;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CancelNeedController extends Controller
{
    public function store(Request $request){
        if(! $request->has('need_data') )
            return redirect()->back()->with('error','Произошла ошибка! Попробуйте ещё раз.');

        $needId = $request->get('need_data');
        $need = Need::find($needId);

        switch ($need->type_need){
            case TypeOfNeed::VOLUNTEERS:{
                StatusOfNeed::setStatusNeed($need, StatusOfNeed::STATUS_ARCHIVE);
                break;
            }
            case TypeOfNeed::COLLECT_MONEY:{
                $rBuilder = HistoryOfDonate::where('id_need', $need->id);

                $histories = $rBuilder->get();

                $userIds = $rBuilder->pluck('id_sender')->toArray();

                $users = User::whereIn('id', $userIds)->get();

                for($i = 0; $i < count($users); $i++ ){
                    for($j = 0; $j< count($histories); $j++){
                        // если была найдена история доната этого пользователя и этот донат ещё не был возвращён
                        if($users[$i]->id == $histories[$j]->id_sender && !$histories[$j]->returned){
                            $users[$i]->balance += $histories[$j]->amount;
                            $users[$i]->save();

                            $histories[$j]->returned = true;
                            $histories[$j]->save();

                            break;
                        }
                    }
                }
                StatusOfNeed::setStatusNeed($need, StatusOfNeed::STATUS_ARCHIVE);

                break;
            }
        }
        return redirect()->back()->with('success','Вы успешно отменили потребность. Все средства возвращены обратно!');
    }
}
