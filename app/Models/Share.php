<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    public function whoUser(){
        return $this->belongsTo(User::class,'who_user_id','id');
    }

    public function targetUser(){
        return $this->belongsTo(User::class,'target_user_id','id');
    }

    public function list(){
        return $this->belongsTo(ToDoList::class,'to_do_list_id','id');
    }
}
