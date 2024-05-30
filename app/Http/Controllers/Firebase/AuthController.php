<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\Users;

class AuthController extends Controller
{
    protected $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function showLoginForm()
    {
        return view('firebase.login.index');
    }

    public function showRegisterForm()
    {
        return view('firebase.register.index');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    $userId = $this->user->register($request->name, $request->password);

    // Store user name and ID in session
    $request->session()->put('userId', $userId);
    $request->session()->put('userName', $request->name);

    // Redirect to dashboard after registration
    return redirect('/penyiraman')->with('message', 'Registration successful!');
}

public function login(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'password' => 'required|string',
    ]);

    $userId = $this->user->authenticateUser($request->name, $request->password);

    if ($userId) {
        // Store user name and ID in session
        $request->session()->put('userId', $userId);
        $request->session()->put('userName', $request->name);

        // Redirect to dashboard after login
        return redirect('/Homepage')->with('message', 'Login successful!');
    }

    return back()->withErrors(['error' => 'Username atau password salah'])->withInput();
}
}
