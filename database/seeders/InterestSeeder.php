<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['Танцы','Походы','Велисипед','Рукоделие'];
        foreach ($arr as $item){
            $relation=new Interest();
            $relation->name=$item;
            $relation->save();
        }
    }
}
