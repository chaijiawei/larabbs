<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UsersRequest;

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

    public function update(UsersRequest $request, User $user)
    {

    }
}
