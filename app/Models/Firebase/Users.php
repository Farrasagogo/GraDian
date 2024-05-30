<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function register($name, $password)
    {
        $firestoreDatabase = $this->firestore->database();
        $usersCollection = $firestoreDatabase->collection('users');

        $hashedPassword = Hash::make($password);

        $userDocument = $usersCollection->add([
            'name' => $name,
            'password' => $hashedPassword,
        ]);

        return $userDocument->id();
    }

    public function authenticateUser($name, $password)
    {
        $firestoreDatabase = $this->firestore->database();
        $usersCollection = $firestoreDatabase->collection('users');

        $query = $usersCollection->where('name', '==', $name)->limit(1)->documents();

        if ($query->isEmpty()) {
            return false;
        }

        $userDocument = $query->rows()[0]; // Using rows() to get the first document
        $userData = $userDocument->data();

        if (Hash::check($password, $userData['password'])) {
            return $userDocument->id();
        }

        return false;
    }
    
}
