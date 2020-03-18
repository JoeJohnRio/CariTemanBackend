<?php

use App\RelationBidangKerja;
use App\UlasanTempatPkl;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FakultasSeeder::class);
        $this->call(ProgramStudiSeeder::class);
        $this->call(KeminatanSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(RelationTemanTableSeeder::class);
        $this->call(HistoryLihatProfilSeeder::class);
        $this->call(BidangKerjaSeeder::class);
        $this->call(LokasiPklSeeder::class);
        $this->call(TempatPklSeeder::class);
        $this->call(HistoryLihatTempatPklSeeder::class);
        $this->call(PengalamanLombaSeeder::class);
        $this->call(PengalamanOrganisasiSeeder::class);
        $this->call(RelationBidangKerjaSeeder::class);
        $this->call(KelompokSeeder::class);
        $this->call(RekomendasiSeeder::class);
        $this->call(UlasanTempatPklSeeder::class);
    }
}
