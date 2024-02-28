@extends('themes.base')

@section('content')
    <div class="conainer py-5 text-center">
        
        @if (isset($client))
        <h1>Editar Cliente</h1>
        @else
        <h1>Crear Cliente</h1>
        @endif

        @if (isset($client))
        <form action="{{ route('client.update', $client->Id) }}" method="post">
            @method('PUT');
        @else
        <form action="{{route('client.store')}}" method="post">
        @endif
        
        
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label" >Nombre:</label>
                <input type="text" name="name" value="{{ old('name') ?? @$client->Nombre }}" class="form-control" placeholder="Escribe tu nombre aquí"  >
                @error('name')
                <p class="form-text text-danger" >{{ $message }}</p> 
                @enderror

                <label for="number" class="form-label" >Celular:</label>
                <input type="number" name="number" value="{{old('number') ?? @$client->Celular}}" class="form-control" placeholder="Escribe tu celular aquí">
                @error('number')
                <p class="form-text text-danger" >{{ $message }}</p> 
                @enderror

                <label for="email" class="form-label" >Correo:</label>
                <input type="text" name="email" value="{{old('email') ?? @$client->Correo}}" class="form-control" placeholder="Escribe tu correo aquí">
                @error('email')
                <p class="form-text text-danger" >{{ $message }}</p> 
                @enderror

                <label >Sexo:</label>
                <select class="custom-select" id="inputGroupSelect01" name="sexo">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
                  @if (isset($client))
                  <button type="submit" class="btn btn-info">Actualizar Cliente</button>
                @else
                <button type="submit" class="btn btn-info">Guardar Cliente</button>
                @endif
                
            </div>
        </form>
    </div>
@endsection