<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function index()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->remember)) {
            // If successfull, then redirect to their intended location
            return redirect()->intended(route('admin.index'));
        }
        // If unsuccessfull, then redirect back to the login with form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
