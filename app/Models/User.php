<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Firestore;

class User extends Model
{
    /**
     * The firestore instance.
     *
     * @var \Kreait\Firebase\Firestore
     */
    protected $firestore;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  \Kreait\Firebase\Contract\Firestore  $firestore
     * @return void
     */
    public function __construct(Firestore $firestore)
    {
        parent::__construct();

        $this->firestore = $firestore;
    }

    /**
     * Get the users collection.
     *
     * @return \Kreait\Firebase\Firestore\Query
     */
    public function getUsersCollection()
    {
        return $this->firestore->database()->collection('users');
    }

    /**
     * Get a user by ID.
     *
     * @param  string  $userId
     * @return array|null
     */
    public function getUser($userId)
    {
        $user = $this->getUsersCollection()->document($userId)->snapshot()->data();

        return $user ?: null;
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     * @return string
     */
    public function createUser(array $data)
    {
        $document = $this->getUsersCollection()->newDocument();
        $document->set($data);

        return $document->id();
    }

    /**
     * Update a user.
     *
     * @param  string  $userId
     * @param  array  $data
     * @return void
     */
    public function updateUser($userId, array $data)
    {
        $this->getUsersCollection()->document($userId)->set($data, ['merge' => true]);
    }

    /**
     * Delete a user.
     *
     * @param  string  $userId
     * @return void
     */
    public function deleteUser($userId)
    {
        $this->getUsersCollection()->document($userId)->delete();
    }
}