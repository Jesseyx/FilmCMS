<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public function group()
    {
        return $this->belongsTo('App\PermissionGroup', 'group_id');
    }
}
