<?php

namespace App\Http\Controllers\Permission;

use App\Permission;
use App\PermissionGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $groups = PermissionGroup::enable()->get();
        return view('permission.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PermissionStoreAndUpdate $request)
    {
        //
        $inputs = $request->only(['name', 'group_id', 'location', 'status', 'order', 'description']);

        $permission = new Permission();

        $permission->name = $inputs['name'];
        $permission->group_id = $inputs['group_id'];
        $permission->location = $inputs['location'];
        $permission->status = $inputs['status'];
        $permission->order = $inputs['order'];
        $permission->description = $inputs['description'];

        if ($permission->save()) {
            return back();
        }
        return back()->withInput();
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
        $inputs = $request->only(['id', 'name', 'location', 'description', 'order', 'status']);

        $validator = Validator::make($inputs, [
            'id' => 'required',
            'name' => 'unique:permissions,name,' . $inputs['id'],
            'order' => 'integer',
            'status' => 'integer',
        ], [
            'id.required' => '缺少id',
            'name.unique' => '权限名称已存在',
            'order.integer' => '排序值必须为整数',
            'status.integer' => '请选择状态'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();

            return response()->json(['status' => 400, 'msg' => $messages]);
        }

        $permission = Permission::findOrFail($inputs['id']);

        $inputs['name'] && $permission->name = $inputs['name'];
        $inputs['location'] && $permission->location = $inputs['location'];
        $inputs['description'] && $permission->description = $inputs['description'];
        $inputs['order'] && $permission->order = $inputs['order'];
        $inputs['status'] && $permission->status = $inputs['status'];

        if ($permission->save()) {
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 500, 'msg' => 'Inner error! Please try later!']);
    }
}
