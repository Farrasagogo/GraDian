<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\PenyinaranModel;


class PenyinaranController extends Controller
{
    protected $penyinaranModel;

    public function __construct(PenyinaranModel $penyinaranModel)
    {
        $this->penyinaranModel = $penyinaranModel;
    }

    public function index()
    {
        $isChecked = $this->penyinaranModel->getIsSinarauto();
        $isChecked2 = $this->penyinaranModel->getIsSinar();
        return view('firebase.penyinaran.index', compact('isChecked', 'isChecked2'));
    }

    public function updatesinar(Request $request)
    {
        $isChecked = $request->input('isChecked');
        $result = $this->penyinaranModel->updateSinar($isChecked);
        return response()->json($result);
    }

    public function updatesinarauto(Request $request)
    {
        $isChecked = $request->input('isChecked');
        $result = $this->penyinaranModel->updateSinarauto($isChecked);
        return response()->json($result);
    }

    
}
