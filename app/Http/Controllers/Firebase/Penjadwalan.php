<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;
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
        if ($data) {
            return view('firebase.jadwal.edit', compact('data'));
        } else {
            return redirect()->back()->with('error', 'Data not found');        }
    }

    public function update(Request $request, $id)
    {
        $result = $this->penjadwalanModel->updateJadwal($request->all(), $id);
        if ($result) {
            return redirect()->route('jadwal')->with('success', 'Data updated successfully');
        } else {
            return redirect()->back()->with('error', 'Data not found');
        }
    }

    public function destroy($id)
    {
        $result = $this->penjadwalanModel->deleteJadwal($id);
        if ($result) {
            return redirect()->back()->with('success', 'Data deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Data not found');
        }
    }

    public function store(Request $request)
    {
        $this->penjadwalanModel->storeJadwal($request->all());
        return redirect()->route('jadwal')->with('success', 'Data added successfully');
    }
}
