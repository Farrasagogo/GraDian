<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Support\Facades\Hash;

class AkunModel extends Model
{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }
    public function getDataAkun($userId)
    {
        $firestoreDatabase = $this->firestore->database();
        $userDocument = $firestoreDatabase->collection('users')->document($userId)->snapshot();

        if ($userDocument->exists()) {
            return $userDocument->data();
        }

        return null;
    }

    public function setDataAkun($userId, $data)
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