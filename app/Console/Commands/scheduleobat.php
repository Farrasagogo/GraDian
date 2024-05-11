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
            // Dapatkan hari dan waktu saat ini
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $dateTime = new \DateTime('now', $timezone);
            $dateTime->modify('+1 hari');
            $currentDay = $dateTime->format('l');
            $currentTime = $dateTime->format('H:i');
        
    
            // Kueri koleksi Firestore "jadwal"
            $firestoreDatabase = $this->firestore->database();
            $collectionReference = $firestoreDatabase->collection('jadwal')
                ->where('tipe_jadwal', '==', $currentDay)
                ->where('jam_obat', '==', $currentTime);
        
            $documents = $collectionReference->documents();
        
            foreach ($documents as $document) {
                $data = $document->data();
                $tipeObat = $data['tipe_obat'];
                $dateAndTime = $dateTime->format('Y-m-d H:i:s');

        
                if ($tipeObat === 'Pestisida') {
                    $reference = $this->database->getReference('jadwalobatpestisida');
                    $reference->set(true);

                    $obatLogCollection = $firestoreDatabase->collection('obat_log');
                    $obatLogCollection->add([
                        'condition' => 'Penjadwalan Penyiraman Pestisida',
                        'dateAndTime' => $dateAndTime,
                    ]);
                } elseif ($tipeObat === 'Fungisida') {
                    $reference = $this->database->getReference('jadwalobatfungisida');
                    $reference->set(true);

                    $obatLogCollection = $firestoreDatabase->collection('obat_log');
                    $obatLogCollection->add([
                        'condition' => 'Penjadwalan Penyiraman Fungisida',
                        'dateAndTime' => $dateAndTime,
                    ]);
                }
            }
        } catch (\Exception $e) {
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
