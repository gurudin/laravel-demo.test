<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return array
     */
    public function getMenu($id='')
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
}
