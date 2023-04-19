@extends('layouts.app')
@section('titulo')
Perfil: {{$user->name}}
@endsection
@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex items-center justify-center flex-row">
            <div class="w-44 lg:w-4/12 px-5">
                <img class="rounded-full" src="{{ $user->imagen? asset('uploads').'/'.$user->imagen : asset('img/usuario.svg') }}" alt="Usuario imagen">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col py-10">
                <div class="flex flex-col md:flex-row items-center gap-2">
                    <p class="text-claro text-2xl">{{$user->username}}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a class="bg-white hover:bg-gray-200 p-1 rounded-lg text-obscuro font-bold" href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                Editar perfil 
                            </a>
                        @endif    
                    @endauth
                </div>
                <div class="hidden sm:flex sm:gap-5 mt-5">
                    <p class="text-claro text-sm font-bold">
                        {{$user->followers->count()}} <span class="font-normal">@choice('seguidor|seguidores',$user->followers->count())</span>
                     </p>
                     <p class="text-claro text-sm font-bold">
                         {{$user->following->count()}} <span class="font-normal">
                             Siguiendo
                         </span>
                     </p>
                     <p class="text-claro text-sm font-bold">
                         {{$user->posts->count()}} <span class="font-normal">Posts</span>
                     </p>
                </div>
                @auth
                    @if (auth()->user()->id !== $user->id)
                        
                        @if(!$user->seguidores(auth()->user()))
                            <form action="{{ route('followers.store', $user) }}" method="POST">
                                @csrf
                                <input 
                                    type="submit"
                                    value="Seguir"
                                    class="mt-2 bg-blue-600 text-white uppercase rounded-lg px-3 py-1
                                    text-xs font-bold cursor-pointer"
                                >
                            </form>    
                        @else
                            <form action="{{ route('followers.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input 
                                    type="submit"
                                    value="Dejar de seguir"
                                    class="mt-2 bg-red-600 text-white uppercase rounded-lg px-3 py-1
                                    text-xs font-bold cursor-pointer"
                                >
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <section class="flex justify-around gap-2 sm:hidden border-y py-5 border-gray-800">
        <p class="text-claro text-sm font-bold flex flex-col items-center">
            {{$user->followers->count()}} <span class="font-normal">@choice('seguidor|seguidores',$user->followers->count())</span>
         </p>
         <p class="text-claro text-sm font-bold flex flex-col items-center">
             {{$user->following->count()}} <span class="font-normal">
                 Siguiendo
             </span>
         </p>
         <p class="text-claro text-sm font-bold flex flex-col items-center">
             {{$user->posts->count()}} <span class="font-normal">Posts</span>
         </p>
    </section>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
            {{--  --}}
            <div class="w-11/12 mx-auto">
                @if ($posts->count())
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-14">
                            @foreach ($posts as $post)
                                <div class="mb-10">
                                    <a class="relative" href="{{route('posts.show',['user'=> $post->user,'post'=>$post->id])}}">
                                        <img class="object-cover h-full" src="{{asset('/uploads').'/'.$post->imagen}}" alt="{{$post->titulo}}"> 
                                        <div class="absolute top-0 h-full font-bold text-3xl w-full text-white bg-black opacity-0 hover:opacity-80 transition-opacity delay-200 ease-in  flex items-center justify-around">
                                            <div class="flex items-center gap-2">
                                                {{$post->likes->count()}}
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                </svg> 
                                            </div>                                 
                                            <div class="flex items-center">
                                                {{$post->comentarios->count()}}
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                                </svg>
                                            </div>                                  
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            {{$posts->links('')}}
                        </div>
                @else
                    <p class="text-center">No hay posts</p>
                @endif 
            </div>
            {{--  --}}
    </section>
@endsection