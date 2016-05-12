<?php

namespace App\Http\Controllers\Role;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('role.index');
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
        $role = Role::findOrFail($id);

        return view('role.edit', compact('role'));
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
        //
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

    public function ajaxEdit(Request $request)
    {
        $inputs = $request->only(['id', 'name', 'description', 'order', 'status']);

        $validator = Validator::make($inputs, [
            'id' => 'required',
            'name' => 'unique:roles,name,' . $inputs['id'],
            'order' => 'integer',
            'status' => 'integer',
        ], [
            'id.required' => 'id 不能为空',
            'name.unique' => '角色已存在',
            'order.integer' => '排序值不能为空',
            'status.integer' => '状态不能为空',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['status' => 400, 'msg' => $messages]);
        }

        $role = Role::findOrFail($inputs['id']);
        $inputs['name'] && $role->name = $inputs['name'];
        $inputs['description'] && $role->description = $inputs['description'];
        $inputs['order'] && $role->order = $inputs['order'];
        $inputs['status'] && $role->status = $inputs['status'];

        // 使用事务
        // use, 一个新鲜的家伙...
        // 众所周知, 闭包: 内部函数使用了外部函数中定义的变量.
        DB::transaction(function () use ($role, $inputs) {
            $role->save();
            // 更新角色权限表
        });

        return response()->json(['status' => 200]);
    }
}
