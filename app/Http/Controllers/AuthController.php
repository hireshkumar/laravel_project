<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt authentication
        $student = Student::where('email', $request->email)->first();

        if ($student && Hash::check($request->password, $student->password)) {
           
            $request->session()->put('uid', $student->id);
            // dd(session()->all());
            return redirect()->route('records')->with('success', 'Login successful!');
        }

        return redirect()->route('login')->with('error', 'Invalid Username or Password');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('uid');
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}



