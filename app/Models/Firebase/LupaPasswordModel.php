<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Support\Facades\Hash;

class LupaPasswordModel extends Model

{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }
    public function getUserById($userId)
    {
        $firestoreDatabase = $this->firestore->database();
        $userDocument = $firestoreDatabase->collection('users')->document($userId)->snapshot();

        if ($userDocument->exists()) {
            return $userDocument->data();
        }

        return null;
    }

public function getDataLupaPassword($name, $forgotPasswordKey)
    {
        $firestoreDatabase = $this->firestore->database();
        $query = $firestoreDatabase->collection('users')
            ->where('name', '==', $name)
            ->where('forgot_password_key', '==', $forgotPasswordKey)
            ->limit(1)
            ->documents();

        if ($query->isEmpty()) {
            return null;
        }

        $userDocument = $query->rows()[0]; // Using rows() to get the first document
        $userData = $userDocument->data();
        $userData['id'] = $userDocument->id();

        return $userData;
    }
}