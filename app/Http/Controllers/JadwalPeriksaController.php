<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->get();
        return view('dokter.jadwal-periksa.index')->with([
            'jadwalPeriksas'=> $jadwalPeriksas
        ]);
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
        'hari' => 'required|string|max:10',
        'jam_mulai'   => 'required|date_format:H:i',
        'jam_selesai'     => 'required|date_format:H:i|after:jam_mulai',
    ]);

    if(
        JadwalPeriksa::where('id_dokter', Auth::user()->id)
        ->where('hari', $validateData['hari'])
        ->where('jam_mulai', $validateData['jam_mulai'])
        ->where('jam_selesai', $validateData['jam_selesai'])
        ->exists()
        ){
       return redirect()->route('dokter.jadwal-periksa.index')->with('danger', 'Jadwal sudah ada.');
        }

        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $validateData['hari'],
            'jam_mulai' => $validateData['jam_mulai'],
            'jam_selesai' => $validateData['jam_selesai'],
            'status' => 0
        ]);

        return redirect()->route('dokter.jadwal-periksa.index') ->with('success', 'Jadwal berhasil ditambah.');;
    }
    
    public function update($id)
{
    $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

    // Jika status saat ini nonaktif, aktifkan dan nonaktifkan jadwal lain
    if (!$jadwalPeriksa->status) {

        // Aktifkan jadwal yang dipilih
        $jadwalPeriksa->status = 1;
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal-periksa.index')
            ->with('success', 'Jadwal berhasil diaktifkan.');
    }

    // Jika status sedang aktif, maka nonaktifkan
    $jadwalPeriksa->status = 0;
    $jadwalPeriksa->save();

    return redirect()->route('dokter.jadwal-periksa.index')
        ->with('success', 'Jadwal berhasil dinonaktifkan.');
}

public function destroy($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->delete();

        return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'jadwal Periksa berhasil dihapus.');
    }
}