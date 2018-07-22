<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Support\RmsHelper;

class MenuController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return array
     */
    public function getMenu($id = '')
    {
        return $this->response(true, (new Menu)->getMenu($id));
    }

    public function save(Request $request)
    {
        $result = (new Menu)->saveMenu($request->input());

        return $result
           ? $this->response(true, ['id' => $result])
           : $this->response(false, [], 1002);
    }

    public function delete(Request $request)
    {
        $result = (new Menu)->deleteMenu($request->input('id'));
        
        return $result
            ? $this->response(true)
            : $this->response(false, [], 1003);
    }

    public function authMenu(Request $request, int $group_id = 0)
    {
        $result = RmsHelper::authMenu(Auth::user(), $group_id);

        return response()->json($this->response(true, $result), 200);
    }
}
