<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'post_id'   => $this->post_id,
            'parent_id' => $this->parent_id,
            'comment'   => $this->comment,
            'likes'     => 0,
            'created'   => $this->created_at,
            'diff'      => $this->created_at->diffForHumans()
        ];
    }
}
