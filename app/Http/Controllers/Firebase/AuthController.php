<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Exception\Auth\FailedToSignIn;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    public function showLoginForm()
    {
        return view('firebase.login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($request->email, $request->password);
            session(['firebase_user' => $signInResult->data()]);
            return redirect()->route('penyiraman');
        } catch (FailedToSignIn $e) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $this->auth->createUserWithEmailAndPassword($request->email, $request->password);
            return redirect()->route('login')->with('status', 'Registration successful, please login.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Error during registration.']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('firebase_user');
        return redirect()->route('login');
    }
}
