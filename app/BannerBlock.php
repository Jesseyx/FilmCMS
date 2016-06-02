<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerBlock extends Model
{
    //
    protected $fillable = [
        'title', 'sub_title', 'img_url', 'link_path', 'description', 'is_ad', 'status', 'up_time', 'down_time', 'source_id', 'resource_type', 'platform', 'audit_user_id', 'order'
    ];
}
