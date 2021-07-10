<?php


namespace App\Service;


use App\Models\Like;
use App\Models\Lk\User;
use Illuminate\Support\Facades\Auth;

class PanelService
{
    public function getAllData(){
        $data=[];

        $user=Auth::user();
        if(!$user){
            return response([],401);
        }

        $data['like']=$user->like()->where('readed','=',0)->count();

        $data['gift']=$user->GiftForMe()->where('readed','=',0)->count();

        $data['messages']=$user->messagesForMe()->where('readed','=',0)->count();

        $data['eventRequest']=$user->getEventRequests(true)->count();

        $data['visits']=$user->targetVisit()->where('read',0)->count();

        return $data;
    }

}
