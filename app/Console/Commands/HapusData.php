<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;

class HapusData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hapus:data';


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
        // Get Firestore database instance
    $firestoreDatabase = $this->firestore->database();

    // Reference to the 'sensors' collection
    $collectionReference = $firestoreDatabase->collection('sensors');

    // Define the cutoff date (3 days ago) in the 'Asia/Jakarta' timezone
    $timezone = new \DateTimeZone('Asia/Jakarta');
    $dateTime = new \DateTime('now', $timezone);
    $cutoffDate = $dateTime->modify('-3 days')->format('Y-m-d H:i:s');

    // Query documents where 'logDate' is more than 3 days ago
    $query = $collectionReference->where('dateAndTime.logDate', '<', $cutoffDate);
    $documents = $query->documents();

    // Iterate through the documents and delete them
    foreach ($documents as $document) {
        // Delete the document
        $document->reference()->delete();

        // Log deletion
        $this->info('Document deleted: ' . $document->id());
    }

    $this->info('Old documents deleted successfully.');
    }
}
