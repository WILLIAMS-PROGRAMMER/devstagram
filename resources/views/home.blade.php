@extends('layouts.app') <!-- APUNTAN DIRECTAMENTE HACIA LA CARPETA VIEWS -->

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
<!-- componentes -->
    <x-listar-post :posts="$posts" />
@endsection