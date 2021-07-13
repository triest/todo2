<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ToDoItemResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id' => $this->id,
                'name' => $this->name,
                'tags' => $this->tag,
                'image' => $this->image_small,
                'description'=>$this->description
        ];
    }
}
