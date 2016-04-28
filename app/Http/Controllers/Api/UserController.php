<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    function index(Request $request, $rows = 20)
    {
        // Add an "order by" clause for a timestamp to the query.
        $query = User::latest();

        $pager = $query -> paginate($rows);

        // 要添加 &sort=votes 到每个分页链接，应该像如下方式调用appends
        // {!! $users->appends(['sort' => 'votes'])->links() !!}
        // 因为分页时要保存上一次的筛选条件
        $pager->appends($request->all());

        $pagerArr = $pager->toArray();

        // 获取分页链接，在 blade 模板中可以直接调用 links 方法生成链接，但是在 api 中需要手动保存
        $links = $pager -> links();
        $pagerArr['links'] = $links ? $links->toHtml() : '';

        return response()->json(['status' => 200, 'data' => $pagerArr]);
    }
}
