<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function item(){
        return $this->hasMany(ToDoItem::class,'list_id','id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                ->with([$relation => $constraint]);

    }
}
