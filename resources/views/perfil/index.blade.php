@extends('layouts.app')
@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection
@section('contenido')
    <div class="md:flex justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username:
                    </label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu nombre de usuario"
                        value="{{auth()->user()->username}}"
                        class="border p-3 w-full rounded-lg
                        @error('name')
                            border-red-500
                        @enderror"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>   
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email:
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        value={{auth()->user()->email}}
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg,.jpeg,.png"
                    />
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen perfil:
                    </label>
                    <input 
                        id="imagen"
                        name="imagen"
                        type="file"
                        value=""
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg,.jpeg,.png"
                    />
                </div>
                <div class="mb-5">
                    <label for="password_actual" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password actual
                    </label>
                    <input 
                        id="password_actual"
                        name="password_actual"
                        type="password"
                        value=""
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg,.jpeg,.png"
                    />
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nuevo password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        value=""
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg,.jpeg,.png"
                    />
                </div>
                @if (session('message'))
                    <p>{{session('message')}}</p>
                @endif
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection