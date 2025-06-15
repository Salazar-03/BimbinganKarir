<?php

namespace App\Http\Controllers;

use App\Models\JanjiPeriksa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatPeriksaController extends Controller
{
     public function index()
{
    $janjiPeriksas = JanjiPeriksa::with('jadwalPeriksa.dokter.poli')
        ->where('id_pasien', auth()->user()->id)
        ->get();

    return view('pasien.riwayat-periksa.index')->with([
        'janjiPeriksas' => $janjiPeriksas,
    ]);
}


    public function detail($id)
    {
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa', 'periksa'])
            ->findOrFail($id);

        return view('pasien.riwayat-periksa.detail')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }

    public function riwayat($id)
    {
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa', 'periksa'])
            ->findOrFail($id);

        return view('pasien.riwayat-periksa.riwayat')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }

}
