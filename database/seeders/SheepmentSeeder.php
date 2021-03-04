<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SheepmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(50)
            ->hasShipments(20)
            ->create();
    }
}
