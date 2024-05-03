<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;
use App\Models\Firebase\RiwayatSensorSiramModel;

class RiwayatSensorSiram extends Controller
{
    protected $riwayatSensorSiramModel;

    public function __construct(RiwayatSensorSiramModel $riwayatSensorSiramModel)
    {
        $this->riwayatSensorSiramModel = $riwayatSensorSiramModel;
    }

    public function index()
    {
        $data = $this->riwayatSensorSiramModel->getRiwayatSensorSiram();
        return view('firebase.riwayatsiram.index', compact('data'));
    }


}

