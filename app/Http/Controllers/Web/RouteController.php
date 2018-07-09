<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AuthItem;

class RouteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo AuthItem::TYPE_ROLE;
        // (new AuthItem)->getRoutes();
        return view('route.index');
    }
}
