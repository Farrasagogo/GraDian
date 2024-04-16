<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class PenyinaranController extends Controller
{
    protected $database;
    protected $firestore;
    

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;

        
    }
    public function index()
    {   $reference = $this->database->getReference('sinarauto');
        $isChecked = $reference->getValue();
        $reference = $this->database->getReference('sinar');
        $isChecked2 = $reference->getValue();
        return view('firebase.penyinaran.index', compact('isChecked','isChecked2'));
    }

    public function updatesinar(Request $request)
    {   $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateTime = new \DateTime('now', $timezone);
        $dateAndTime = $dateTime->format('Y-m-d H:i:s');
        try {
            $isChecked = $request->input('isChecked');
            $reference = $this->database->getReference('sinar');
            $reference->set($isChecked);
            $condition = $isChecked ? 'Lampu Hidup' : 'Lampu Mati';
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('sinar_log');
            $collectionReference->add([
                'dateAndTime' => $dateAndTime,
                'condition' => $condition
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updatesinarauto(Request $request)
{
    $timezone = new \DateTimeZone('Asia/Jakarta');
    $dateTime = new \DateTime('now', $timezone);
    $dateAndTime = $dateTime->format('Y-m-d H:i:s');

    try {
        $isChecked = $request->input('isChecked');
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

    
        return response()->json(['success' => true, 'alertMessage' => $alertMessage]);
    } catch (\Exception $e) {
        // Return a JSON response with an error message if an exception occurs
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

    
}
