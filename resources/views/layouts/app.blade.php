<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./img/menu-abrir.svg" type="image/png">
        <title>DevStagram - @yield('titulo')</title>
        @stack('styles')
        @vite('./resources/css/app.css')
        @vite('./resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-obscuro text-claro flex flex-col md:flex-row md:h-screen md:overflow-hidden">
        <header class="p-5 border-r border-r-gray-800">
            <div class="container w-full mx-auto flex flex-col justify-between items-center h-full">
                <div class="flex justify-between w-full">
                    <a class="text-3xl font-black" href="{{ route('home') }}">DevStagram</a>
                    <img id="btn-menu" class="cursor-pointer md:hidden" width="40" height="40" src="./img/menu-abrir.svg" alt="Abrir menu">                     
                </div>
                <div class="w-full relative bg-red-500">
                    @auth
                    <nav id="menu" class="absolute top-12 -translate-y-80 transition-all duration-1000 w-full bg-obscuro z-10 h-40 flex flex-col gap-5 justify-between item-center flex-1">
                        <a href="{{ route('posts.create') }}" class="flex items-center justify-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                            Crear
                        </a>
                        <a class="p-2 hover:bg-gray-900 w-full text-center font-bold text-claro text-sm" href="{{route('posts.index',auth()->user()->username)}}">
                            Hola: <span class="font-normal">{{auth()->user()->name}}</span>
                        </a>
                        <form class="hover:bg-gray-900 w-full flex justify-start" action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 w-full font-bold uppercase text-claro text-sm">Cerra Sesion</button>
                        </form>
                    </nav>    
                    @endauth
                    @guest
                        <nav id="menu" class="absolute -translate-y-80 transition-all duration-1000 w-full h-40 z-10 flex flex-col justify-around gap-10 items-center bg-obscuro">
                            <a class="w-full hover:bg-gray-800 p-2 font-bold uppercase text-center text-claro text-sm" href="{{ asset('login') }}">Login</a>
                            <a class="w-full hover:bg-gray-800 p-2 font-bold uppercase text-center text-claro text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                        </nav>    
                    @endguest
                </div>
            </div>
        </header>
        <div class="md:overflow-y-scroll flex-1">
            <main class="container mx-auto mt-10">
                <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
                @yield('contenido')
            </main>
            <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-16 flex flex-col md:flex-row items-center justify-around">
                <ul class="flex items-center gap-5">
                    <li class="hover:text-claro">
                        <a class="text-sm flex items-center" href="https://www.youtube.com/@bryanchacha3729">
                            <img height="40" width="40" src="./img/youtube.svg" alt="Icono Youtube">
                            YouTube
                        </a>
                    </li>
                    <li class="hover:text-claro">
                        <a class="text-sm flex items-center" href="https://github.com/CapiDeveloper">
                            <img height="40" width="40" src="./img/github.svg" alt="Icono GitHub">
                            GitHub
                        </a>
                    </li>
                </ul> 
                <div>@DevStagram {{now()->year}}</div>
            </footer>
        </div>
        @livewireScripts
    </body>
</html>    