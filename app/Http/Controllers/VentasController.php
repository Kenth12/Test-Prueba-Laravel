<?php

namespace App\Http\Controllers;
// se importan todos los modelos y variables de ssesion asi como todo aquel metodo que se vaya a usar
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Direccion;
use App\Models\Ventas;
use Illuminate\Support\Facades\DB;
class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // se crea una funcion index que recibe un parametro
    public function index(Request $request)
    {
        // se asigna una variable order y se trae la informacion de la vista
        $order = $request->input('order', 'asc');
        $nombreCliente = $request->input('nombreCliente');
        // se hace una consulta al modelo y un doble join
        $query = Ventas::select('venta.*', 'clients.Nombre as Nombre')
            ->join('clients', 'venta.Id_Cliente', '=', 'clients.Id')
            ->join('direccion', 'clients.Id', '=', 'direccion.Id_Cliente')
            ->orderBy('venta.fecha', $order);
        // se valida la informacion
        if ($nombreCliente) {
            $query->where('clients.Nombre', $nombreCliente);
        }
    
        $venta = $query->get();
        // se retorna una vista y la informacion obtenida
        return view('viewVenta.index', compact('venta', 'order'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // se crea una funcion create 
    public function create()
    {       
        // se hace una consulta
        $clients = Client::all();
        // se retorna una vista
        return view('viewVenta.form', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     // se crea una funcion store que recibe un parametro
    public function store(Request $request)
    {    
        // se valida la informacion
        $request->validate([
            'cliente' => 'required', 
            'producto' => 'required|max:250',
            'estado' => 'required',
            'fecha' => 'required',
        ]);
        // se crea una nueva venta y se guarda con una funcion save
        $Venta = new Ventas();
        $Venta->Id_Cliente = $request->input('cliente'); 
        $Venta->Producto = $request->input('producto'); 
        $Venta->Estado = $request->input('estado');
        $Venta->Fecha = $request->input('fecha');
        $Venta->save();
        // se redirige a la funcion index para que cargue la vista 
        return redirect()->route('venta.index');
    }

    /**
     * Display the specified resource.
     *
     *
     */

    
    
    public function show($id, Request $request)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
    
     */
    public function edit( Request $request, $id)
        {
            $venta = Ventas::find($id);
            $clients = Client::all();
            return view('viewVenta.form', compact('venta', 'clients'));
        }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ventas  
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
{
    $request->validate([
        'producto' => 'required',
        'estado' => 'required',
    ]);

    $producto = $request->input('producto');
    $estado = $request->input('estado');

    DB::table('venta')
        ->where('Id_Venta', $id)
        ->update([
            'Producto' => $producto,
            'Estado' => $estado,
        ]);

    return redirect()->route('venta.index')->with('mensaje', 'Venta actualizada exitosamente');
}


    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ventas  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
       
    }
    
}

