<?php

namespace App\Http\Controllers\PermissionGroup;

use App\PermissionGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionGroupStoreAndUpdate;
use Illuminate\Support\Facades\Validator;

class PermissionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('permissionGroup.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('permissionGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionGroupStoreAndUpdate $request)
    {
        //
        $inputs = $request->only(['name', 'order', 'status']);

        $group = new PermissionGroup();
        $group->name = $inputs['name'];
        $group->order = $inputs['order'];
        $group->status = $inputs['status'];

        if ($group->save()) {
            return redirect('/permission-group');
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
        $group = PermissionGroup::findOrFail($id);

        return view('permissionGroup.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionGroupStoreAndUpdate $request, $id)
    {
        //
        $inputs = $request->only(['name', 'order', 'status']);

        $group = PermissionGroup::findOrFail($id);
        $group->name = $inputs['name'];
        $group->order = $inputs['order'];
        $group->status = $inputs['status'];

        if ($group->save()) {
            return redirect('/permission-group');
        }

        return back()->withInput();
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
        $inputs = $request->only(['id', 'name', 'order', 'status']);

        $validator = Validator::make($inputs, [
            'id' => 'required',
            'name' => 'unique:permission_groups,name,' . $inputs['id'],
            'order' => 'integer',
            'status' => 'integer',
        ], [
            'id.required' => '缺少ID',
            'name.unique' => '分组名称已存在',
            'order.integer' => '请输入正确的排序值',
            'status.integer' => '请选择状态',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['status' => '400', 'msg' => $messages]);
        }

        $group = PermissionGroup::findOrFail($inputs['id']);

        $inputs['name'] && $group->name = $inputs['name'];
        $inputs['order'] && $group->order = $inputs['order'];
        $inputs['status'] && $group->status = $inputs['status'];

        if ($group->save()) {
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 500, 'msg' => 'Inner error. Please try later.']);
    }
}
