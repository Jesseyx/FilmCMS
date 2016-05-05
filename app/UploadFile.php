<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadFile extends Model
{
    //
    /* 声明使用软删除 */
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
