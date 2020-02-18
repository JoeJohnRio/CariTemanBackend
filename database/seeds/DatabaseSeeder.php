<?php

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
        $this->call(MahasiswaSeeder::class);
        $this->call(FakultasSeeder::class);
        $this->call(ProgramStudiSeeder::class);
        $this->call(KeminatanSeeder::class);
        $this->call(RelationTemanTableSeeder::class);
        $this->call(HistoryLihatProfilSeeder::class);
    }
}
