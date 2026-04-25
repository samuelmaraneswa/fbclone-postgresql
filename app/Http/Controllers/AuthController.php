<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if(Auth::attempt($credentials)){
      $request->session()->regenerate();

      return redirect()->intended('/');
    }

    return back()->withErrors([
      'email' => 'Email atau password salah!'
    ])->onlyInput('email');
  }
  
  public function register()
  {
    return view('auth.register');
  }

  public function store(Request $request)
  {
    $validated = $request->validate(
      [
        'first_name' => 'required',
        'last_name' => 'required',
        'date_of_birth' => 'required',
        'gender' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
      ],
    );

    $user = User::create([
      'first_name' => $validated['first_name'],
      'last_name' => $validated['last_name'],
      'date_of_birth' => $validated['date_of_birth'],
      'gender' => $validated['gender'],
      'email' => $validated['email'],
      'password' => $validated['password'],
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'Register berhasil',
      'redirect' => route('login')
    ]);
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
