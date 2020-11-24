<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UsersRequest;
use App\Service\ImageUpload;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UsersRequest $request, User $user, ImageUpload $upload)
    {
        $data = $request->validated();

        if(isset($data['avatar']) && $data['avatar']) {
            $data['avatar'] = $upload->upload($data['avatar'], 'avatars', 320);
        }
        $user->update($data);

        flash('个人资料修改成功')->success();
        return redirect()->route('users.show', $user);
    }
}
