<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr=['работа','it','дом','кот','дача'];
        foreach ($arr as $item){
            $tag=new Tag();
            $tag->name=$item;
            $tag->save();
        }
    }
}
