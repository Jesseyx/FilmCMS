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
}
