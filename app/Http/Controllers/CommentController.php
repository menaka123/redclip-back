<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Add like to a comment
     *
     * @param $id
     * @return CommentResource
     */
    public function upVote($id)
    {
        $comment = Comment::findOrfail($id);
        $comment->likes = ++$comment->likes;
        $comment->save();

        return new CommentResource($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return CommentResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'parent_id' => 'integer',
            'post_id' => 'required|integer',
        ]);

        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->parent_id = $request->input('parent_id');
        $comment->post_id = $request->input('post_id');
        $comment->save();

        return new CommentResource($comment);
    }
}