<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class RiwayatPenyinaran extends Controller
{
    protected $riwayatPenyinaranModel;

    public function __construct(RiwayatPenyinaranModel $riwayatPenyinaranModel)
    {
        $this->riwayatPenyinaranModel = $riwayatPenyinaranModel;
    }

    public function index()
    {
        $data = $this->riwayatPenyinaranModel->getRiwayatPenyinaran();
        return view('firebase.riwayatpenyinaran.index', compact('data'));
    }

}
