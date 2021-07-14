<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::factory()
                ->count(50)
                ->create()
                ->each(
                        function ($user) {

                        }
                );
    }

}
