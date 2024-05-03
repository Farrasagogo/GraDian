<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Firebase\RiwayatObatModel;

class RiwayatObat extends Controller
{
    protected $riwayatObatModel;

    public function __construct(RiwayatObatModel $riwayatObatModel)
    {
        $this->riwayatObatModel = $riwayatObatModel;
    }

    public function index()
    {
        $data = $this->riwayatObatModel->getRiwayatObat();
        return view('firebase.riwayatobat.index', compact('data'));
    }
}
