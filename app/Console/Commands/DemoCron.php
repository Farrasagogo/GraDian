<?php

namespace App\Console\Commands;

use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Firestore;
use Illuminate\Console\Command;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $database;
    protected $firestore;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database, Firestore $firestore)
    {
        parent::__construct();

        $this->database = $database;
        $this->firestore = $firestore;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       
        $timezone = new \DateTimeZone('Asia/Jakarta');
        $dateTime = new \DateTime('now', $timezone);
        $dateAndTime = $dateTime->format('Y-m-d H:i:s');

       
        $temperatureData = $this->database->getReference()->getValue();

        
        $firestoreDatabase = $this->firestore->database();

       
        $collectionReference = $firestoreDatabase->collection('sensors');

        
        $documentReference = $collectionReference->newDocument();

        
        $documentReference->set([
            'temperatureData' => $temperatureData,
            'dateAndTime' => [
                'logDate' => $dateAndTime 
            ],
        ]);

        $this->info('Temperature data stored in Firestore successfully at '.$dateAndTime.'.');

        
        sleep(10);

        return 0; 
    }
}
