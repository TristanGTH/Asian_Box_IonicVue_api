<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function showAllPosts(Request $request)
    {
        $posts = DB::table('posts')->get();

        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function showPost(Request $request, $id)
    {



        $post = DB::table('posts')->where('id', $id)->first();


        if(is_null($post)){
            return response()->json([
                'errors' => "L'article n'existe pas."
            ], 404);
        }

        return response()->json([
            'id' => $post->id,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
            'title' => $post->title,
            'short_body' => $post->short_body,
            'body' => $post->body,
        ], 200);
    }

}
