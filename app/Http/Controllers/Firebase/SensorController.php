<?php

namespace App\Http\Controllers\Firebase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Firebase\SensorModel;


class SensorController extends Controller
{
    protected $sensorModel;

    public function __construct(SensorModel $sensorModel)
    {
        $this->sensorModel = $sensorModel;
    }

    public function getSensorData()
    {
        $temperatureData = $this->sensorModel->getTemperatureData();
        return response()->json($temperatureData);
    }
}




    

