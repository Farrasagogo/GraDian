<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Firebase\PenjadwalanModel;

class Penjadwalan extends Controller
{
    protected $penjadwalanModel;

    public function __construct(PenjadwalanModel $penjadwalanModel)
    {
        $this->penjadwalanModel = $penjadwalanModel;
    }

    public function index()
    {
        $data = $this->penjadwalanModel->getJadwalData();
        return view('firebase.jadwal.index', compact('data'));
    }

    public function edit($id)
{
    $data = $this->penjadwalanModel->getJadwalById($id);
    return view('edit', compact('data'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'tipe_obat' => 'required|string',
        'tipe_jadwal' => 'required|string',
        'detail' => 'required|string',
        'jam_obat' => 'required|string',
    ]);

    if ($this->checkNotNull($validatedData)) {
        return redirect()->back()->with('error', 'All fields are required.');
    }

    $this->penjadwalanModel->updateJadwal($id, $validatedData);
    return response()->json([
        'success' => true,
        'redirectRoute' => 'jadwal',
        'successMessage' => 'Jadwal berhasil diperbarui',
    ]);
}

    public function destroy($id)
    {
        $result = $this->penjadwalanModel->deleteJadwal($id);
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Jadwal berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }
    
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'tipe_obat' => 'required|string',
            'tipe_jadwal' => 'required|string',
            'detail' => 'required|string',
            'jam_obat' => 'required|string',
        ]);

        // Check if any required field is null
        if ($this->checkNotNull($validatedData)) {
            return redirect()->back()->with('error', 'All fields are required.');
        }

        $this->penjadwalanModel->storeJadwal($validatedData);
        

        return response()->json([
            'success' => true,
            'redirectRoute' => 'jadwal', 
            'successMessage' => 'Jadwal berhasil ditambahkan',
        ]);
    }

    private function checkNotNull($data)
    {
        return is_null($data['tipe_obat']) || is_null($data['tipe_jadwal']) || is_null($data['detail']) || is_null($data['jam_obat']);
    }
}
