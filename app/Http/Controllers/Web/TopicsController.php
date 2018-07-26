<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicsRules;
use App\Models\Topics;
use App\Models\Categories;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * 话题列表
     *
     * @param Request $request
     * @param Topics  $topics
     *
     * @return View
     */
    public function index(Request $request)
    {
        $topics = Topics::all();
        
        return view('web.topics.index', compact('topics'));
    }

    /**
     * 话题创建
     *
     * @param Topics $topics
     *
     * @return View
     */
    public function create(Topics $topics)
    {
        $categories = Categories::all();

        return view('web.topics.topic', compact('topics', 'categories'));
    }

    /**
     * 话题创建操作
     *
     * @param TopicsRules $request
     * @param Topics $topic
     */
    public function store(TopicsRules $request, Topics $topic)
    {
        $topic->title       = $request->post('title');
        $topic->body        = $request->post('body');
        $topic->category_id = $request->post('category_id');
        $topic->user_id     = $request->user()->id;

        $topic->save();

        return redirect()
            ->route('topics.index')
            ->with('success', '个人资料更新成功！');
    }
}
