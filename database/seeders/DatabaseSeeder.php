<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\OutletsSeeders;
use Database\Seeders\UserSeeders;
use App\Models\Outlet;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(OutletsSeeders::class);
        $this->call(UserSeeders::class);
    }
}
