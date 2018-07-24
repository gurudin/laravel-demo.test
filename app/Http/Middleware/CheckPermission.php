<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Support\RmsHelper;

class CheckPermission
{
    private $allow = [
        ['method' => 'post', 'uri' => 'api/login', 'name' => 'authUser.login'],
        ['method' => 'post', 'uri' => 'api/register', 'name' => 'authUser.register'],
        ['method' => 'get', 'uri' => 'api/authGroup', 'name' => 'authGroup.authGroup'],
        ['method' => 'get', 'uri' => '/api/authMenu/{group_id?}']
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        $isAllow = false;
        $current_route = [
            'method' => Route::current()->methods,
            'uri'    => Route::current()->uri,
            'name'   => ROute::currentRouteName(),
        ];

        // Is allow.
        foreach ($this->allow as $allow) {
            $uri  = isset($allow['uri']) ? ($allow['uri'][0] == '/' ? substr($allow['uri'], 1) : $allow['uri']) : '';
            $name = $allow['name'] ?? '';
            if (in_array(strtoupper($allow['method']), $current_route['method'])
                && ($current_route['uri'] == $uri || $current_route['name'] == $name)
            ) {
                return $next($request);
            }
        }

        // Is admin.
        if (RmsHelper::isAdmin(Auth::user())) {
            return $next($request);
        }

        // Check permission.
        if (!$current_group_id = $request->header('Group-id')) {
            return response()->json('403 Forbidden Error', 403);
        }

        $routes = RmsHelper::getUserRoute(Auth::user()->id, $current_group_id);
        foreach ($routes as $value) {
            $uri = isset($value['child']) ? ($value['child'][0] == '/' ? substr($value['child'], 1) : $value['child']) : '';
            if (
                (in_array(strtoupper($value['method']), $current_route['method']) || strtoupper($value['method']) == 'ANY')
                && $current_route['uri'] == $uri
            ) {
                $isAllow = true;
            }
        }

        if ($isAllow) {
            return $next($request);
        } else {
            return response()->json('403 Forbidden Error', 403);
        }
    }
}
