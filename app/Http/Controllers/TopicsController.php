<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicsController extends Controller
{
    public function index(Request $request)
    {
        $topics = Topic::query()->withOrder($request->order)->paginate();
        return view('topics.index', compact('topics'));
    }
}
