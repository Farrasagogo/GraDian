<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class AuthController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $database;
    protected $firestore;

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;
    }


    public function showLoginForm()
    {
        return view('firebase.login.index');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to authenticate with Firebase Firestore
        $auth = app(Auth::class);
        $firestore = app(Firestore::class);

        try {
            // Check if the user exists in Firestore
            $firestoreDatabase = $firestore->database();
            $usersRef = $firestoreDatabase->collection('users');
            $query = $usersRef->where('username', '=', $request->username);
            $snapshot = $query->documents();

            if ($snapshot->isEmpty()) {
                // User not found
                return redirect()->back()->withErrors(['error' => 'User not found']);
            }

            $userData = $snapshot->rows()[0]->data();

            // Authenticate the user with Firebase Authentication
            $userCredential = $auth->signInWithEmailAndPassword($userData['email'], $request->password);
            $user = $userCredential->user();

            // Handle successful login
            $request->session()->put('firebase_user', $user->providerData);

            return redirect()->intended('/home');
        } catch (\Exception $e) {
            // Handle login error
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function showRegisterForm()
    {
        return view('firebase.register.index');
    }

 
        public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to create a new user in Firebase
        $auth = app(Auth::class);
        $firestore = app(Firestore::class);

        try {
            // Create a new user in Firebase Authentication
            $userCredential = $auth->createUserWithEmailAndPassword($request->email, $request->password);
            $user = $userCredential->user();

            // Store user data in Firestore
            $firestoreDatabase = $firestore->database();
            $usersRef = $firestoreDatabase->collection('users');
            $usersRef->add([
                'name' => $request->name,
                'email' => $request->email,
                'username' => ($request->name), // You'll need to implement this function
                'created_at' => new \DateTime(),
                'uid' => $user->uid,
            ]);

            // Handle successful registration
            return redirect()->intended('/login')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            // Handle registration error
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
