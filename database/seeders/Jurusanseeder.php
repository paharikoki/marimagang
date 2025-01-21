<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Jurusanseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusanData = [
            [
                'nama_jurusan' => 'Teknik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jurusan' => 'Ekonomi & Bisnis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        DB::table('jurusan')->insert($jurusanData);
    }
}
