<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class ObatModel extends Model
{
    use HasFactory;
    protected $database;
    protected $firestore;

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;
    }

    public function getObatautoStatus()
    {
        $reference = $this->database->getReference('obatauto');
        return $reference->getValue();
    }

    public function updateFirebaseManualPestisida()
    {
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateTime = new \DateTime('now', $timezone);
        $dateAndTime = $dateTime->format('Y-m-d H:i:s');

        try {
            $reference = $this->database->getReference('sirampesti');
            $reference->set(true);

            $condition = 'Penyiraman Manual Pestisida';
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('obat_log');
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateFirebaseManualFungisida()
    {
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateTime = new \DateTime('now', $timezone);
        $dateAndTime = $dateTime->format('Y-m-d H:i:s');

        try {
            $reference = $this->database->getReference('siramfungi');
            $reference->set(true);

            $condition = 'Penyiraman Manual Fungisida';
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('obat_log');
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateObatauto($isChecked)
    {
        try {
            $reference = $this->database->getReference('obatauto');
            $reference->set($isChecked);

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
