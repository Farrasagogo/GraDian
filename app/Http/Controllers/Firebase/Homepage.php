<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\RiwayatSensorLdrModel;
use App\Models\Firebase\RiwayatSensorSiramModel;

class Homepage extends Controller
{
    protected $riwayatSensorSiramModel;
    protected $riwayatSensorLdrModel;

    public function __construct(RiwayatSensorLdrModel $riwayatSensorLdrModel, RiwayatSensorSiramModel $riwayatSensorSiramModel)
    {
        $this->riwayatSensorLdrModel = $riwayatSensorLdrModel;
        $this->riwayatSensorSiramModel = $riwayatSensorSiramModel;
    }

    public function index()
    {
        $dataLdr = $this->riwayatSensorLdrModel->getRiwayatSensorLdr();
        $dataSiram = $this->riwayatSensorSiramModel->getRiwayatSensorSiram();
        return view('firebase.homepage.index', compact('dataLdr', 'dataSiram'));
    }
}
