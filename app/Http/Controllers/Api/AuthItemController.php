<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AuthItem;

class AuthItemController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return array
     */
    public function getPermission()
    {
        return $this->response(true, (new AuthItem)->getPermission());
    }

    public function setAuthItem(Request $request)
    {
        return (new AuthItem)->setItem($request->input())
            ? $this->response(true)
            : $this->response(false, [], 1001);
    }

    public function removeAuthItem(Request $request)
    {
        return (new AuthItem)->removeItem($request->input())
            ? $this->response(true)
            : $this->response(false, [], 1002);
    }
}
