<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Firebase\RiwayatPenyiramanModel;

class RiwayatPenyiraman extends Controller
{
    protected $riwayatPenyiramanModel;

    public function __construct(RiwayatPenyiramanModel $riwayatPenyiramanModel)
    {
        $this->riwayatPenyiramanModel = $riwayatPenyiramanModel;
    }

    public function index()
    {
        $data = $this->riwayatPenyiramanModel->getRiwayatPenyiraman();
        return view('firebase.riwayatpenyiraman.index', compact('data'));
    }
}
