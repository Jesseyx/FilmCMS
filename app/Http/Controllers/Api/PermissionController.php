<?php

namespace App\Http\Controllers\Api;

use App\Permission;
use App\PermissionGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //
    public function index(Request $request, $rows = 15)
    {
        $inputs = $request->only(['rows', 'name', 'status', 'group_name', 'orderBy']);

        $inputs['rows'] && $rows = intval($inputs['rows']);

        // 必须有一个先生成 $query
        if ($inputs['orderBy']) {
            $orderBy = explode(',', $inputs['orderBy']);
            $query = Permission::orderBy($orderBy[0], $orderBy[1]);
        } else {
            // Add an "order by" clause for a timestamp to the query.
            $query = Permission::latest();
        }

        if ($inputs['name']) {
            $query = $query->where('name', 'like', '%'.$inputs['name'].'%');
        }

        if ($inputs['status']) {
            $query = $query->where('status', $inputs['status']);
        }

        if ($inputs['group_name']) {
            // 查询已存在的关联关系
            $query = $query->whereHas('group', function ($query) use ($inputs) {
                $query->where('name', 'like', '%' . $inputs['group_name'] . '%');
            });
        }

        // 渴求式加载并附带 group 字段值
        $query = $query->with(['group']);
        $pager = $query -> paginate($rows);

        // 要添加 &sort=votes 到每个分页链接，应该像如下方式调用appends
        // {!! $users->appends(['sort' => 'votes'])->links() !!}
        // 因为分页时要保存上一次的筛选条件
        $pager->appends($request->all());

        $pagerArr = $pager->toArray();

        // 获取分页链接，在 blade 模板中可以直接调用 links 方法生成链接，但是在 api 中需要手动保存
        $links = $pager -> links();
        $pagerArr['links'] = $links ? $links->toHtml() : '';

        return response()->json(['status' => 200, 'data' => $pagerArr]);
    }

    public function getAllGroup()
    {
        // 渴求式加载
        $groups = PermissionGroup::enable()->with(['permissions' => function ($query) {
            return $query->enable();
        }])->get();

        foreach ($groups as $group) {
            $group->children = $group->permissions;
            $group->text = $group->name;
            foreach ($group->permissions as $permission) {
                $permission->text = $permission->name;
            }

            $group->id = -$group->id;
            
            // 隐藏不必要的属性，减少 json 体积
            $group->children->makeHidden(['name', 'location', 'status', 'description', 'order', 'created_at', 'updated_at']);
        }

        // 隐藏不必要的属性，减少 json 体积
        $groups->makeHidden(['name', 'status', 'order', 'created_at', 'updated_at', 'permissions']);

        return response()->json($groups);
    }
}
