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

    public function index()
    {
        return view('firebase.lupapassword.index');
    }

    public function getLupaPassword(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'forgot_password_key' => 'required|string|max:255',
        ]);

        $user = $this->user->getDataLupaPassword($request->name, $request->forgot_password_key);

        if ($user) {
            return redirect()->route('password.reset')->with('userId', $user['id']);
        }

        return back()->withErrors(['forgot_password_key' => 'Data tidak valid']);
    }
    
 

}
