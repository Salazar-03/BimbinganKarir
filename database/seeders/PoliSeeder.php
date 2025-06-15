<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('polis')->insert([
            [
                'nama'       => 'Gigi',
                'deskripsi'  => 'Pelayanan kesehatan gigi dan mulut.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama'       => 'Anak',
                'deskripsi'  => 'Kesehatan bayi, balita, dan anak.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama'       => 'Penyakit Dalam',
                'deskripsi'  => 'Diagnosa & terapi penyakit organ dalam.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}