<?php

namespace Database\Seeders;

use App\Models\Relations;
use Illuminate\Database\Seeder;

class RelationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['Нет','Есть','Все сложно'];
        foreach ($arr as $item){
            $relation=new Relations();
            $relation->name=$item;
            $relation->save();
        }
    }
}
