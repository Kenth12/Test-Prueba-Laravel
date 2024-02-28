@extends('themes.base')

    @section('content')
    
    <div class="container py-5 text-center">
        
        @if (isset($direccion))
        <h1>Editar Dirección</h1>
        @else
        <h1>Crear Dirección</h1>
        @endif
        //Se valida la existencia de la variable $direccion
        @if (isset($direccion))
        //Se redirecciona al metodo update en el controlador y con el se envia una Id
        <form action="{{ route('direccion.update', $direccion->Id_Direccion) }}" method="post">
            @method('PUT')
        @else
        //Se direcciona al metodo store, en el controlador 
        <form action="{{ route('direccion.store') }}" method="post">
        @endif

        @csrf

        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente:</label>
            <select class="custom-select" id="cliente" name="cliente" @if(isset($direccion)) disabled @endif>
                // Aqui se hace un cliclo, para traer la informacion de la tabla clients y cargarla en el select
                @foreach ($clients as $client)
                    <option value="{{ $client->Id }}" @if(isset($direccion) && $direccion->Id_Cliente == $client->Id) selected @endif>{{ $client->Nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="direccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') ?? @$direccion->Direccion }}" placeholder="Escribe la dirección aquí">
            @error('direccion')
                <p class="form-text text-danger">{{ $message }}</p> 
            @enderror
        </div>

        <div class="form-group">
            <label for="ciudad" class="form-label">Ciudad:</label>                             
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad') ?? @$direccion->Ciudad }}" placeholder="Escribe la ciudad aquí">
            @error('ciudad')
                <p class="form-text text-danger">{{ $message }}</p> 
            @enderror
        </div>
        // Aqui se valida que la variable $venta exista 
        @if (isset($direccion))
            <button type="submit" class="btn btn-info">Actualizar Dirección</button>
        @else
            <button type="submit" class="btn btn-info">Guardar Dirección</button>
        @endif
        
        </form>
    </div>
@endsection
