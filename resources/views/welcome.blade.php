@extends('themes.base')

@section('content')
    <div class="conainer py-5 text-center">
        <h1 >
            Bienvenido
        </h1>
        <a href="{{route('client.index')}}" class="btn btn-primary">Ir a Clientes</a>
        <a href="{{route('direccion.index')}}" class="btn btn-primary">Ir a Direcciones</a>
        
    </div>
@endsection