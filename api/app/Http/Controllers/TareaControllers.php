<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class TareaControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Listar todas las tareas registradas en la base de datos
        $tareas = DB::table('tareas')->selectRaw('tareas.id, tareas.nombre, tareas.descripcion as tarea, estados.descripcion as estado, tareas.responsable, tareas.estado_id')
        ->join('estados', 'tareas.estado_id', '=', 'estados.id')
        ->where('tareas.estado_id', '!=', 4)
        ->orderBy('tareas.id','desc')
        ->get();

        return $tareas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'responsable' => 'required',
        ]);

        if($validacion->fails()){
            return 'Debe llenar todos los campos';
        }else{
         
            //TODO: Funcion para grabar una nueva tarea.
            $grabarTarea = Tareas::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'responsable' => $request->responsable,

            ]);

            return 'La tarea '.$grabarTarea->nombre.' ha sido grabada';
        }

        

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: Funcion para realizar la modificacion del registro de la tarea.
        $tarea = Tareas::find($id);
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->save();

        return 'La tarea ha sido actualizada';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Funcion para eliminar el registro de la base de datos, de manera logica.
        $tarea = Tareas::find($id);
        $tarea->estado_id = 4;
        $tarea->save();
        
        return 'La tarea ha sido eliminada';
    }

    public function updateEstado($id, $estado){
        //TODO: Funcion para actualizar el estado de la tarea.
        $tarea = Tareas::find($id);
        $tarea->estado_id = $estado;
        $tarea->save();

        return 'El estado de la tarea ha sido actualizado';
    }

    public function cantidadPendiente() {
        //TODO: Funcion para obtener la cantidad de tareas pendientes.
        $pendientes = DB::table('tareas')->selectRaw('count(*) as cantidad')
        ->where('estado_id', 1)->get();

        return $pendientes[0];
    }

    public function cantidadProceso() {
        //TODO: Funcion para obtener la cantidad de tareas en proceso.
        $terminados = DB::table('tareas')->selectRaw('count(*) as cantidad')
        ->where('estado_id', 2)->get();

        return $terminados[0];
    }


    public function cantidadTerminado() {
        //TODO: Funcion para obtener la cantidad de tareas terminadas.
        $terminados = DB::table('tareas')->selectRaw('count(*) as cantidad')
        ->where('estado_id', 3)->get();

        return $terminados[0];
    }
}
