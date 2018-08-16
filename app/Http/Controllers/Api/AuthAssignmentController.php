<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Support\RmsHelper;

class AuthAssignmentController extends BaseController
{
    /**
     * Save auth assignment
     * 
     * @param array $data = [
     *      'user_id'  => '', (required)
     *      'group_id' => 0, (required)
     *      'items'    => [
     *          'item1',
     *          'item2',
     *          ...
     *      ]
     * ];
     * 
     * @return bool
     */
    public function saveAuthAssignment(Request $request)
    {
        $result = RmsHelper::saveAuthAssignment($request->input());

        return response()->json($this->response(true, []), 200);
    }

    /**
     * Remove auth assignment
     *
     * @param array $data = [
     *      'user_id'  => '', (required)
     *      'group_id' => 0, (required)
     *      'items'    => [
     *          'item1',
     *          'item2',
     *          ...
     *      ]
     * ];
     *
     * @return bool
     */
    public function removeAuthAssignment(Request $request)
    {
        $result = RmsHelper::removeAuthAssignment($request->input());

        return response()->json($this->response(true, []), 200);
    }
}
