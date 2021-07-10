<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DialogContactsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'other_name' => $this->other->name,
                'uuid' => $this->other->unique_id,
                'online' => $this->other->isOnline(),
                'last_message'=>$this->lastMessage,
                 'photo'=>$this->other->photo_url
        ];
    }
}
