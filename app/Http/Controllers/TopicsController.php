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
        $this->middleware('auth', ['create']);
    }

    public function index(Request $request)
    {
        $topics = Topic::query()->withOrder($request->order)->paginate();
        return view('topics.index', compact('topics'));
    }

    public function create()
    {
        return view('topics.create');
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
