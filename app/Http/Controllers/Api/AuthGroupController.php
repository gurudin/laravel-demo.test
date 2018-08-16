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
    /**
     * (Auth) Get group permission by group_ids
     * 
     * @param string $group_ids (1,2,3)
     * 
     * @return array
     */
    public function getAuthGroupPermission(string $group_ids)
    {
        $result = RmsHelper::getAuthGroupPermission(Auth::user(), $group_ids);

        return response()->json($this->response(true, $result), 200);
    }

    public function getGroup(int $id = 0)
    {
        return $this->response(true, (new AuthGroup)->getGroup($id));
    }

    public function setGroup(Request $request)
    {
        RmsHelper::removeCache();
        $result = (new AuthGroup)->setGroup($request->input());

        return $result
            ? $this->response(true, ['id' => $result])
            : $this->response(false, [], 1002);
    }

    public function removeGroup(Request $request)
    {
        RmsHelper::removeCache();
        $result = (new AuthGroup)->removeGroup($request->input('id'));
        
        return $result
            ? $this->response(true)
            : $this->response(false, [], 1003);
    }

    public function getUser()
    {
        return response()->json($this->response(true, (new User)->getUser()), 200);
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
        RmsHelper::removeCache();
        $result = (new AuthGroupChild)->setAuthGroupChild($request->input());

        return $result
            ? $this->response(true, [])
            : $this->response(false, [], 1001);
    }

    public function removeAuthGroup(Request $request)
    {
        RmsHelper::removeCache();
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
