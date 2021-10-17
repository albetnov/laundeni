<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeders extends Seeder
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
                'id_outlet' => '1',
                'name' => 'Sang Admin',
                'username' => 'admin',
                'role' => 'admin',
                'password' => bcrypt('admin123'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_outlet' => '1',
                'name' => 'Deni',
                'username' => 'deni',
                'role' => 'owner',
                'password' => bcrypt('deni12345'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_outlet' => '2',
                'name' => 'Asep Surasep',
                'username' => 'asep',
                'role' => 'kasir',
                'password' => bcrypt('asep12345'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('users')->insert($data);
    }
}
