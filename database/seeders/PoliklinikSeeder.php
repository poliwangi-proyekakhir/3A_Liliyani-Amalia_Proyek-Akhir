<?php

namespace Database\Seeders;

use App\Models\Poliklinik;
use Illuminate\Database\Seeder;

class PoliklinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poliklinik::create([
            'nama' => 'Poli Mata'
        ]);

        Poliklinik::create([
            'nama' => 'Poli Jantung'
        ]);
    }
}
