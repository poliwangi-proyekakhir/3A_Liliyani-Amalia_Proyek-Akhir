<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Antrian;
use Illuminate\Http\File;
use App\Mail\Notification;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use App\Models\AntrianPasien;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PendaftaranController extends Controller
{
    public function pasienBaruView($poli_id = 0)
    {
        $polikliniks = Poliklinik::all();
        $dokters = DB::table('jadwal_dokter')
            ->join('users', 'jadwal_dokter.dokter_id', '=', 'users.id')
            ->join('jadwals', 'jadwal_dokter.jadwal_id', '=', 'jadwals.id')
            ->join('polikliniks', 'jadwal_dokter.poliklinik_id', '=', 'polikliniks.id')
            ->select(
                'users.id as dokter_id',
                'users.name as nama_dokter',
                'jadwals.jadwal_buka',
                'jadwals.jadwal_tutup',
                'polikliniks.id as id_poli',
                'polikliniks.nama as nama_poli'
            )
            ->orderBy('polikliniks.nama', 'asc')
            ->get();

        foreach ($dokters as $dokter) {
            $dokter->jadwal_buka = $this->timestampToDateFormat($dokter->jadwal_buka);
            $dokter->jadwal_tutup = $this->timestampToDateFormat($dokter->jadwal_tutup);
        }


        return view('pendaftaran.pasien-baru', compact('polikliniks', 'dokters'));
    }

    public function pasienLamaView()
    {
        return view('pendaftaran.pasien-lama');
    }

    public function cariPasienLama(Request $request)
    {
        $pasien_lama = User::where('nik', $request->nik)->get();
        $pasien_tidak_ditemukan = count($pasien_lama) < 1;

        if ($pasien_tidak_ditemukan) {
            Alert::error('info', "Pasien dengan NIK $request->nik tidak ditemukan");
            return back();
        }

        $polikliniks = Poliklinik::all();
        $dokters = DB::table('jadwal_dokter')
            ->join('users', 'jadwal_dokter.dokter_id', '=', 'users.id')
            ->join('jadwals', 'jadwal_dokter.jadwal_id', '=', 'jadwals.id')
            ->join('polikliniks', 'jadwal_dokter.poliklinik_id', '=', 'polikliniks.id')
            ->select(
                'users.id as dokter_id',
                'users.name as nama_dokter',
                'jadwals.jadwal_buka',
                'jadwals.jadwal_tutup',
                'polikliniks.id as id_poli',
                'polikliniks.nama as nama_poli'
            )
            ->orderBy('polikliniks.nama', 'asc')
            ->get();

        return view('pendaftaran.pasien-lama-form', compact('pasien_lama', 'polikliniks', 'dokters'));
    }

    public function riwayatPasienLama(Request $request)
    {
        $pasien_lama = User::where('nik', $request->nik)->get();
        $pasien_tidak_ditemukan = count($pasien_lama) < 1;

        if ($pasien_tidak_ditemukan) {
            Alert::error('info', "Riwayat Pasien dengan NIK $request->nik tidak ditemukan");
            return back();
        }

        $riwayat = DB::table('antrian_pasiens')
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
        )
        ->where('users.nik', '=',$request->nik)
        ->orderBy('antrians.id', 'asc')
        ->get();

        // dd($riwayat);

        return view('pendaftaran.pasien-lama-riwayat', compact('pasien_lama', 'riwayat'));
    }


    public function daftarAntrian(Request $request)
    {

        $poliklinik = Poliklinik::find($request->poliklinik_id);
        $qrcode = $this->generateQrCode($request->tanggal_pemeriksaan .'-'.$poliklinik->nama .'-'.$request->nama.'-'. now()->format('d-m-Y'));

        $tipe_pasien = $request->tipe;
        if ($tipe_pasien === 'lama') {
            $pasien_lama = User::where('nik', $request->nik)->get()->first();
            $pasien_lama->update([
                'name' => $request->nama,
                'alamat' => $request->alamat,
                'phone' => $request->whatsapp
            ]);

            $no_antri = DB::table('antrians')
                ->select('antrians.no_antri as no')
                ->join('antrian_pasiens', 'antrian_pasiens.antrian_id','=','antrians.id')
                ->join('polikliniks', 'antrian_pasiens.poliklinik_id','=','polikliniks.id')
                ->where('antrians.jadwal', "=", Carbon::parse($request->tanggal_pemeriksaan)->timestamp)
                ->where('polikliniks.id','=', $request->poliklinik_id)
                ->orderBy('no_antri', 'desc')
                ->first();

            $no = 1;
            if ($no_antri != null) {
                $no = $no_antri->no + 1;
            }

            $antrian = Antrian::create([
                'jadwal' => strtotime($request->tanggal_pemeriksaan),
                'kehadiran' => 'MENUNGGU ANTRIAN',
                'keluhan' => $request->keluhan,
                'no_antri' => $no
            ]);

            $antrianPasien = AntrianPasien::create([
                'user_id' => $pasien_lama->id,
                'dokter_id' => $request->dokter_id,
                'antrian_id' => $antrian->id,
                'poliklinik_id' => $request->poliklinik_id,
                'qrcode' => $qrcode
            ]);

            // Variabel Data berisi informasi untuk mengirim notifikasi lewat WhatsApp
            $data = [
                'phone' => $request->whatsapp,
                'file' => $qrcode,
                'caption' => 'Antrian ke ' . $no . ' pada tanggal ' . Carbon::parse($request->tanggal_pemeriksaan)->format('d-m-Y')
            ];

            // Variabel Details berisi informasi untuk mengirim notifikasi lewat Email
            $details = [
                'title' => 'Email dari Klinik Pratama Dr. Didik Sulasmono',
                'body' => 'Antrian ke ' . $no . ' pada tanggal ' . Carbon::parse($request->tanggal_pemeriksaan)->format('d-m-Y'),
                'qrcode' => $qrcode
            ];

            // Function Memanggil class Mail dan mengirim kan notifikasi
            Mail::to($pasien_lama->email)->send(new Notification($details));

            return view('pendaftaran.selesai-pendaftaran', compact('data'));
        } else if ($tipe_pasien === 'baru') {
            $all = User::where('email', $request->email)->get();
            if ($all->isNotEmpty()) {
                // dd($all);
                Alert::error('Email Sudah digunakan');
                return redirect()->back();
            }
            $pasienBaru = User::create([
                'email' => $request->email,
                'name' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'phone' => $request->whatsapp
            ]);

            $no_antri = DB::table('antrians')
            ->join('antrian_pasiens', 'antrian_pasiens.antrian_id','=','antrians.id')
                ->join('polikliniks', 'antrian_pasiens.poliklinik_id','=','polikliniks.id')
                ->select('no_antri as no')
                ->where('jadwal', '=', strtotime($request->tanggal_pemeriksaan))
                ->where('polikliniks.id','=', $request->poliklinik_id)
                ->orderBy('no_antri', 'desc')
                ->first();
            
            $no = 1;
            if ($no_antri != null) {
                $no = $no_antri->no + 1;
            }

            $antrian = Antrian::create(
                [
                    'jadwal' => strtotime($request->tanggal_pemeriksaan),
                    'kehadiran' => 'MENUNGGU ANTRIAN',
                    'keluhan' => $request->keluhan,
                    'no_antri' => $no
                ]
            );

            $antrianPasien = AntrianPasien::create([
                'user_id' => $pasienBaru->id,
                'dokter_id' => $request->dokter_id,
                'antrian_id' => $antrian->id,
                'poliklinik_id' => $request->poliklinik_id,
                'qrcode' => ''
            ]);

            // Variabel Data berisi informasi untuk mengirim notifikasi lewat WhatsApp
            $data = [
                'phone' => $request->whatsapp,
                'file' => $qrcode,
                'caption' => 'Antrian ke ' . $no . ' pada tanggal ' . Carbon::parse($request->tanggal_pemeriksaan)->format('d-m-Y')
            ];

            // Variabel Details berisi informasi untuk mengirim notifikasi lewat Email
            $details = [
                'title' => 'Email dari Klinik Pratama Dr. Didik Sulasmono',
                'body' => 'Antrian ke ' . $no . ' pada tanggal ' . Carbon::parse($request->tanggal_pemeriksaan)->format('d-m-Y'),
                'qrcode' => $qrcode
            ];

            // Function Memanggil class Mail dan mengirim kan notifikasi
            Mail::to($pasienBaru->email)->send(new Notification($details));
            // Alert::success('info', 'Profil berhasil diupdate');
            // return redirect()->route('pendaftaran.selesai')->with('nama', $pasienBaru->name);
            return view('pendaftaran.selesai-pendaftaran', compact('data'));
        }
    }

    public function pendaftaranSelesai(Request $request)
    {
        return view('pendaftaran.selesai-pendaftaran');
    }

    public function generateQrCode($data)
    {
        $qrcode = (string)QrCode::format('png')->margin(5)->size(100)->generate($data);
        // dd($qrcode);
        // $filePath = Storage::putFile('qrcode', new File());
        // dd($filePath);
        // $fileName = explode('/', $filePath)[1];
        $output_file = 'qrcode/img-' . $data . '.png';
        Storage::put('public/' . $output_file, $qrcode);


        return $output_file;
    }

    public function timestampToDateFormat($date)
    {
        $tanggal = Carbon::createFromTimestamp(
            $date
        )->locale('id')->translatedFormat('D j h:i');

        return $tanggal;
    }
}
