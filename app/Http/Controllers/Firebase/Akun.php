<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\AkunModel;
use Illuminate\Support\Facades\Hash;

class Akun extends Controller
{ protected $user;

    public function __construct(AkunModel $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $userId = session('userId');
        $user = $this->user->getDataAkun($userId);
    
        return view('firebase.akun.index', compact('user'));
    }
    public function show(Request $request)
    {
        $userId = $request->session()->get('userId');
        $user = $this->user->getDataAkun($userId);

        return view('firebase.akun.index', ['user' => $user]);
    }
    public function getEditAkun(Request $request)
    {
        $userId = $request->session()->get('userId');
        $user = $this->user->getDataAkun($userId);

        return view('firebase.editakun.index', ['user' => $user]);
    }

    public function setAkun(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'forgot_password_key' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $userId = $request->session()->get('userId');
    $data = $request->only(['name', 'forgot_password_key']);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $this->user->setDataAkun($userId, $data);

    return redirect()->route('profile')->with('success', 'Sukses, data akun berhasil diperbarui!');
}
    public function logout(Request $request)
    {
        $request->session()->forget('userId');
        return redirect('/login')->with('message', 'Logout successful!');
    }
}
