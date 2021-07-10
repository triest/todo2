<?php

namespace Database\Seeders;

use App\Models\Children;
use Illuminate\Database\Seeder;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['Есть','Нет','Нет, и не хочу','Есть, но хочу еще'];
        foreach ($arr as $item){
            $relation=new Children();
            $relation->name=$item;
            $relation->save();
        }
    }
}
