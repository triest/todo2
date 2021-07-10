<?php

namespace Database\Seeders;

use App\Models\Smoking;
use Illuminate\Database\Seeder;

class SmokingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['Не курю','Иногда','Много курю'];
        foreach ($arr as $item){
            $relation=new Smoking();
            $relation->name=$item;
            $relation->save();
        }
    }
}
