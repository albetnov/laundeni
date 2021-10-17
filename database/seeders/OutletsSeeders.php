<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'super',
                'alamat' => 'super',
                'tlp' => '0'
            ],
            [
                'nama' => 'Launur',
                'alamat' => 'Bengkong Laut Blok F No. 27',
                'tlp' => '0899647217'
            ],
            [
                'nama' => 'Kelin',
                'alamat' => 'Sungai Panas Blok U No. 4',
                'tlp' => '0825372531'
            ]
        ];
        DB::table('outlets')->insert($data);
    }
}
