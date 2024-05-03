<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class PenyinaranModel extends Model
{
    use HasFactory;
    protected $database;
    protected $firestore;

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;
    }

    public function getIsSinarauto()
    {
        $reference = $this->database->getReference('sinarauto');
        return $reference->getValue();
    }

    public function getIsSinar()
    {
        $reference = $this->database->getReference('sinar');
        return $reference->getValue();
    }

    public function updateSinar($isChecked)
    {
        try {
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $dateTime = new \DateTime('now', $timezone);
            $dateAndTime = $dateTime->format('Y-m-d H:i:s');

            $reference = $this->database->getReference('sinar');
            $reference->set($isChecked);

            $condition = $isChecked ? 'Lampu Hidup' : 'Lampu Mati';
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('sinar_log');
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function updateSinarauto($isChecked)
    {
        try {
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $dateTime = new \DateTime('now', $timezone);
            $dateAndTime = $dateTime->format('Y-m-d H:i:s');

            $reference = $this->database->getReference('sinarauto');
            $reference->set($isChecked);

            $condition = $isChecked ? 'Automatisasi Hidup' : 'Automatisasi Mati';
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('sinar_log');
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);

            $ldrValue = $this->database->getReference('ldrValue')->getValue();
            $alertMessage = $ldrValue > 800 ? 'Lampu UV sedang aktif' : 'Lampu UV sedang tidak aktif';

            return ['success' => true, 'alertMessage' => $alertMessage];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
}
