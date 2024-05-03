<?php

namespace App\Models\Firebase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class SensorModel extends Model
{
    use HasFactory;
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getTemperatureData()
    {
        $temperatureData = $this->database->getReference()->getValue();
        return $temperatureData;
    }
}
