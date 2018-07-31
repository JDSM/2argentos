<?php

namespace sis2Argentos\Http\Controllers;

use Illuminate\Http\Request;
use sis2Argentos\Http\Requests;
use sis2Argentos\Persona;
use Illuminate\Support\Facades\Redirect;
use sis2Argentos\Http\Requests\PersonaFormRequest;
use DB;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$personas=DB::table('persona')
    		->where('nombre','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','CLIENTE')
    		->orwhere('num_documento','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','CLIENTE')
    		->orderBy('idpersona','desc')
    		->paginate(7);
    		return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]);

    	}
    }
    public function create()
    {
    	return view("ventas.cliente.create");
    }
    public function store(PersonaFormRequest $request)
    {
    	$persona= new Persona;
    	$persona->tipo_persona='CLIENTE';
    	$persona->nombre=$request->get('nombre');
    	$persona->tipo_documento=$request->get('tipo_documento');
    	$persona->num_documento=$request->get('num_documento');
    	$persona->direccion=$request->get('direccion');
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
    	$persona->save();
    	return Redirect::to('ventas/cliente');

    }
    public function show($id)
    {
    	return view("ventas.cliente.show",["persona"=>Persona::findOrFail ($id)]);
    }
    public function edit($id)
    {
    	return view("ventas.cliente.edit",["persona"=>Persona::findOrFail ($id)]);
    }
    public function update(PersonaFormRequest $request,$id)
    {
    	$persona=Persona::findOrFail($id);
    	$persona->nombre=$request->get('nombre');
    	$persona->tipo_documento=$request->get('tipo_documento');
    	$persona->num_documento=$request->get('num_documento');
    	$persona->direccion=$request->get('direccion');
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
    	$persona->update();
    	return Redirect::to('ventas/cliente');
    }
    public function destroy($id)
    {
    	$persona=Persona::findOrFail($id);
    	$persona->tipo_persona='INACTIVO';
    	$persona->update();
    	return Redirect::to('ventas/cliente');
    }
}
