<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = DB::table('antrian_pasiens')
            ->join('users', 'antrian_pasiens.user_id', '=', 'users.id')
            ->join('antrians', 'antrian_pasiens.antrian_id', '=', 'antrians.id')
            ->join('polikliniks', 'antrian_pasiens.poliklinik_id', '=', 'polikliniks.id')
            ->select(
                'users.id as id_pasien',
                'users.nik',
                'users.name',
                'users.tanggal_lahir',
                'users.tempat_lahir',
                'users.alamat',
                'users.phone',
                'polikliniks.nama as poliklinik',
                'antrians.id',
                'antrians.jadwal',
                'antrians.kehadiran',
                'antrians.keluhan',
                'antrian_pasiens.dokter_id'
            )->orderBy('antrians.id', 'asc')
            ->get();

            
        return view('dashboard.pasien.index', compact('pasiens'));
    }
}
