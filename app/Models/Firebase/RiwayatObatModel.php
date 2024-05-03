<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class RiwayatObatModel extends Model
{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getRiwayatObat()
    {
        $firestoreDatabase = $this->firestore->database();
        $collection = $firestoreDatabase->collection('obat_log');
        $documents = $collection->orderBy('dateAndTime', 'DESC')->documents();
        $data = [];

        foreach ($documents as $document) {
            $data[] = [
                'dateAndTime' => $document->data()['dateAndTime'],
                'condition' => $document->data()['condition'],
            ];
        }

        return $data;
    }
}
