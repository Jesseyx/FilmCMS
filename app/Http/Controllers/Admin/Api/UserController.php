<?php

namespace App\Http\Controllers\Admin\Api;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $rows = 20)
    {
        //
        $inputs = $request->only(['rows', 'name', 'status', 'orderby', 'id', 'username']);
        $inputs['rows'] && $rows = intval($inputs['rows']);

        if ($inputs['orderby']) {
            $orderBy = explode(',', $inputs['orderby']);
            $query = User::orderBy($orderBy[0], $orderBy[1]);
        } else {
            $query = User::latest();
        }

        if ($inputs['name']) {
            $query = $query -> where('name', 'like', '%'.$inputs['name'].'%');
        }

        if ($inputs['status']) {
            $query = $query -> where('status', $inputs['status']);
        }

        if ($inputs['id']) {
            $query = $query -> where('id', $inputs['id']);
        }

        if ($inputs['username']) {
            $query = $query -> where('username', 'like', '%'.$inputs['username'].'%');
        }

        $pager = $query -> paginate($rows);
        $pager -> appends($request -> all());
        $pagerArr = $pager -> toArray();

        $links = $pager -> links();
        $pagerArr['pages'] = $links ? $links -> toHtml() : '';
        return response() -> json(['status' => 200, 'data' => $pagerArr]);
    }
}
