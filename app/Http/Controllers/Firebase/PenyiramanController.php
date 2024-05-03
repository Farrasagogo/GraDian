<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;
use App\Models\Firebase\PenyiramanModel;

class PenyiramanController extends Controller
{
    protected $penyiramanModel;

    public function __construct(PenyiramanModel $penyiramanModel)
    {
        $this->penyiramanModel = $penyiramanModel;
    }

    public function index()
    {
        $isChecked = $this->penyiramanModel->getIsSiramauto();
        return view('firebase.penyiraman.index', compact('isChecked'));
    }

    public function updateFirebase(Request $request)
    {
        $result = $this->penyiramanModel->updateFirebaseManual();
        return response()->json($result);
    }

    public function updatesiramauto(Request $request)
    {
        $isChecked = $request->input('isChecked');
        $result = $this->penyiramanModel->updateSiramauto($isChecked);
        return response()->json($result);
    }
}
