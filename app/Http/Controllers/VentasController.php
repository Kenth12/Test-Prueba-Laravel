<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        $order = $request->input('order', 'asc');
        $nombreCliente = $request->input('nombreCliente');
    
        $query = Ventas::select('venta.*', 'clients.Nombre as Nombre')
            ->join('clients', 'venta.Id_Cliente', '=', 'clients.Id')
            ->join('direccion', 'clients.Id', '=', 'direccion.Id_Cliente')
            ->orderBy('venta.fecha', $order);
    
        if ($nombreCliente) {
            $query->where('clients.Nombre', $nombreCliente);
        }
    
        $venta = $query->get();
    
        return view('viewVenta.index', compact('venta', 'order'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        $clients = Client::all();
        return view('viewVenta.form', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $request->validate([
            'cliente' => 'required', 
            'producto' => 'required|max:250',
            'estado' => 'required',
            'fecha' => 'required',
        ]);
        $Venta = new Ventas();
        $Venta->Id_Cliente = $request->input('cliente'); 
        $Venta->Producto = $request->input('producto'); 
        $Venta->Estado = $request->input('estado');
        $Venta->Fecha = $request->input('fecha');
        $Venta->save();
        
        return redirect()->route('venta.index');
    }

    /**
     * Display the specified resource.
     *
     *
     */

     public function filtrarPorCliente(Request $request)
    {
        $nombreCliente = $request->input('nombreCliente');
        $ventasFiltradas = Venta::where('Nombre', 'like', '%' . $nombreCliente . '%')->get();

        return view('ruta.a.vista', compact('ventasFiltradas'));
    }
    
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

