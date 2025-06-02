<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('dokter.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function store(Request $request)
    {
        // Validasi format input
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:100',
            'kemasan'   => 'required|string|max:50',
            'harga'     => 'required|numeric|min:0', // hanya angka dan tidak boleh negatif
        ]);

        // Normalisasi untuk pengecekan duplikat nama dan kemasan
        $namaObat = trim(strtolower($validated['nama_obat']));
        $kemasan  = trim(strtolower($validated['kemasan']));

        // Cek apakah kombinasi nama_obat dan kemasan sudah ada
        $exists = Obat::whereRaw('LOWER(TRIM(nama_obat)) = ?', [$namaObat])
                      ->whereRaw('LOWER(TRIM(kemasan)) = ?', [$kemasan])
                      ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_obat' => 'Nama obat dan kemasan yang sama sudah ada.']);
        }

        // Simpan data asli (bisa simpan yang dinormalisasi jika ingin konsistensi)
        Obat::create($validated);

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:100',
            'kemasan'   => 'required|string|max:50',
            'harga'     => 'required|numeric|min:0',
        ]);

        $obat = Obat::findOrFail($id);

        // Normalisasi nama dan kemasan
        $namaObat = trim(strtolower($validated['nama_obat']));
        $kemasan  = trim(strtolower($validated['kemasan']));

        // Cek apakah kombinasi nama_obat dan kemasan sudah ada di data lain
        $exists = Obat::where('id', '!=', $obat->id)
                      ->whereRaw('LOWER(TRIM(nama_obat)) = ?', [$namaObat])
                      ->whereRaw('LOWER(TRIM(kemasan)) = ?', [$kemasan])
                      ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nama_obat' => 'Nama obat dan kemasan yang sama sudah ada.']);
        }

        // Update data
        $obat->update($validated);

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
