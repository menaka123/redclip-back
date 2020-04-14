<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostWithCommentResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return PostResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return new PostResource($post);
    }


    /**
     * Add like to a post
     *
     * @param $id
     * @return PostResource
     */
    public function upVote($id) {
        $post = Post::findOrfail($id);
        $post->likes = ++$post->likes;
        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return PostResource
     */
    public function show($id)
    {
        $post = Post::findOrfail($id)->comments()->get();
        return $this->buildTree($post);
    }

    function buildTree($elements, $parentId = NULL) {
        $branch = [];
        foreach ($elements as $element) {
            if ($element->parent_id  === $parentId) {
                $children = $this->buildTree($elements, $element->id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = new PostWithCommentResource($element);
            }
        }
        return $branch;
    }
}
