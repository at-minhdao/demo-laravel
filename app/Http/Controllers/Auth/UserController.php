<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function edit(User $user)
    {
        if (Auth::user() == $user) {
            return view('auth.edit', compact('user'));
        } else {
            return redirect('home')->with('msgErr', 'Permission Denied');
        }
    }

    public function update(Request $request, User $user)
    {
        // Validate
        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'password' => 'without_spaces|confirmed',
        ]);
        $user->name = $request->name;
        if (trim($request->password) == null) {
            $user->save();
            return redirect('home')->with('msg', 'Change profile success');
        } else {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('home')->with('msg', 'Change profile success');
        }
    }
}
