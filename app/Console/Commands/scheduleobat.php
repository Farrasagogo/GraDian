<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class scheduleobat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:obat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $database;
    protected $firestore;

    public function __construct(Database $database, Firestore $firestore)
    {
        parent::__construct();

        $this->database = $database;
        $this->firestore = $firestore;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Get current day and time
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $dateTime = new \DateTime('now', $timezone);
            $currentDay = $dateTime->format('l'); // Full textual representation of the day
            $currentTime = $dateTime->format('H:i'); // 24-hour format of an hour and minutes
    
            // Query Firestore collection "jadwal"
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('jadwal')
                ->where('tipe_jadwal', '==', $currentDay)
                ->where('jam_obat', '==', $currentTime)
                ->where('tipe_obat', '==', 'Fungisida');
    
            $documents = $collectionReference->documents();
    
            // Check if any matching documents exist
            if (!$documents->isEmpty()) {
                // Send data to Firebase Realtime Database
                $this->database->getReference('jadwalobat')->set(true);
    
                $this->info('Jadwal obat matched. Sent value to Firebase Realtime Database.');
            } else {
                $this->info('No matching jadwal obat found.');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
