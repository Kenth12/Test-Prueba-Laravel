<?php
// se importan todos los modelos y variables de ssesion asi como todo aquel metodo que se vaya a usar
namespace App\Http\Controllers;
use App\Models\Direction;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Ventas;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // se crea una funcion index
    public function index()
    {
        //se le asigna a una variable una consulta sql que contiene un join
        $direccion = DB::table('direccion as d')
        ->join('clients as c', 'd.Id_Cliente', '=', 'c.Id')
        ->select('d.*', 'c.Nombre as Nombre')
        ->orderBy('d.Id_Cliente')
        ->get();
        // se retorna una vista y la informacion tomada de esa consulta
        return view('viewDirection.index', ['direccion' => $direccion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // se crea una funcion create
    public function create()
    {
        // se le asigna las propiedades del modelo a la variable clients
        $clients = Client::all();
        // se retorna una vista y la informacion
        return view('viewDirection.form', compact('clients'));
        //return view('viewDirection.form');
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
        // se validan estos parametros
        $request->validate([
            'cliente' => 'required', 
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);
        // se crea una nueva direccion y es guarda con un save
        $direccion = new Direction();
        $direccion->Id_Cliente = $request->input('cliente'); 
        $direccion->Direccion = $request->input('direccion');
        $direccion->Ciudad = $request->input('ciudad');
       
        $direccion->save();
       
        //se redirecciona a la funcion index 
        return redirect()->route('direccion.index')->with('mensaje', 'Direccion creada con éxito');;
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
    // se crea un metodo edit
    public function edit(Direction $direccion)
        {
            // se realiza una consulta al modelo client
            $clients = Client::all();
            // se retorna una vista con informacion
            return view('viewDirection.form', compact('direccion', 'clients'));
        }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction  
     * @return \Illuminate\Http\Response
     */
    // se crea un metodo update que recibe parametros
    public function update(Request $request, Direction $direccion)
    {
        // se validan estos parametros
        $request->validate([
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);
        $direccion = $request->input('direccion');
        $ciudad = $request->input('ciudad');
        // se hace una consulta a la tabla y se guarda la informacion por medio de un update
        DB::table('direccion')
            ->where('Id_Direccion', $direccion->Id_Direccion)
            ->update([
                'Direccion' => $direccion,
                'Ciudad' => $ciudad,
            ]);
            // se redirecciona a una funcion index con un mensaje
        return redirect()->route('direccion.index')->with('mensaje', 'Dirección actualizada exitosamente');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    // se crea una funcion destroy que recibe unos parametro
    public function destroy(Request $request, $id)
    {
        // se hace una consulta sql  y se valda si la id existe
        $ventasAsociadas = Ventas::where('Id_Direccion', $id)->exists();
    
        if ($ventasAsociadas) {
            // si a id existe se retorna a una funcion index
            return redirect()->route('direccion.index')->with('error', 'No se puede eliminar la dirección porque tiene ventas asociadas.');
        } else {
            // si la id no existe en esa tabla se busca nuevamente y se elimina
            $direccion = Direction::findOrFail($id);
            $direccion->delete();
            return redirect()->route('direccion.index')->with('mensaje', 'Dirección eliminada con éxito');
        }
        // cabe aclarar que la funcion anterior no funciona. da error al ejecutarla.
    }
    
}




