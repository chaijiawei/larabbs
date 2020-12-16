<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request)
    {
        $data = $request->validated();

        $request->user()->replies()->create($data);

        flash('回复发表成功')->success();

        return back();
    }
}
