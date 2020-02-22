<?php

namespace App\Http\Controllers;

use App\Modulo;
use App\Alumno;
use Illuminate\Http\Request;
use App\Http\Requests\ModuloRequest;
class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $alumno=$request->get('alumno_id');
        $alumnos=Alumno::orderBy('id')->get();
        $modulos=Modulo::orderBy('id')
        ->alumno($alumno)
        ->paginate(2);
        return view('modulos.index', compact('modulos','alumnos', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('modulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuloRequest $request)
    {
        $todos=$request->validated();
        Modulo::create($todos);
        return redirect()->route('modulos.index')->with('mensaje', 'Modulo creado correctamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
        return view('modulos.edit', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(ModuloRequest $request, Modulo $modulo)
    {
        $modulo->update($request->validated());
        return redirect()->route('modulos.index')->with('mensaje','modulo modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return redirect()->route('modulos.index')->with('mensaje','modulo borrado correctamente');
    }
}
