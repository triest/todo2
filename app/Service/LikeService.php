<?php


namespace App\Service;


use Illuminate\Support\Facades\Auth;

class LikeService
{

    public function getMyLikes(){
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        $likes = $user->like()->get();


        $who_array=[];
        foreach ($likes as $like){
            $who=$like->who()->first();
            $who_array[]=$who;
        }

        return $who_array;
    }
}
