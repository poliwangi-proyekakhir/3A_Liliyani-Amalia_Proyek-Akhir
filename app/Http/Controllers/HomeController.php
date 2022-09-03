<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $antrian_sekarang_umum = DB::table('antrians')
        ->join('antrian_pasiens', 'antrian_pasiens.antrian_id','=','antrians.id')
        ->join('polikliniks', 'antrian_pasiens.poliklinik_id','=','polikliniks.id')
        ->select('antrians.no_antri as nomor_antrian', 'antrians.id as id_antrian')
        ->where('antrians.kehadiran', '=', 'MENUNGGU ANTRIAN')
        ->where('polikliniks.nama', '=', 'Poli Umum')
        ->whereDate('jadwal', "=", Carbon::now()->timestamp)
        ->get()->first();

        $antrian_sekarang_gigi = DB::table('antrians')
        ->join('antrian_pasiens', 'antrian_pasiens.antrian_id','=','antrians.id')
        ->join('polikliniks', 'antrian_pasiens.poliklinik_id','=','polikliniks.id')
        ->select('antrians.no_antri as nomor_antrian', 'antrians.id as id_antrian')
        ->where('antrians.kehadiran', '=', 'MENUNGGU ANTRIAN')
        ->where('polikliniks.nama', '=', 'Poli Gigi')
        ->whereDate('jadwal', "=", Carbon::now()->timestamp)
        ->get()->first();

        return  view('dashboard.index', compact('antrian_sekarang_umum', 'antrian_sekarang_gigi'));
    }


    public function clientAntrian()
    {
        // $antrian_sekarang = DB::table('antrians')
        //     ->select('antrians.id as nomor_antrian')
        //     ->where('kehadiran', '=', 'MENUNGGU ANTRIAN')
        //     ->get()->first();

        $antrian_sekarang_umum = DB::table('antrians')
        ->join('antrian_pasiens', 'antrian_pasiens.antrian_id','=','antrians.id')
        ->join('polikliniks', 'antrian_pasiens.poliklinik_id','=','polikliniks.id')
        ->select('antrians.no_antri as nomor_antrian', 'antrians.id as id_antrian')
        ->where('antrians.kehadiran', '=', 'MENUNGGU ANTRIAN')
        ->where('polikliniks.nama', '=', 'Poli Umum')
        ->whereDate('jadwal', "=", Carbon::now()->timestamp)
        ->get()->first();

        $antrian_sekarang_gigi = DB::table('antrians')
        ->join('antrian_pasiens', 'antrian_pasiens.antrian_id','=','antrians.id')
        ->join('polikliniks', 'antrian_pasiens.poliklinik_id','=','polikliniks.id')
        ->select('antrians.no_antri as nomor_antrian', 'antrians.id as id_antrian')
        ->where('antrians.kehadiran', '=', 'MENUNGGU ANTRIAN')
        ->where('polikliniks.nama', '=', 'Poli Gigi')
        ->whereDate('jadwal', "=", Carbon::now()->timestamp)
        ->get()->first();
        // dd($antrian_sekarang);

        $jadwals = DB::table('jadwal_dokter')
            ->join('users', 'jadwal_dokter.dokter_id', '=', 'users.id')
            ->join('polikliniks', 'jadwal_dokter.poliklinik_id', '=', 'polikliniks.id')
            ->join('jadwals', 'jadwal_dokter.jadwal_id', '=', 'jadwals.id')
            ->select(
                'users.id as dokter_id',
                'users.name as nama_dokter',
                'polikliniks.nama as poliklinik',
                'jadwals.jadwal_buka',
                'jadwals.jadwal_tutup'
            )
            ->get();

        foreach ($jadwals as $jadwal) {
            $jadwal->jadwal_buka = $this->timestampToDateFormat($jadwal->jadwal_buka);
            $jadwal->jadwal_tutup = $this->timestampToDateFormat($jadwal->jadwal_tutup);
        }

        return  view('welcome', compact('antrian_sekarang_umum','antrian_sekarang_gigi','jadwals'));
    }

    public function timestampToDateFormat($date)
    {
        $tanggal = Carbon::createFromTimestamp(
            $date
        )->locale('id')->translatedFormat('D jS F h:i:s');

        return $tanggal;
    }

}
