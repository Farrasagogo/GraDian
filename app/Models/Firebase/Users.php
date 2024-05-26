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

    public function login($name, $password)
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
    public function getUserByNameAndForgotPasswordKey($name, $forgotPasswordKey)
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

    public function getUserById($userId)
    {
        $firestoreDatabase = $this->firestore->database();
        $userDocument = $firestoreDatabase->collection('users')->document($userId)->snapshot();

        if ($userDocument->exists()) {
            return $userDocument->data();
        }

        return null;
    }

    public function updateProfile($userId, $data)
    {
        $firestoreDatabase = $this->firestore->database();
        $userDocument = $firestoreDatabase->collection('users')->document($userId);
    
        $updates = [
            ['path' => 'name', 'value' => $data['name']],
            ['path' => 'forgot_password_key', 'value' => $data['forgot_password_key']],
        ];
    
        if (isset($data['password'])) {
            $updates[] = ['path' => 'password', 'value' => $data['password']];
        }
    
        $userDocument->update($updates);
    
        return true;
    }
    
}
