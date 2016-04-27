<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user');
    }

    // 本地作用域允许我们定义通用的约束集合以便在应用中复用
    // 例如，你可能经常需要获取最受欢迎的用户，要定义这样的一个作用域，只需简单在对应Eloquent模型方法前加上一个scope前缀
    // 作用域总是返回查询构建器
    public function scopeEnable($query)
    {
        return $query->where('status', self::STATUS_ENABLE);
    }
}
