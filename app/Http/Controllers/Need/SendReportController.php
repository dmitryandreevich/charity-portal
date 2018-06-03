<?php

namespace App\Http\Controllers\Need;

use App\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SendReportController extends Controller
{
    public function store(Request $request){
        $v = Validator::make($request->all(), [
            ['need_data' => 'required|integer',
                'reportMessage' => 'required']
        ]);
        //if( $v->fails() )
        //    return redirect()->back()->withErrors($v);

        Report::create([
            'id_need' => $request->get('need_data'),
            'id_sender' => Auth::id(),
            'message' => $request->get('reportMessage'),

        ]);

        return redirect()->back()->with('success', 'Вы успешно отправили жалобу');
    }
}
