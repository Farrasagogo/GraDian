<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;


class ObatController extends Controller
{
    protected $database;
    protected $firestore;
    

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;

        
    }
    public function index() {
        $reference = $this->database->getReference('obatauto');
        $isChecked = $reference->getValue();
        return view('firebase.obat.index', compact('isChecked'));
    }

    public function updateFirebase(Request $request)
    { $timezone = new \DateTimeZone('Asia/Jakarta');
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
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateFirebase2(Request $request)
    { $timezone = new \DateTimeZone('Asia/Jakarta');
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
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateobatauto(Request $request)
{
    $timezone = new \DateTimeZone('Asia/Jakarta');
    $dateTime = new \DateTime('now', $timezone);
    $dateAndTime = $dateTime->format('Y-m-d H:i:s');

    try {
        $isChecked = $request->input('isChecked');
        $reference = $this->database->getReference('obatauto');
        $reference->set($isChecked);
    
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Return a JSON response with an error message if an exception occurs
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}
 
}
