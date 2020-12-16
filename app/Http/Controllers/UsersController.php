<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UsersRequest;
use App\Service\ImageUpload;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show(User $user, Request $request)
    {
        $topics = $replies = null;
        if(!$request->type || $request->type === 'topics') {
            $topics = $user->topics()->latest()->paginate();
        }
        if($request->type === 'replies') {
            $replies = $user->replies()->latest()->paginate();
        }
        return view('users.show', compact('user', 'topics', 'replies'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UsersRequest $request, User $user, ImageUpload $upload)
    {
        $this->authorize('update', $user);
        $data = $request->validated();

        if(isset($data['avatar']) && $data['avatar']) {
            $data['avatar'] = $upload->upload($data['avatar'], 'avatars', 320);
        }
        $user->update($data);

        flash('个人资料修改成功')->success();
        return redirect()->route('users.show', $user);
    }
}
