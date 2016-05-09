<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roleIds = $user->roles()->get()->map(function ($role) {
            return $role->id;
        })->toArray();
        
        return view('user.edit', compact('user', 'roleIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->only(['username', 'name', 'avatar', 'roles', 'cellphone', 'email', 'password']);

        $user = User::findOrFail($id);
        $user->username = $inputs['username'];
        $user->name = $inputs['name'];
        $user->avatar = parse_url($inputs['avatar'])['path'];
        $user->cellphone = $inputs['cellphone'];
        $user->email = $inputs['email'];
        $inputs['password'] && $user->password = bcrypt($inputs['password']);

        // 开启事务
        DB::transaction(function () use($user, $inputs) {
            $user->save();
            $user->roles()->sync($inputs['roles']);
        });

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProfile()
    {
        return view('user.profile');
    }

    public function getEdit()
    {
        return view('user.self_edit');
    }

    public function postEdit(Requests\UserEditRequest $request)
    {
        $inputs = $request->only(['cellphone', 'email']);
        $inputs['cellphone'] && $this->user->cellphone = $inputs['cellphone'];
        $inputs['email'] && $this->user->email = $inputs['email'];

        if ($this->user->save()) {
            return redirect('/user/profile');
        }

        // 将输入存储到一次性 Session 然后重定向, "基础--HTTP 请求"
        return back()->withInput();
    }

    public function ajaxEdit(Request $request)
    {
        $inputs = $request->only(['id', 'username', 'name', 'cellphone', 'email', 'status']);

        $validator = Validator::make($inputs, [
            'id' => 'required',
            'username' => 'min:6|unique:users,username,'.$inputs['id'],
            'cellphone' => 'digits:11',
            'email' => 'email',
            'status' => 'integer'
        ], [
            'id.required' => '缺少ID',
            'username.min' => '账号不能小于6个字符',
            'username.unique' => '该帐号已经被注册过',
            'cellphone.digits' => '手机号码不正确',
            'email' => '邮箱格式不正确',
            'status.integer' => '请选择状态',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['status' => 400, 'msg' => $messages]);
        }

        $user = User::findOrFail($inputs['id']);
        $inputs['username'] && $user->username = $inputs['username'];
        $inputs['name'] && $user->name = $inputs['name'];
        $inputs['cellphone'] && $user->cellphone = $inputs['cellphone'];
        $inputs['email'] && $user->email = $inputs['email'];
        $inputs['status'] && $user->status = $inputs['status'];

        // 使用事务
        // use, 一个新鲜的家伙...
        // 众所周知, 闭包: 内部函数使用了外部函数中定义的变量.
        DB::transaction(function () use ($user, $inputs) {
            $user->save();
        });

        return response()->json(['status' => 200]);
    }
}
