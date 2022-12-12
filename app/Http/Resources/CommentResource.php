<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            //return comment with news
            'id' => $this->id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
            'news_id' => $this->news_id,
            'news' => $this->news,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
