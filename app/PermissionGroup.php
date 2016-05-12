<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    //
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    public function scopeEnable($query)
    {
        return $query->where('status', self::STATUS_ENABLE);
    }

    public function permissions()
    {
        return $this->hasMany('App\Permission', 'group_id');
    }
}
