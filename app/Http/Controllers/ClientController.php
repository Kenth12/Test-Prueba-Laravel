<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('viewClient.index')->with('clients',$clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('viewClient.form');
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
            'name'=> 'required|max:15',
            'number'=> 'required|max:11',
            'email'=> 'required|max:50'
        ]);

        $cliente = new Client();
        $cliente->Nombre = $request->input('name');
        $cliente->Celular = $request->input('number');
        $cliente->Correo = $request->input('email');
        $cliente->Sexo = $request->input('sexo');
        $cliente->save();
      
        Session::flash('mensaje','Cliente registrado exitosamente');
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('viewClient.form',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
{
    //$cliente = Client::find($client->Id);

    $request->validate([
        'name' => 'required|max:15',
        'number' => 'required|max:11',
        'email'=> 'required|email|max:250',
    ]);

    $Tabla = DB::table('clients')
    ->where('id', $client->Id)
    ->update([
        'Nombre' => $request->name,
        'Celular' => $request->number,
        'Correo' => $request->email,
        'Sexo' => $request->sexo,
    ]);

    if ($Tabla) {
        Session::flash('mensaje', 'Cliente actualizado exitosamente');
    } else {
        Session::flash('error', 'No se pudo actualizar el cliente');
    }

    return redirect()->route('client.index'); 

        return redirect()->route('client.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */

    public function destroy(Client $client)
    {
        
        $clientId = $client->Id;

        $direccionesAsociadas = DB::table('direccion')->where('Id_Cliente', $clientId)->exists();

        if ($direccionesAsociadas == true) {
            return redirect()->route('client.index')->with('error', 'No se puede eliminar el cliente porque tiene direcciones asociadas.');
        }else{
            $deleted = DB::delete('DELETE FROM clients WHERE Id = ?', [$clientId]);
        }
       
        if ($deleted) {
            return redirect()->route('client.index')->with('mensaje', 'Cliente eliminado con éxito');
        } else {
            return redirect()->route('client.index')->with('error', 'No se pudo eliminar el cliente');
        }
    }
    

}
