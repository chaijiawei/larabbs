<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicsRequest;
use App\Service\ImageUpload;
use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'upload']);
    }

    public function index(Request $request)
    {
        $topics = Topic::query()->withOrder($request->order)->paginate();
        return view('topics.index', compact('topics'));
    }

    public function create(Topic $topic)
    {
        return view('topics.create', compact('topic'));
    }

    public function store(TopicsRequest $request)
    {
        $data = $request->validated();

        $topic = Auth::user()->topics()->create($data);

        flash()->success('话题创建成功');
        return redirect()->route('topics.show', $topic);
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        return view('topics.create', compact('topic'));
    }

    public function update(TopicsRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $data = $request->validated();
        $topic->update($data);

        flash()->success('话题修改成功');
        return redirect()->route('topics.show', $topic);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);

        $topic->delete();
        flash()->success('帖子删除成功');
        return redirect()->route('topics.index');
    }

    public function upload(Request $request, ImageUpload $upload)
    {
        if(! Auth::check()) {
            abort(500);
        }
        $file = $request->file('file');
        $img = $upload->upload($file, 'topics', 800);

        return ['location' => $upload->getFullUrl($img)];
    }
}
