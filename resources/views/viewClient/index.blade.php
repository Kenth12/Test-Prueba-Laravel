@extends('themes.base')

@section('content')
    <div class="container py-5 text-center">    
        <h1 >
            Listado de Clientes
        </h1>
        @if (Session::has('mensaje'))
        <div class="alert alert-primary my-4">
            {{Session::get('mensaje')}}
        </div>    
        @endif
        <table class="table table-striped table-hover">
            <thead>
                <th>Id Cliente</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Sexo</th>
                <th>Editar</th>
                <tbody>
                    @forelse ($clients as $item)
                    <tr>
                    <td>{{$item->Id}}</td>
                    <td>{{$item->Nombre}}</td>
                    <td>{{$item->Celular}}</td>
                    <td>{{$item->Correo}}</td>
                    <td>{{$item->Sexo}}</td>
                    <td>  <a href="{{ route('client.edit', $item->Id) }}" class="btn btn-warning">Actualizar</a>
                        <form action="{{route('client.destroy', $item->Id)}}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                         </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="3">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </thead>
        </table>
        <a href="{{route('client.create')}}" class="btn btn-primary">Crear Clientes</a>
        <a href="{{route('welcome')}}" class="btn btn-secondary">Regresar al Home</a>
    </div>
@endsection