<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\Users;
use Illuminate\Support\Facades\Hash;

class Akun extends Controller
{ protected $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $userId = session('userId');
        $user = $this->user->getUserById($userId);
    
        return view('firebase.akun.index', compact('user'));
    }
    public function show(Request $request)
    {
        $userId = $request->session()->get('userId');
        $user = $this->user->getUserById($userId);

        return view('firebase.akun.index', ['user' => $user]);
    }
    public function edit(Request $request)
    {
        $userId = $request->session()->get('userId');
        $user = $this->user->getUserById($userId);

        return view('firebase.editakun.index', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'forgot_password_key' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Nullable for optional password update
        ]);

        $userId = $request->session()->get('userId');
        $data = $request->only(['name', 'forgot_password_key']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $this->user->updateProfile($userId, $data);

        return redirect()->route('profile')->with('message', 'Profile updated successfully!');
    }
}
