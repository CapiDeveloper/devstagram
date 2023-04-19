@extends('layouts.app')
@section('titulo')
    Inicia Sesión en DevStagram 
@endsection
@section('contenido')
    <div class="md:flex md:justify-center gap-10 items-center">
        <div class="flex-1 p-5">
            <img class="h-full object-cover" src={{ asset('./img/login.jpg') }} alt="Login Imagen">
        </div>
        <div class="flex-1 bg-gray-800 p-6 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{session('mensaje')}}
                </p>   
            @endif
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email:
                </label>
                <input 
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Tu email"
                    value="{{session('email')}}"
                    class="border p-3 w-full rounded-lg
                    text-gray-100 bg-gray-500
                    @error('email')
                        border-red-500
                    @enderror"
                />
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Password:
                </label>
                <input 
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password de registro"
                    value="{{old('password')}}"
                    class="border p-3 w-full rounded-lg
                    text-gray-100 bg-gray-500
                    @error('password')
                        border-red-500
                    @enderror"
                />
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                @enderror
            </div>
            <div class="mb-5">
                <input id="remember" type="checkbox" name="remember">
                <label for="remember" class="text-gray-500 text-sm">Mantener mi sesión abierta</label>
            </div>
            <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
        </div>
    </div>
@endsection