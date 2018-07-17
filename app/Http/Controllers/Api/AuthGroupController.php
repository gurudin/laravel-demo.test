<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AuthGroup;
use App\Models\AuthGroupChild;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Support\RmsHelper;

class AuthGroupController extends BaseController
{
    public function getGroup(int $id = 0)
    {
        return $this->response(true, (new AuthGroup)->getGroup($id));
    }

    public function setGroup(Request $request)
    {
        $result = (new AuthGroup)->setGroup($request->input());

        return $result
            ? $this->response(true, ['id' => $result])
            : $this->response(false, [], 1002);
    }

    public function removeGroup(Request $request)
    {
        $result = (new AuthGroup)->removeGroup($request->input('id'));
        
        return $result
            ? $this->response(true)
            : $this->response(false, [], 1003);
    }

    public function getUser()
    {
        return $this->response(true, (new User)->getUser());
    }

    public function getGroupUserChild(int $id)
    {
        return $this->response(true, (new AuthGroupChild)->getGroupUserChild($id));
    }

    public function getGroupItemChild(int $id)
    {
        return $this->response(true, (new AuthGroupChild)->getGroupItemChild($id));
    }

    public function setAuthGroupChild(Request $request)
    {
        $result = (new AuthGroupChild)->setAuthGroupChild($request->input());

        return $result
            ? $this->response(true, [])
            : $this->response(false, [], 1001);
    }

    public function removeAuthGroup(Request $request)
    {
        $result = (new AuthGroupChild)->removeAuthGroup($request->input());

        return $result
            ? $this->response(true, [])
            : $this->response(false, [], 1003);
    }

    public function authGroup(Request $request, User $user)
    {
        $result = RmsHelper::authGroup(Auth::user());
        
        return response()->json($this->response(true, $result), 200);
    }
}
