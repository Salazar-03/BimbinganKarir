<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal periksa dari tabel 'jadwal_periksas' 
        // di mana 'id_dokter' sesuai dengan ID dari user yang sedang login
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->get();
        // Kirim data jadwal ke view 'dokter.jadwal-periksa.index'
        return view('dokter.jadwal-periksa.index', [
            'jadwalPeriksas' => $jadwalPeriksas
        ]);
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
        //validasi
        $validateData = $request->validate([
            'hari'        => 'required|string|max:10',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);
        //validasi jadwal yang sama
        $exists = JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('hari', $validateData['hari'])
            ->where('jam_mulai', $validateData['jam_mulai'])
            ->where('jam_selesai', $validateData['jam_selesai'])
            ->exists();

        if ($exists) {
            return redirect()
                ->route('dokter.jadwal-periksa.index')
                ->with('danger', 'Jadwal sudah ada.');
        }
       // jika belum maka buat jadwal periksa
        JadwalPeriksa::create([
            'id_dokter'   => Auth::user()->id,
            'hari'        => $validateData['hari'],
            'jam_mulai'   => $validateData['jam_mulai'],
            'jam_selesai' => $validateData['jam_selesai'],
            'status'      => 0,
        ]);

        return redirect()
            ->route('dokter.jadwal-periksa.index')
            ->with('success', 'Jadwal berhasil ditambah.');
    }

    public function update(Request $request, $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        $statusRequest = $request->input('status'); // 'aktif' atau 'nonaktif'

        if ($statusRequest === 'aktif') {
            // Nonaktifkan semua jadwal dokter ini dulu
            JadwalPeriksa::where('id_dokter', Auth::user()->id)
                ->update(['status' => 0]);

            // Aktifkan jadwal yang dipilih
            $jadwalPeriksa->status = 1;

            $message = 'Jadwal berhasil diaktifkan. Jadwal lain dinonaktifkan otomatis.';
        } elseif ($statusRequest === 'nonaktif') {
            // Nonaktifkan jadwal yang dipilih
            $jadwalPeriksa->status = 0;
            $message = 'Jadwal berhasil dinonaktifkan.';
        } else {
            // Jika input status tidak sesuai, bisa beri pesan error atau abaikan
            return redirect()
                ->route('dokter.jadwal-periksa.index')
                ->with('danger', 'Status tidak valid.');
        }

        $jadwalPeriksa->save();

        return redirect()
            ->route('dokter.jadwal-periksa.index')
            ->with('success', $message);
    }

    public function destroy($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->delete();

        return redirect()
            ->route('dokter.jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil dihapus.');
    }
}
