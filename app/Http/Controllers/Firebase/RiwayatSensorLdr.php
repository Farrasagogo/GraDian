<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Firebase\RiwayatSensorLdrModel;

class RiwayatSensorLdr extends Controller
{
    protected $riwayatSensorLdrModel;

    public function __construct(RiwayatSensorLdrModel $riwayatSensorLdrModel)
    {
        $this->riwayatSensorLdrModel = $riwayatSensorLdrModel;
    }

    public function index()
    {
        $data = $this->riwayatSensorLdrModel->getRiwayatSensorLdr();
        return view('firebase.riwayatldr.index', compact('data'));
    }
}
