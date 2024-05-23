<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Model
{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function authenticateUser($name, $password)
    {
        try {
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('users');
            $query = $collectionReference->where('name', '==', $name)->documents();

            foreach ($query as $document) {
                $documentData = $document->data();
                if ($documentData['password'] === $password) {
                    return true;
                }
            }

            return false;
        } catch (FirebaseException $e) {
            throw new \Exception('Failed to authenticate user: ' . $e->getMessage());
        }
    }
}

