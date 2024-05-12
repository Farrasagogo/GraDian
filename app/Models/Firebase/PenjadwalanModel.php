<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class PenjadwalanModel extends Model
{
    use HasFactory;
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function getJadwalData()
    {
        $firestoreDatabase = $this->firestore->database();
        $collection = $firestoreDatabase->collection('jadwal');
        $documents = $collection->documents();
        $dayTranslations = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        $data = [];

        foreach ($documents as $document) {
            $data[] = [
                'tipe_obat' => $document->data()['tipe_obat'],
                'tipe_jadwal' => $dayTranslations[$document->data()['tipe_jadwal']],
                'detail' => $document->data()['detail'],
                'jam_obat' => $document->data()['jam_obat'],
                'id' => $document->id(),
            ];
        }

        return $data;
    }

    public function getJadwalById($id)
    {
        $firestoreDatabase = $this->firestore->database();
        $collection = $firestoreDatabase->collection('jadwal');
        $document = $collection->document($id);

        if ($document->snapshot()->exists()) {
            $data = $document->snapshot()->data();
            $data['id'] = $id;
            return $data;
        }

        return false;
    }

    public function updateJadwal($data, $id) {
        $firestoreDatabase = $this->firestore->database();
        $collection = $firestoreDatabase->collection('jadwal');
        $document = $collection->document($id);
        if ($document->snapshot()->exists()) {
            $updateData = [];
            if (isset($data['tipe_obat'])) {
                $updateData['tipe_obat'] = $data['tipe_obat'];
            }
            if (isset($data['tipe_jadwal'])) {
                $updateData['tipe_jadwal'] = $data['tipe_jadwal'];
            }
            if (isset($data['detail'])) {
                $updateData['detail'] = $data['detail'];
            }
            if (isset($data['jam_obat'])) {
                $updateData['jam_obat'] = $data['jam_obat'];
            }
            $document->update($updateData);
            return true;
        }
        return false;
    }
    
    public function deleteJadwal($id)
    {
        $firestoreDatabase = $this->firestore->database();
        $collection = $firestoreDatabase->collection('jadwal');
        $document = $collection->document($id);

        if ($document->snapshot()->exists()) {
            $document->delete();
            return true;
        }

        return false;
    }

    public function storeJadwal($data)
    {
        $firestoreDatabase = $this->firestore->database();
        $collection = $firestoreDatabase->collection('jadwal');

        $collection->add([
            'tipe_obat' => $data['tipe_obat'],
            'tipe_jadwal' => $data['tipe_jadwal'],
            'detail' => $data['detail'],
            'jam_obat' => $data['jam_obat'],
        ]);
    }
    
}
