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
                            $count = Target::select(['*'])->count();
                            $targets = Target::select(['*'])->inRandomOrder()->limit(rand(1, $count))->get();
                            foreach ($targets as $target) {
                                $user->target()->save($target);
                            }

                            $count = Interest::select(['*'])->count();
                            $targets = Interest::select(['*'])->inRandomOrder()->limit(rand(1, $count))->get();
                            foreach ($targets as $target) {
                                $user->interest()->save($target);
                            }


                        }
                );
    }

}
