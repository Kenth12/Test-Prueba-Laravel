@extends('themes.base')

@section('content')
    
        <div class="container py-5 text-center">
            <h1>Listado de Direcciones</h1>
            // Se valida una session y se envia el respectivo mensaje
            @if (Session::has('mensaje'))
                <div class="alert alert-primary my-4">
                    {{ Session::get('mensaje') }}
                </div>
            @endif
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Ciudad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    //Ciclo para traer la informacion de la tabla $direccion y cargarla en los campos de la tabla
                    @forelse ($direccion as $item)
                        <tr>
                            <td>{{ $item->Nombre }}</td>
                            <td>{{ $item->Direccion }}</td>
                            <td>{{ $item->Ciudad }}</td>
                            <td>
                                // Aqui se direcciona al metodo edit en el controlador y se le envia una Id
                                <a href="{{ route('direccion.edit', $item->Id_Direccion) }}" class="btn btn-warning">Actualizar</a>
                                // Form para eliminar informacion y ruta que conlleva al metodo destroy en el controlador adicionandole una Id
                                <form action="{{ route('direccion.destroy', $item->Id_Direccion) }}" method="post" class="d-inline">
                                    @method('DELETE') //Se envia un delete
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
            // Aqui se va a la ruta direccion.create para entrar al metodo create
            <a href="{{ route('direccion.create') }}" class="btn btn-primary">Crear Dirección</a>
            // Aqui se va a la ruta velcome para ir al home del proyecto
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Regresar al Home</a>
        </div>
    @endsection