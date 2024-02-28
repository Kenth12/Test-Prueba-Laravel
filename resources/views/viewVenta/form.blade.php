@extends('themes.base')

@section('content')

<div class="container py-5 text-center">
    
    @if (isset($venta))
    <h1>Editar Venta</h1>
    @else
    <h1>Crear Venta</h1>
    @endif

    @if (isset($venta))
    <form action="{{ route('venta.update', $venta->Id_Venta) }}" method="post">
        @method('PUT')
    @else
    <form action="{{ route('venta.store') }}" method="post">
    @endif

        @csrf
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente:</label>
            <select class="custom-select" id="cliente" name="cliente" @if(isset($venta)) disabled @endif>
                @foreach ($clients as $client)
                    <option value="{{ $client->Id }}" @if(isset($venta) && $venta->Id_Cliente == $client->Id) selected @endif>{{ $client->Nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="producto" class="form-label">Producto:</label>
            <input type="text" class="form-control" id="producto" name="producto" value="{{ old('venta') ?? @$venta->Producto }}" placeholder="Escribe venta aquí">
            @error('venta')
                <p class="form-text text-danger">{{ $message }}</p> 
            @enderror
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado de la Venta:</label>
            <select class="custom-select" id="estado" name="estado">
                <option value="pendiente">Pendiente</option>
                <option value="EnProceso">En Proceso</option>
                <option value="completada">Completada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de la Venta:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ isset($venta) ? $venta->Fecha : '' }}" @if(isset($venta)) readonly @endif>
        </div>
        
        @if (isset($venta))
        <button type="submit" class="btn btn-info">Actualizar Venta</button>
        @else
        <button type="submit" class="btn btn-info">Guardar Venta</button>
        @endif
       
    </form>

    <form action="{{ route('ventas.filter') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="cliente">Seleccionar Cliente:</label>
            <select class="form-control" id="cliente" name="cliente">
                <option value="">Seleccionar Cliente</option>
                @foreach ($clients as $item)
                    <option value="{{ $item->Id }}">{{ $item->Nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
</div>
@endsection
