<?php

namespace Database\Seeders;


use App\Models\Target;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['Общения','Ничего серьёзного','Романтики','Отношений'];
        foreach ($arr as $item){
            $relation=new Target();
            $relation->name=$item;
            $relation->save();
        }
    }
}
