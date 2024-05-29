<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\UbahPasswordModel;
use Illuminate\Support\Facades\Hash;

class UbahPassword extends Controller
{
    protected $user;

    public function __construct(UbahPasswordModel $user)
    {
        $this->user = $user;
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