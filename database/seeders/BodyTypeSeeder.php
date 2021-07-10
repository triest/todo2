<?php

namespace Database\Seeders;


use App\Models\BodyType;
use Illuminate\Database\Seeder;

class BodyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['Нормальное','Худощавое','Полное','Спортивное'];
        foreach ($arr as $item){
            $relation=new BodyType();
            $relation->name=$item;
            $relation->save();
        }
    }
}
