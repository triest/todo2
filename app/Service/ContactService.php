<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 23.08.2020
     * Time: 17:20
     */

    namespace App\Service;



    use App\Models\Message;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    class ContactService
    {

        public function getContacts(User $user = null)
        {
            if ($user == null) {
                $user = Auth::user();
            }



            if ($user == null) {
                return null;
            }


            $diologs=$user->dialog()->with('other')->get();

            return $diologs;
        }

        public function getMessagesFor(User $user = null)
        {
            if ($user == null) {
                $user = Auth::user();
            }

            if ($user == null) {
                return null;
            }

            Message::where('to', $user->id)
                    ->update(['readed' => true]);
            $messages = Message::where('from', $user->id)->orWhere('to', $user->id)->get();
            return $messages;
        }
        public function getUnreaded(User $user=null){
            if ($user == null) {
                $user = Auth::user();
            }

            if ($user == null) {
                return false;
            }

            return Message::where('to', $user->id)->where(['readed'=>false])->orWhere('to', $user->id);
        }
    }
