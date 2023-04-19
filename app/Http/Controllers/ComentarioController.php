<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(User $user, Post $post,Request $request){
        
        // Validar
        $this->validate($request,[
            'comentario'=>'required|max:255'
        ]);
        // Almacenar el comentario
        Comentario::create([
            'user_id'=>$user->id,
            'post_id'=>$post->id,
            'comentario'=>$request->comentario
        ]);
        // Imprimir el mensaje
        return back()->with('mensaje','Comenatario realizado correctamente');
    }
}
