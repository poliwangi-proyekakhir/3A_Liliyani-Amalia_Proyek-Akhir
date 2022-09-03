<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected $ROLE_PETUGAS = 1;
    protected $ROLE_PASIEN = 2;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petugas1 = User::create([
            'name' => 'Lilyani Amalia',
            'email' => 'lili@gmail.com',
            'alamat' => 'Banyuwangi',
            'username' => 'liliyani',
            'password' => Hash::make('11111111'),
        ]);

        $petugas1->roles()->attach($this->ROLE_PETUGAS);
    }
}
