<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate
        Validator::extend('without_spaces', function($attr, $value){
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
