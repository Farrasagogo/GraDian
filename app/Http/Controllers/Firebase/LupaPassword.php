<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\Users;
use Illuminate\Support\Facades\Hash;

class LupaPassword extends Controller
{
    protected $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function showForgotPasswordForm()
    {
        return view('firebase.lupapassword.index');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'forgot_password_key' => 'required|string|max:255',
        ]);

        $user = $this->user->getUserByNameAndForgotPasswordKey($request->name, $request->forgot_password_key);

        if ($user) {
            return redirect()->route('password.reset')->with('userId', $user['id']);
        }

        return back()->withErrors(['forgot_password_key' => 'Incorrect forgot password key']);
    }

    public function showResetForm(Request $request)
    {
        return view('firebase.ubahpassword.index')->with('userId', $request->session()->get('userId'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $this->user->updatePassword($request->user_id, $request->new_password);

        return redirect()->route('login')->with('message', 'Password reset successful!');
    }
}
