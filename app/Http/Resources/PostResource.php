<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'body'      => $this->body,
            'likes'     => $this->likes,
            'liked'     => false,
            'created'   => $this->created_at,
            'comment'   => false,
            'comments'  => 0,
            'diff'      => $this->created_at->diffForHumans()
        ];
    }
}
