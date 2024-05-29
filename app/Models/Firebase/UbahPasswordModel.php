<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Support\Facades\Hash;

class UbahPasswordModel extends Model

{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }
    public function updatePassword($userId, $newPassword)
    {
        $firestoreDatabase = $this->firestore->database();
        $userDocument = $firestoreDatabase->collection('users')->document($userId);

        $hashedPassword = Hash::make($newPassword);

        $userDocument->update([
            ['path' => 'password', 'value' => $hashedPassword],
        ]);

        return true;
    }

    public function updateForgotPasswordKey($userId, $newForgotPasswordKey)
    {
        $firestoreDatabase = $this->firestore->database();
        $userDocument = $firestoreDatabase->collection('users')->document($userId);

        $userDocument->update([
            ['path' => 'forgot_password_key', 'value' => $newForgotPasswordKey],
        ]);

        return true;
    }
}