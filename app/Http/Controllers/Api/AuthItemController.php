<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AuthItem;
use App\Support\RmsHelper;

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

    public function getRole()
    {
        return $this->response(true, (new AuthItem)->getRole());
    }

    public function setAuthItem(Request $request)
    {
        RmsHelper::removeCache();

        return (new AuthItem)->setItem($request->input())
            ? $this->response(true)
            : $this->response(false, [], 1001);
    }

    public function updateAuthItem(Request $request)
    {
        RmsHelper::removeCache();

        return (new AuthItem)->updateItem($request->input())
            ? $this->response(true)
            : $this->response(false, [], 1002);
    }

    public function removeAuthItem(Request $request)
    {
        RmsHelper::removeCache();
        
        return (new AuthItem)->removeItem($request->input())
            ? $this->response(true)
            : $this->response(false, [], 1003);
    }
}
