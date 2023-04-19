@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="w-11/12 mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('./uploads'.'/'.$post->imagen) }}" alt="Imagen Post {{$post->titulo}}">
            <div class="p-3 flex items-center gap-4">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>
            <div>
                <p class="font-bold">{{$post->user->username}}</p>
                <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                <p class="mt-5">{{$post->descripcion}}</p>
            </div>
            @auth
                @if($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="bg-red-500 hover:bg-red-600 rounded p-2 text-white font-bold mt-4 cursor-pointer" type="submit" value="Eliminar Publicacion">
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-gray-800 rounded-lg p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['user'=>auth()->user(),'post'=>$post->id]) }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Añade un comentario:
                            </label>
                            <textarea
                                id="comentario"
                                name="comentario"
                                placeholder="Descipción de la publicación"
                                class=" text-gray-800 border p-3 w-full rounded-lg @error('comentario')border-red-500 @enderror"
                            ></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                            @enderror
                        </div>
                        <input type="submit" value="Comentario" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth
                <div class="">
                    @if (count($post->comentarios)>0)
                        @foreach ($post->comentarios as $comentario)
                            <div class=" flex flex-col p-5 border-gray-300 border-b">
                                <div class="flex gap-2">
                                    <img class="rounded-full object-cover" height="30" width="30" src="{{ $comentario->user->imagen? asset('uploads').'/'.$comentario->user->imagen : asset('img/usuario.svg') }}" alt="">
                                    <a class="font-bold" href="{{ route('posts.index', ['user'=>$comentario->user]) }}">{{$comentario->user->name}}</a>
                                </div>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection