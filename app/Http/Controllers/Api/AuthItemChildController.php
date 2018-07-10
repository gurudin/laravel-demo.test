<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AuthItemChild;

class AuthItemChildController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return array
     */
    public function authItemChild(string $name='')
    {
        return $this->response(true, (new AuthItemChild)->getAuthItemChild($name));
    }

    public function setAuthItemChild(Request $request)
    {
        return (new AuthItemChild)->saveItemChild($request->input())
            ? $this->response(true)
            : $this->response(false, [], 1001);
    }

    public function removeAuthItemChild(Request $request)
    {
        return (new AuthItemChild)->removeItemChild($request->input())
            ? $this->response(true)
            : $this->response(false, [], 1001);
    }
}
