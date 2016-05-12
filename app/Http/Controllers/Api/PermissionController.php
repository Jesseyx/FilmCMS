<?php

namespace App\Http\Controllers\Api;

use App\PermissionGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //
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
