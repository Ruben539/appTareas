<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use Illuminate\Http\Request;
use Validator;

class EstadoControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Lista de estados disponible en el sistema.
        $estados = Estados::all();
        return response()->json($estados);
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
        //TODO: Funcion para crear un estado nuevo.
        $validacion = Validator::make($request->all(), [
            'descripcion' => 'required',
        ]);

        if ($validacion->fails()) {
            return 'Debe llenar todos los campos';
        } else {
            //TODO: Funcion para grabar una nueva tarea.
            $crearEstado = Estados::create([ 
                'descripcion' => $request->descripcion,
            ]);

            return 'El estado ' . $crearEstado->descripcion . ' ha sido creado';
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
        //TODO: Funcion para modificar el registro de la tabal de estados.
        $validacion = Validator::make($request->all(), [
            'descripcion' => 'required',
        ]);
        if ($validacion->fails()) {
            return 'Debe llenar todos los campos';
        }else{

            $actualizarEstado = Estados::find($id);
            $actualizarEstado->descripcion = $request->descripcion;
            $actualizarEstado->save();
            
            return 'El estado ' . $actualizarEstado->descripcion . ' ha sido actualizado';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
