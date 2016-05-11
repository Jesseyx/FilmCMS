<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /* 声明使用软删除 */
    use  SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;
    /* 使用软删除 */
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        // 多对多关系
        // $user->roles 访问
        return $this->belongsToMany('App\Role', 'role_user');
    }

    public function permissions()
    {
        // enable 是作用域
        // with "文档-关联关系" 渴求式加载，减少查询次数
        $roles = $this->roles()->enable()->with(['permissions' => function ($query) {
            $query->enable();
        }])->get();

        // collect 函数会根据提供的数据项创建一个集合
        $permissions = collect();

        foreach ($roles as $role) {
            $permissions = $permissions->merge($role->permissions);
        }

        // 集合 unique 返回唯一数据项
        return $permissions->unique('id')->all();
    }

    public function hasPermission($controller, $action)
    {
        $supers = config('admin.backend.authority.supers');

        // 超级管理员
        if (in_array($this->username, $supers)) {
            return true;
        }

        if (empty($controller) && empty($action)) {
            return false;
        }

        // 所有用户有权修改自身信息
        $ignores = config('admin.backend.authority.ignores');
        foreach ($ignores as $ignore) {
            $items = explode('|', $ignore['location']);
            foreach ($items as $item) {
                $subItem = explode('@', $item);
                $iController = isset($subItem[0]) ? $subItem[0] : null;
                $iAction = isset($subItem[1]) ? $subItem[1] : null;
                if (!($iController && $iAction)) {
                    continue;
                }
                if ($controller === $iController && ($action === $iAction || $action === '*')) {
                    return true;
                }
            }
        }

        $permissions = $this->permissions();
        $formattedPermissions = [];
        foreach ($permissions as $permission) {
            $formatedPermission = $permission->format();
            $formattedPermissions = array_merge_recursive($formattedPermissions, $formatedPermission);
        }

        if (!isset($formattedPermissions[$controller])) {
            return false;
        }

        return $formattedPermissions[$controller] === '*' || (isset($formattedPermissions[$controller][$action]) && !!$formattedPermissions[$controller][$action]);
    }
}
