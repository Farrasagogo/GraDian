<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\ObatModel;


class ObatController extends Controller
{
    protected $obatModel;

    public function __construct(ObatModel $obatModel)
    {
        $this->obatModel = $obatModel;
    }

    public function index()
    {
        $isChecked = $this->obatModel->getObatautoStatus();
        return view('firebase.obat.index', compact('isChecked'));
    }

    public function updateFirebase(Request $request)
    {
        $result = $this->obatModel->updateFirebaseManualPestisida();
        return response()->json($result);
    }

    public function updateFirebase2(Request $request)
    {
        $result = $this->obatModel->updateFirebaseManualFungisida();
        return response()->json($result);
    }

    public function updateobatauto(Request $request)
    {
        $isChecked = $request->input('isChecked');
        $result = $this->obatModel->updateObatauto($isChecked);
        return response()->json($result);
    }
 
}
