<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Share;
use App\Models\ToDoItem;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\List_;

class ShareController extends Controller
{
    //

    public function getUsersToShare(Request $request){
        $list_id=$request->get('list_item_id',null);
        if(!$list_id){
            return response()->json('list not found')->setStatusCode(404);
        }

        $user=Auth::user();

        $share=Share::where('who_user_id',$user->id)->with('targetUser','list','whoUser')->get();

        $users_to_share=User::where('id','<>',$user->id)->get();

        return response()->json(compact('share','users_to_share'));
    }

    public function shareList(Request $request){
            $toDoItem=ToDoList::where('id','=',$request->list_id)->first();


            $targetUsers=$request->share;
            foreach ($targetUsers as $item) {
                $share = new Share();

                $user=Auth::user();
                $share->whoUser()->associate($user);

                $targetUser=User::where('id',$item)->first();
                $share->targetUser()->associate($targetUser);
                $share->list()->associate($toDoItem);
                $share->save();
              /*


                if(!$targetUser) continue;
                $share->targetUser()->save($targetUser);
*/

            }

    }
}
