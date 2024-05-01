<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class PenyiramanController extends Controller
{
    protected $database;
    protected $firestore;
    

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;

        
    }
    public function index()
    {   $reference = $this->database->getReference('siramauto');
        $isChecked = $reference->getValue();

        return view('firebase.penyiraman.index', compact('isChecked'));

    }
    
    public function updateFirebase(Request $request)
    { $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateTime = new \DateTime('now', $timezone);
        $dateAndTime = $dateTime->format('Y-m-d H:i:s');
        try {
            $reference = $this->database->getReference('siram');
            $reference->set(true);
            $condition = 'Penyiraman Manual';
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('siram_log'); 
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updatesiramauto(Request $request)
{
    $timezone = new \DateTimeZone('Asia/Jakarta');
    $dateTime = new \DateTime('now', $timezone);
    $dateAndTime = $dateTime->format('Y-m-d H:i:s');

    try {
        $isChecked = $request->input('isChecked');

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

        return response()->json(['success' => true, 'alertMessage' => $alertMessage]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


}
