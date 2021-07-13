<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoItem extends Model
{
    use HasFactory;

    protected $fillable=['name','list_id'];

    public function user()
    {
        return $this->belongsTo(ToDoList::class);
    }

    public function tag(){
        //
        return $this->belongsToMany(Tag::class,'tag_to_do_item');
    }
}
