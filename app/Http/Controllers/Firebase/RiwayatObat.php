<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class RiwayatObat extends Controller
{
    protected $database;
    protected $firestore;
    

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;

        
    }
    
    public function index()
{
    $firestoreDatabase = $this->firestore->database();
    $collection = $firestoreDatabase->collection('obat_log');
    $documents = $collection->documents();
    $documents = $collection->orderBy('dateAndTime', 'DESC')->documents();
    $data = [];
    foreach ($documents as $document) {
        $data[] = [
            'dateAndTime' => $document->data()['dateAndTime'],
            'condition' => $document->data()['condition'],
        ];
    }
    return view('firebase.riwayatobat.index', compact('data'));
}
}
