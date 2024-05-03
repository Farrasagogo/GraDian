<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class RiwayatSensorLdrModel extends Model
{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getRiwayatSensorLdr()
    {
        $firestoreDatabase = $this->firestore->database();
        $collectionReference = $firestoreDatabase->collection('sensors');
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

        return $data;
    }
}
