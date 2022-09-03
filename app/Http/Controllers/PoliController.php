<?php

namespace App\Http\Controllers;

use App\Models\Poliklinik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PoliController extends Controller
{
    public function index()
    {
        $poliklinik = Poliklinik::all();
        return view('dashboard.poli.index', compact('poliklinik'));
    }

    public function createView()
    {

        return view('dashboard.poli.create');
    }

    public function savePoliklinik(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:polikliniks'
        ]);
        Poliklinik::create([
            'nama' => $request->nama
        ]);

        Alert::success('info', "Poliklinik " . $request->poliklinik . " berhasil ditambahkan");
        return redirect()->route('poli.index');
    }

    public function editView(Request $request, $id)
    {
        $poliklinik = Poliklinik::find($id);

        return view('dashboard.poli.edit', compact('poliklinik'));
    }

    public function editSave(Request $request, $id)
    {
        $poliklinik = Poliklinik::find($id);
        $poliklinik->update([
            'nama' => $request->nama
        ]);

        Alert::success('info', "Poliklinik " . $poliklinik->nama . " berhasil diubah");
        return redirect()->route('poli.index');
    }

    public function delete(Request $request, $id)
    {
        $poliklinik = Poliklinik::find($id);
        $poliklinik->delete();

        Alert::success('info', "Poliklinik " . $poliklinik->nama . " berhasil dihapus");
        return redirect()->route('poli.index');
    }
}
