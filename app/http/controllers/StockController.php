<?php

namespace sis2Argentos\Http\Controllers;

use Illuminate\Http\Request;
use sis2Argentos\Articulo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sis2Argentos\Http\Requests;
use sis2Argentos\Http\Requests\ArticuloFormRequest;
use DB;

class StockController extends Controller
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
    		$articulos=DB::table('articulo as ar')
    		->join('categoria as ca', 'ar.idcategoria','=','ca.idcategoria')
    		->select('ar.idarticulo','ar.nombre','ar.codigo','ar.stock','ca.nombre as categoria','ar.descripcion','ar.imagen','ar.estado')
    		->where('ca.nombre','=','PRODUCCION')
    		->orderBy('idarticulo','desc')
    		->paginate(7);
    		return view('almacen.stock.index',["articulos"=>$articulos,"searchText"=>$query]);

    	}
    }
}
