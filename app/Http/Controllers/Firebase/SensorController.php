<?php

namespace App\Http\Controllers\Firebase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;


class SensorController extends Controller
{
    protected $database;
    protected $firestore;

    public function __construct(Database $database, Firestore $firestore)
    {
        $this->database = $database;
        $this->firestore = $firestore;
    }

    public function getSensorData()
    {
        $temperatureData = $this->database->getReference()->getValue();
    
        return response()->json($temperatureData);
    }
 
}




    

