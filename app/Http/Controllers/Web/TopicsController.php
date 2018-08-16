<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicsRules;
use App\Models\Topics;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use App\Handlers\ImageHandler;
use Illuminate\Auth\Access\AuthorizationException;

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
    public function index(Request $request, Topics $topic)
    {
        $topics = $topic->withOrder($request->order)->paginate(6);

        return view('web.topics.index', compact('topics'));
    }

    /**
     * 话题详情页。
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Topic        $topic
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Topics $topic)
    {
        if (! empty($topic->slug) && $topic->slug !== $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('web.topics.show', compact('topic'));
    }

    /**
     * 话题创建
     *
     * @param Topics $topic
     *
     * @return View
     */
    public function create(Topics $topic)
    {
        $categories = Categories::all();

        return view('web.topics.topic', compact('topic', 'categories'));
    }

    /**
     * 话题创建操作
     *
     * @param TopicsRules $request
     * @param Topics $topic
     */
    public function store(TopicsRules $request, Topics $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
        
        return redirect()
            ->to($topic->link())
            ->with(['message' => '话题创建成功！']);
    }

    public function upload(Request $request, ImageHandler $handler)
    {
        if ($request->uploader) {
            $result = $handler->upload($request->uploader, 'topics', 'post', 300);
            if ($result) {
                return response()->json([
                    "success" => true,
                    "msg" => "success",
                    "file_path" => $result['uri']
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "msg" => "upload error.",
                    "file_path" => ''
                ]);
            }
        }
    }

    /**
     * 话题编辑页
     *
     * @param \App\Models\Topics $topic
     *
     * @return View
     */
    public function edit(Topics $topic)
    {
        try {
            $this->authorize('update', $topic);
        } catch (AuthorizationException $e) {
            //
        }
        $categories = Categories::all();

        return view('web.topics.topic', compact(
            'topic',
            'categories'
        ));
    }

    /**
     * 话题更新操作
     *
     * @param \App\Http\Requests\Web\TopicsRules $request
     * @param \App\Models\Topics                       $topic
     */
    public function update(TopicsRules $request, Topics $topic)
    {
        try {
            $this->authorize('update', $topic);
        } catch (AuthorizationException $e) {
            //
        }
        $topic->update($request->all());

        return redirect()
            ->to($topic->link())
            ->with(['success' => '话题更新成功！']);
    }

    /**
     * 话题删除操作
     *
     * @param \App\Models\Topics $topic
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Topics $topic)
    {
        try {
            $this->authorize('destroy', $topic);
        } catch (AuthorizationException $e) {
            //
        }
        $topic->delete();
        return redirect()
            ->route('topics.index')
            ->with(['success' => '删除话题成功！']);
    }
}
