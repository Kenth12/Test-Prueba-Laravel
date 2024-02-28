<?php

namespace App\Http\Controllers;
use App\Models\Direction;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direccion = DB::table('direccion as d')
        ->join('clients as c', 'd.Id_Cliente', '=', 'c.Id')
        ->select('d.*', 'c.Nombre as Nombre')
        ->orderBy('d.Id_Cliente')
        ->get();
        return view('viewDirection.index', ['direccion' => $direccion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('viewDirection.form', compact('clients'));
        //return view('viewDirection.form');
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
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);
        
        $direccion = new Direction();
        $direccion->Id_Cliente = $request->input('cliente'); 
        $direccion->Direccion = $request->input('direccion');
        $direccion->Ciudad = $request->input('ciudad');
       
        $direccion->save();
       
        //Session::flash('mensaje','Direccion registrado exitosamente');
        return redirect()->route('direccion.index');
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show(Direction $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
    
     */
    public function edit(Direction $direccion)
        {
            $clients = Client::all();
            return view('viewDirection.form', compact('direccion', 'clients'));
        }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direction $direccion)
    {
        $request->validate([
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);
        $direccion = $request->input('direccion');
        $ciudad = $request->input('ciudad');

        DB::table('direccion')
            ->where('Id_Direccion', $direccion->Id_Direccion)
            ->update([
                'Direccion' => $direccion,
                'Ciudad' => $ciudad,
            ]);
        return redirect()->route('direccion.index')->with('mensaje', 'Dirección actualizada exitosamente');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direction $direccion)
    {
        $direccionId = $direccion->id;
    
    
        $ventasAsociadas = Sale::where('Id_Direccion', $direccionId)->exists();
    
        if ($ventasAsociadas) {
            return redirect()->route('direccion.index')->with('error', 'No se puede eliminar la dirección porque tiene ventas asociadas.');
        } else {
            
            $direccion->delete();
            return redirect()->route('direccion.index')->with('mensaje', 'Dirección eliminada con éxito');
        }
    }
    
}




