<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {

        $idsSiguiendo = auth()->user()->following->pluck('id')->toArray();
        $postsSiguiendo = Post::whereIn('user_id',$idsSiguiendo)->latest()->paginate(20);
        // dd($postsSiguiendo);
        return view('home',[
            'posts'=>$postsSiguiendo
        ]);
    }
}
