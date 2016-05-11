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

    public function format()
    {
        $items = explode('|', $this->location);
        $formattedItems = [];

        foreach ($items as $item) {
            $subItem = explode('@', $item);
            $controller = isset($subItem[0]) ? $subItem[0] : null;
            $actions = isset($subItem[1]) ? $subItem[1] : null;

            if (!($controller && $actions)) {
                continue;
            }
            
            $actions = explode(',', $actions);
            foreach ($actions as $action) {
                $formattedItems[$controller][$action] = true;
            }
        }

        return $formattedItems;
    }
}
