<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('admin.users.index', compact('users'));
    }

    public function block(User $user)
    {
        if ($user->role !== 'admin') {
            $user->update(['is_blocked' => true]);
        }

        return redirect()->route('admin.users.index');
    }

    public function unblock(User $user)
    {
        $user->update(['is_blocked' => false]);

        return redirect()->route('admin.users.index');
    }
}