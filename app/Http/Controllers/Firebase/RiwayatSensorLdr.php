<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class RiwayatSensorLdr extends Controller
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
    $collectionReference = $firestoreDatabase->collection('sensors');
    $query = $collectionReference->documents();
    $query = $collectionReference->orderBy('dateAndTime.logDate', 'desc')->documents();
    $data = [];
    foreach ($query as $document) {
        $documentData = $document->data();
        $dateAndTime = isset($documentData['dateAndTime']) ? $documentData['dateAndTime'] : null;
        $logDate = isset($dateAndTime['logDate']) ? $dateAndTime['logDate'] : null;
        $temperatureData = isset($documentData['temperatureData']) ? $documentData['temperatureData'] : null;
        $ldrValue = isset($temperatureData['ldrValue']) ? $temperatureData['ldrValue'] : null;
        
        $data[] = [
            'logDate' => $logDate,
            'ldrValue' => $ldrValue
        ];
    }
        return view('firebase.riwayatldr.index', compact('data'));
    }
}
