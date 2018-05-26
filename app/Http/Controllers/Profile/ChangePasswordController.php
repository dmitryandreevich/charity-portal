<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    /**
     * Change account password
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $validator = Validator::make($request->input(), [
            'newPassword' => 'min:6|confirmed'
        ]);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);


        $oldPassword = $request->get('oldPassword');

        $user = Auth::user();
        $currentPassword = $user->password;
        // Если текущий пароль пуст, пропускаем проверки
        if($currentPassword !== "") {
            if (!Hash::check($oldPassword, Auth::user()->password))
                return redirect()->back()->with('error', 'Вы ввели неверный пароль!');
        }
        $user->password = Hash::make($request->get('newPassword'));
        $user->save();
        return redirect()->back()->with('success', 'Вы успешно сменили свой пароль!');
    }
}
