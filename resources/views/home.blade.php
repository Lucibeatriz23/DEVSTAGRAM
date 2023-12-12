@extends('layout.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')

{{--Forma de incluir una componente en una vista --}}
    <x-listar-post :posts="$posts"/>
    
@endsection