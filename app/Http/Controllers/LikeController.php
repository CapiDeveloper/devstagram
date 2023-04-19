<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post){

        // dd($post->checkLike($request->user()));
        $post->likes()->create([
            'user_id'=> $request->user()->id
        ]);

        return back();
    }
    public function destroy(Post $post, Request $request){
        $request->user()->likes()->where('post_id',$post->id)->delete();
        return back();
    }
}