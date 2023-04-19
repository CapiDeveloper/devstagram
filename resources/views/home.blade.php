@extends('layouts.app')
@section('titulo')
    Página de inicio
@endsection
@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection