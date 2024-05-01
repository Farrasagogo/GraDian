<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class Penjadwalan extends Controller
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
            $collection = $firestoreDatabase->collection('jadwal');
            $documents = $collection->documents();
            $data = [];
    
            foreach ($documents as $document) {
                $data[] = [
                    'tipe_obat' => $document->data()['tipe_obat'],
                    'tipe_jadwal' => $document->data()['tipe_jadwal'],
                    'detail' => $document->data()['detail'],
                    'jam_obat' => $document->data()['jam_obat'],
                    'id' => $document->id(),
                ];
            }
    
            return view('firebase.jadwal.index', compact('data'));
        }
                public function edit($id)
        {
            $firestoreDatabase = $this->firestore->database();
            $collection = $firestoreDatabase->collection('jadwal');
            $document = $collection->document($id);

            if ($document->snapshot()->exists()) {
                $data = $document->snapshot()->data();
                $data['id'] = $id; // Add the 'id' key to the $data array
                return view('firebase.jadwal.edit', compact('data'));
            } else {
                return redirect()->back()->with('error', 'Data not found');
            }
}
    
        public function update(Request $request, $id)
        {

    
            $firestoreDatabase = $this->firestore->database();
            $collection = $firestoreDatabase->collection('jadwal');
            $document = $collection->document($id);
    
            $data = [
                'tipe_obat' => $request->input('tipe_obat'),
                'tipe_jadwal' => $request->input('tipe_jadwal'),
                'detail' => $request->input('detail'),
                'jam_obat' => $request->input('jam_obat'),
            ];
    
            $document->set($data, ['merge' => true]);
    
            return redirect()->route('jadwal')->with('success', 'Data updated successfully');
        }
    
        public function destroy($id)
        {

    
            $firestoreDatabase = $this->firestore->database();
            $collection = $firestoreDatabase->collection('jadwal');
            $document = $collection->document($id);
    
            if ($document->snapshot()->exists()) {
                $document->delete();
    
                return redirect()->back()->with('success', 'Data deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Data not found');
            }
        }
        
        public function store(Request $request)
{
    $firestoreDatabase = $this->firestore->database();
    $collection = $firestoreDatabase->collection('jadwal');

    $data = [
        'tipe_obat' => $request->input('tipe_obat'),
        'tipe_jadwal' => $request->input('tipe_jadwal'),
        'detail' => $request->input('detail'),
        'jam_obat' => $request->input('jam_obat'),
    ];

    $collection->add($data);

    return redirect()->route('firebase.jadwal.index')->with('success', 'Data added successfully');
}
  
}
