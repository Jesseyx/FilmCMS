<?php

namespace App\Http\Controllers\Password;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class PasswordController extends Controller
{
    private $_user;

    public function __construct()
    {
        $this->_user = Auth::user();
    }

    //
    public function getReset()
    {
        return view('password.reset');
    }

    public function postReset(Requests\PassswordResetRequest $request)
    {
        $oldPwd = $request->input('old_password');
        if (!Hash::check($oldPwd, $this->_user->password)) {
            return back()->with('errors', new MessageBag(['old_password' => '原密码错误']));
        }

        $this->_user->password = bcrypt($request->input('password'));

        if ($this->_user->save()) {
            return redirect('/auth/logout');
        }

        return back();
    }
}
