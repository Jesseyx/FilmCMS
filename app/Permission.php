<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    const STATUS_DISABLE = -1;
    const STATUS_ENABLE = 1;

    public function group()
    {
        return $this->belongsTo('App\PermissionGroup', 'group_id');
    }

    public function scopeEnable($query)
    {
        return $query->where('status', self::STATUS_ENABLE);
    }
}
