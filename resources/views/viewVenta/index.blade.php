@extends('themes.base')

@section('content')
<div class="container py-5 text-center">
    <h1>Listado de Ventas</h1>
    @if (Session::has('mensaje'))
        <div class="alert alert-primary my-4">
            {{ Session::get('mensaje') }}
        </div>
    @endif

    <form action="{{ route('venta.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" placeholder="Nombre del Cliente">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Id Venta</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Venta</th>
                <th>
                    <a href="{{ route('venta.index', ['order' => $order === 'asc' ? 'desc' : 'asc']) }}" style="text-decoration: none; color: inherit;" title="Haz clic para ordenar por fecha">Fecha</a>
                </th>
                <th>Estado de la venta</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($venta as $item)
                <tr>
                    <td>{{ $item->Id_Venta }}</td>
                    <td>{{ $item->Nombre }}</td>
                    <td>{{ $item->Direccion }}</td>
                    <td>{{ $item->Producto }}</td>
                    <td>{{ $item->Fecha }}</td>
                    <td>{{ $item->Estado }}</td>
                    <td>
                        <a href="{{ route('venta.edit', $item->Id_Venta) }}" class="btn btn-warning">Modificar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay ventas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('venta.create') }}" class="btn btn-primary">Crear Venta</a>
    <a href="{{ route('welcome') }}" class="btn btn-secondary">Regresar al Home</a>
</div>
@endsection