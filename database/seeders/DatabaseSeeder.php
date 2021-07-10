<?php

namespace Database\Seeders;

use App\Models\Alcohole;
use App\Models\BodyType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
  /*      $this->call([
                            AlkoholeSeeder::class,
                    ]);
        $this->call([
                            SmokingSeeder::class,
                    ]);
        $this->call([
                            ChildrenSeeder::class,
                    ]);


        $this->call([
                            BodyTypeSeeder::class,
                    ]);
*/
        $this->call([
                            UserSeeder::class,
                    ]);
    }
}
