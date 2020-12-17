<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $notifications = Auth::user()->notifications()->paginate();
        Auth::user()->markAsRead();
        return view('notification.show', compact('notifications'));
    }
}
