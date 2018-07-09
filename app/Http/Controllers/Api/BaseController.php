<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as Controller;

class BaseController extends Controller
{
    private static $errCode = [
        0 => 'success',
        1001 => 'Failed to save',
        1002 => 'Failed to update',
    ];

    /**
     * @return response
     */
    public function response(bool $status, array $data=[], int $code=0)
    {
        return ['status' => $status, 'code' => $code, 'msg' => self::GC($code), 'data' => $data];
    }

    private static function GC($code=0)
    {
        return isset(self::$errCode[$code])
            ? self::$errCode[$code]
            : 'failed to request.';
    }
}
