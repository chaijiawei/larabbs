<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topic::query()->paginate();
        return view('topics.index', compact('topics'));
    }
}
