@extends('layouts.app')
@section('titulo')
    Registrar
@endsection
@section('contenido')
    <div class="md:flex md:justify-center gap-10 items-center">
        <div class="flex-1 p-5">
            <img class="h-full object-cover" src={{ asset('./img/registrar.jpg') }} alt="Registrar Imagen">
        </div>
        <div class="flex-1 bg-gray-800 p-6 rounded-lg shadow-xl">
        <form action="{{ route('register') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-claro font-bold">
                    Nombre:
                </label>
                <input 
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Tu nombre"
                    value="{{old('name')}}"
                    class="border p-3 w-full rounded-lg text-gray-100 bg-gray-600
                    @error('name')
                        border-red-500
                    @enderror"
                />
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                @enderror
            </div>
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-claro font-bold">
                    Username:
                </label>
                <input 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu nombre de usuario"
                    value="{{old('username')}}"
                    class="border p-3 w-full rounded-lg text-gray-100 bg-gray-600
                    @error('username')
                        border-red-500
                    @enderror"
                />
                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-claro font-bold">
                    Email:
                </label>
                <input 
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Tu email"
                    value="{{old('email')}}"
                    class="border p-3 w-full rounded-lg text-gray-100 bg-gray-600
                    @error('username')
                        border-red-500
                    @enderror"
                />
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-claro font-bold">
                    Password:
                </label>
                <input 
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password de registro"
                    value="{{old('password')}}"
                    class="border p-3 w-full rounded-lg text-gray-100 bg-gray-600
                    @error('username')
                        border-red-500
                    @enderror"
                />
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-claro font-bold">
                    Repetir Password:
                </label>
                <input 
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repetir password"
                    class="border p-3 w-full rounded-lg text-gray-100 bg-gray-600"
                />
            </div>
            <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
        </div>
    </div>
@endsection