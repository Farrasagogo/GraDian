<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\LupaPasswordModel;
use Illuminate\Support\Facades\Hash;

class LupaPassword extends Controller
{
    protected $user;

    public function __construct(LupaPasswordModel $user)
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

        return back()->withErrors(['forgot_password_key' => 'Nama ibu atau username salah']);
    }
    
 

}
