<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;

class PersonasController extends Controller
{

    public function index()
    {
        // Pagina de inicio
        $datos = Personas::orderBy('id','desc')->paginate(3);
        return view('inicio',compact('datos'));
    }


    public function create()
    {
        // Formulario donde agregamos datos
        return view('agregar');
    }


    public function store(Request $request)
    {
        // Sirve para guaradar datos en la bd
        $personas = new Personas();
        $personas->paterno = $request->post('paterno');
        $personas->materno = $request->post('materno');
        $personas->nombre = $request->post('nombre');
        $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
        $personas->save();

        return redirect()->route("personas.index")->with("success","Agregado con exito ");
    }


    public function show($id)
    {
        // Servira para obtener un registro de nuestra tabla
        $personas = Personas::find($id);
        return view('eliminar', compact('personas'));
    }


    public function edit($id)
    {
        // sirve para traer los datos que se va a editar y los coloca en un formulario
        $personas = Personas::find($id);
        return view('actualizar', compact('personas'));

    }


    public function update(Request $request, $id)
    {
        // actualiza los datos en la bd
        $personas = Personas::find($id);
        $personas->paterno = $request->post('paterno');
        $personas->materno = $request->post('materno');
        $personas->nombre = $request->post('nombre');
        $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
        $personas->save();

        return redirect()->route("personas.index")->with("success","Actualizado con exito ");
    }


    public function destroy($id)
    {
        $personas = Personas::find($id);
        $personas->delete();
        return redirect()->route("personas.index")->with('success',"Eliminado con exito!");
        //  Elimina un registro
    }
}
