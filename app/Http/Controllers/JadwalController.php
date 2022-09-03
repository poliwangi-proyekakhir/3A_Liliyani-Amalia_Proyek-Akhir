<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jadwal\CreateJawalDokterRequest;
use App\Models\Jadwal;
use App\Models\Poliklinik;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
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

        return view('dashboard.jadwal.index', compact('jadwals'));
    }

    public function editView($id)
    {
        $polikliniks = Poliklinik::all();
        $user = User::find($id);

        return view('dashboard.jadwal.edit', compact('polikliniks', 'user'));
    }

    public function editSave(Request $request, $id)
    {
        $dokter = User::find($id);
        $jadwal_dokter = DB::table('jadwal_dokter')
            ->where('dokter_id', '=', $dokter->id)
            ->select('jadwal_dokter.jadwal_id', 'jadwal_dokter.poliklinik_id')
            ->get()[0];

        $jadwal = Jadwal::find($jadwal_dokter->jadwal_id);

        if (!$request->jadwal_buka && !$request->jadwal_tutup) {
            $dokter->update([
                'name' => $request->dokter
            ]);

            $dokter->dokterPolikliniks()->detach($jadwal_dokter->poliklinik_id);
            $dokter->dokterPolikliniks()->attach($request->poliklinik);
            $dokter->dokterPolikliniks()->update(['jadwal_id' => $jadwal->id]);

            Alert::success('info', "Jadwal dokter berhasil diupdate");
            return redirect()->route('jadwal.index');
        } else {
            $dokter->update([
                'name' => $request->dokter
            ]);

            $dokter->dokterPolikliniks()->detach($jadwal_dokter->poliklinik_id);
            $dokter->dokterPolikliniks()->attach($request->poliklinik);
            $dokter->dokterPolikliniks()->update(['jadwal_id' => $jadwal->id]);

            $jadwal->update([
                'jadwal_buka' => strtotime($request->jadwal_buka),
                'jadwal_tutup' => strtotime($request->jadwal_tutup)
            ]);

            Alert::success('info', "Jadwal dokter berhasil diupdate");
            return redirect()->route('jadwal.index');
        }
    }

    public function createView()
    {
        $polikliniks = Poliklinik::all();
        return view('dashboard.jadwal.create', compact('polikliniks'));
    }

    public function delete($id)
    {
        $jadwalDokter = User::find($id);
        $jadwalDokter->delete();

        Alert::success('info', "jadwal dokter " . $jadwalDokter->nama . " berhasil dihapus");
        return redirect()->route('jadwal.index');
    }

    public function saveJadwalDokter(CreateJawalDokterRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $dokter = User::create([
                'name' => $validated['dokter']
            ]);
            $jadwal = Jadwal::create([
                'jadwal_buka' => strtotime($request->jadwal_buka),
                'jadwal_tutup' => strtotime($request->jadwal_tutup)
            ]);
            $poliklinik = Poliklinik::find($validated['poliklinik']);

            $dokter->dokterPolikliniks()->attach($poliklinik->id);
            $dokter->dokterPolikliniks()->update(['jadwal_id' => $jadwal->id]);
        }

        Alert::success('info', "Jadwal dokter berhasil ditambahkan");
        return redirect()->route('jadwal.index');
    }


    public function timestampToDateFormat($date)
    {
        $tanggal = Carbon::createFromTimestamp(
            $date
        )->locale('id')->translatedFormat('D jS F h:i:s');

        return $tanggal;
    }
}
