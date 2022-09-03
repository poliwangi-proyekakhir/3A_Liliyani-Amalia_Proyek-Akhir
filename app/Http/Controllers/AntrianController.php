<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Models\AntrianPasien;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianController extends Controller
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

        // dd($antrian_sekarang_gigi);
        return view('dashboard.antrian.index', compact('antrian_sekarang_umum','antrian_sekarang_gigi'));
    }


    public function hadir($id)
    {
        $antrian = Antrian::find($id);

        $antrian->update([
            'kehadiran' => 'HADIR'
        ]);

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
            

        Alert::info('Pasien hadir');
        return view('dashboard.antrian.index', compact('antrian_sekarang_umum', 'antrian_sekarang_gigi'));
    }

    public function tidakHadir($id)
    {
        $antrian = Antrian::find($id);
        $antrian->update([
            'kehadiran' => 'TIDAK HADIR'
        ]);

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

        Alert::info('Pasien tidak hadir');
        return view('dashboard.antrian.index', compact('antrian_sekarang_umum', 'antrian_sekarang_gigi'));
    }
}
