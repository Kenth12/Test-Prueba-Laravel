@extends('themes.base')

@section('content')
    <div class="conainer py-5 text-center">
        <h1 >
            Listado de Direcciones
        </h1>
        @if (Session::has('mensaje'))
        <div class="alert alert-primary my-4">
            {{Session::get('mensaje')}}
        </div>    
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($direccion as $item)
                <tr>
                    <td>{{ $item->Nombre }}</td>
                    <td>{{ $item->Direccion }}</td>
                    <td>{{ $item->Ciudad }}</td>
                    <td>
                        <a href="{{ route('direccion.edit', $item->Id_Direccion) }}" class="btn btn-warning">Actualizar</a>
                        <form action="{{route('direccion.destroy', $item->Id_Direccion)}}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No hay registros</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('direccion.create') }}" class="btn btn-primary">Crear Dirección</a>
    </div>
    @endsection