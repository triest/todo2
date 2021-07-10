<?php

namespace Database\Seeders;

use App\Models\Alcohole;
use Illuminate\Database\Seeder;

class AlkoholeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['Не пью','В компании','Много пью'];
        foreach ($arr as $item){
            $relation=new Alcohole();
            $relation->name=$item;
            $relation->save();
        }
    }
}
