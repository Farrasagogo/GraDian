<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class PenyiramanModel extends Model
{
    use HasFactory;

    protected $database;
    protected $firestore;

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;
    }

    public function getIsSiramauto()
    {
        $reference = $this->database->getReference('siramauto');
        return $reference->getValue();
    }

    public function updateFirebaseManual()
    {
        try {
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $dateTime = new \DateTime('now', $timezone);
            $dateAndTime = $dateTime->format('Y-m-d H:i:s');

            $reference = $this->database->getReference('siram');
            $reference->set(true);

            $condition = 'Penyiraman Manual';
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('siram_log');
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateSiramauto($isChecked)
    {
        try {
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $dateTime = new \DateTime('now', $timezone);
            $dateAndTime = $dateTime->format('Y-m-d H:i:s');

            $reference = $this->database->getReference('siramauto');
            $reference->set($isChecked);

            $condition = $isChecked ? 'Automatisasi Hidup' : 'Automatisasi Mati';
            $humidity = $this->database->getReference('humidity')->getValue();
            $temperature = $this->database->getReference('temperature')->getValue();

            if ($humidity < 65 && $temperature > 30) {
                $alertMessage = 'Semprotan air sedang aktif';
            } else {
                $alertMessage = 'Semprotan air sedang tidak aktif';
            }

            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('siram_log');
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);

            return ['success' => true, 'alertMessage' => $alertMessage];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
