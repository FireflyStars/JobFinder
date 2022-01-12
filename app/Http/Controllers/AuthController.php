<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Login form
    public function index()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {

        // Validation Rules
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // if validator fails
        if($validator->fails())
        {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $request->input('remember'))
        ) {
            session()->flash('message', 'Welcome to dashboard.');

            return redirect()->intended('admin/dashboard');
        }

        // authentication failed...
        session()->flash('message', 'Invalid login credentials.');
        return redirect()->back();

    }

    public function logout()
    {
        Auth::logout();

        session()->flash('message', 'You have been logged out.');
        return redirect('admin/login');
    }
}
