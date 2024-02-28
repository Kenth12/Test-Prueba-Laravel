@extends('themes.base')

@section('content')

<div class="container py-5 text-center">
    
    @if (isset($venta))
    <h1>Editar Venta</h1>
    @else
    <h1>Crear Venta</h1>
    @endif

    @if (isset($venta))
    //Esta ruta me redirige al metodo venta.update y se le adiciona una Id en su respectivo controlador
    <form action="{{ route('venta.update', $venta->Id_Venta) }}" method="post">
        @method('PUT')
    @else
    //Esta ruta me redirige al metodo venta.store en su respectivo controlador
    <form action="{{ route('venta.store') }}" method="post">
    @endif

        @csrf
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente:</label>
            // En caso de que sea necesario se bloquea este campo, validando antes si la variable $venta existe
            <select class="custom-select" id="cliente" name="cliente" @if(isset($venta)) disabled @endif>
                //Ciclo para traer la informacion de la tabla $Clients y cargarla en los campos del select
                @foreach ($clients as $client)
                    <option value="{{ $client->Id }}" @if(isset($venta) && $venta->Id_Cliente == $client->Id) selected @endif>{{ $client->Nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="producto" class="form-label">Producto:</label>
            <input type="text" class="form-control" id="producto" name="producto" value="{{ old('venta') ?? @$venta->Producto }}" placeholder="Escribe venta aquí">
            // En caso de algun error. se ejecuta
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
            // Aqui se valida que la variable $venta exista  y se carga la informacion de fecha y se bloquea si es necesario
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ isset($venta) ? $venta->Fecha : '' }}" @if(isset($venta)) readonly @endif>
        </div>
        
        // Aqui se valida que la variable $venta exista 
        @if (isset($venta))
        <button type="submit" class="btn btn-info">Actualizar Venta</button>
        @else
        <button type="submit" class="btn btn-info">Guardar Venta</button>
        @endif
       
    </form>

</div>
@endsection
