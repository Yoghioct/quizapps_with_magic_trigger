<?php

namespace Database\Seeders;

use App\Models\DinnerTable;
use App\Models\Participant;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalaDinnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path ke file CSV
        $csvFile = storage_path('app/No Meja.csv');

        if (!file_exists($csvFile)) {
            $this->command->error('File CSV tidak ditemukan di: ' . $csvFile);
            return;
        }

        // Baca file CSV
        $file = fopen($csvFile, 'r');

        // Skip header
        $header = fgetcsv($file);

        // Clear existing data (optional)
        $this->command->info('Membersihkan data lama...');
        DB::table('participants')->truncate();
        DB::table('dinner_tables')->truncate();

        // Reset auto increment untuk dinner tables jika diperlukan
        $dinnerTables = [];
        $teams = [];
        $participants = [];

        $this->command->info('Membaca data dari CSV...');

        while (($row = fgetcsv($file)) !== false) {
            // Mapping kolom CSV
            $nip = $row[0];
            $name = $row[1];
            $grade = $row[2];
            $gender = $row[3];
            $divisi = $row[4];
            $area = $row[5];
            $stay = $row[6];
            $tableNo = $row[7];

            // Format NIP dengan str_pad 5 digit
            $formattedNip = str_pad($nip, 5, '0', STR_PAD_LEFT);

            // Tentukan zona berdasarkan nomor table
            $zone = $this->determineZone($tableNo);

            // Simpan dinner table jika belum ada
            if (!isset($dinnerTables[$tableNo])) {
                $dinnerTable = DinnerTable::firstOrCreate(
                    ['nomor_table' => $tableNo],
                    [
                        'nama_table' => 'Table ' . $tableNo,
                        'nomor_table' => $tableNo,
                        'zona_table' => $zone,
                    ]
                );
                $dinnerTables[$tableNo] = $dinnerTable->id;
            }

            // Simpan team berdasarkan divisi jika belum ada
            if (!isset($teams[$divisi])) {
                $team = Team::firstOrCreate(
                    ['name' => $divisi],
                    ['name' => $divisi]
                );
                $teams[$divisi] = $team->id;
            }

            // Simpan participant
            Participant::create([
                'code' => $formattedNip,
                'full_name' => strtoupper($name),
                'id_team' => $teams[$divisi],
                'id_dinner_table' => $dinnerTables[$tableNo],
                'id_open_museum' => 1, // Default value, adjust as needed
            ]);

            $this->command->info("Imported: {$formattedNip} - {$name}");
        }

        fclose($file);

        $this->command->info('Import selesai!');
    }

    /**
     * Tentukan zona berdasarkan nomor table
     */
    private function determineZone($tableNo)
    {
        // Contoh logika zona - sesuaikan dengan kebutuhan
        if ($tableNo <= 5) {
            return 'VIP';
        } elseif ($tableNo <= 10) {
            return 'A';
        } elseif ($tableNo <= 15) {
            return 'B';
        } else {
            return 'C';
        }
    }
}
