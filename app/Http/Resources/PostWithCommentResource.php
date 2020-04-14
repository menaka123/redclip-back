<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostWithCommentResource extends JsonResource
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
            'likes'     => $this->likes,
            'liked'     => false,
            'children'  => $this->children ?? $this->children,
            'created'   => $this->created_at,
            'diff'      => $this->created_at->diffForHumans()
        ];
    }
}
