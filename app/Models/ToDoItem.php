<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoItem extends Model
{
    use HasFactory;

    protected $fillable=['name','list_id','description'];

    public function user()
    {
        return $this->belongsTo(ToDoList::class);
    }

    public function tag(){
        //
        return $this->belongsToMany(Tag::class,'tag_to_do_item');
    }

    public function tagFilter($id){
        return $this->belongsToMany(Tag::class,'tag_to_do_item')->where('tag_to_do_item.tag_id','=',$id);
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                ->with([$relation => $constraint]);
    }
}
