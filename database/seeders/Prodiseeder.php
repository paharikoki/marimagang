<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Prodiseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodiData = [
            [
                'nama_prodi' => 'Mesin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_prodi' => 'Management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_prodi' => 'Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_prodi' => 'Akutansi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        DB::table('prodi')->insert($prodiData);
    }
}
