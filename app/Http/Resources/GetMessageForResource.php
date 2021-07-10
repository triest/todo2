<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMessageForResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
// $user = User::select(['id'])->where(['unique_id'=>$request->contact_id])->first();
        //  dump($request->from);


        $from = User::select(['unique_id'])->where(['id' => $this->from])->first();
        if (!$from) {
            return null;
        }

        $to = User::select(['unique_id'])->where(['id' => $this->to])->first();
        if (!$to) {
            return null;
        }


        return [
                'id' => $this->id,
                'from' => $from->unique_id,
                'to' => $to->unique_id,
                'text' => $this->text,
                'readed' => $this->readed
        ];
    }
}
