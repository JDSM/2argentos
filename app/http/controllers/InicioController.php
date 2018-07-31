<?php

namespace sis2Argentos\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use sis2Argentos\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class InicioController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request)
        {
    // lista los pedidos 
            $ventas=DB::table('venta as ven')
            ->join ('persona as per', 'ven.idcliente','=','per.idpersona')
            //->join ('detalle_venta as dven', 'ven.idventa','=','dven.idventa')
            ->select ('ven.idventa','ven.fecha_hora','per.nombre','ven.tipo_comprobante', 'ven.num_comprobante','ven.serie_comprobante','ven.impuesto','ven.estado','ven.total_venta')
            ->where('ven.tipo_comprobante','=','PEDIDO')
            ->orderBy('ven.idventa','desc')
            ->paginate(7);
    // lista los articulos que estan bajo de stock
            $articulos=DB::table('articulo as ar')
    		->join('categoria as ca', 'ar.idcategoria','=','ca.idcategoria')
    		->select('ar.idarticulo','ar.nombre','ar.codigo','ar.stock','ca.nombre as categoria','ar.descripcion','ar.imagen','ar.estado')
    		->where('ar.stock','<','100')
    		->where('ca.nombre','=','CONDIMENTOS')
      		->orwhere('ca.nombre','=','CONSERVANTES')
      		->where('ar.stock','<','100')
      		->orwhere('ca.nombre','=','ACEO')
      		->where('ar.stock','<','5')
      		->orwhere('ca.nombre','=','EMPAQUE')
      		->where('ar.stock','<','50')
      		->orwhere('ca.nombre','=','ETIQUETA')
      		->where('ar.stock','<','50')
      		->orwhere('ca.nombre','=','CARNES')
      		->where('ar.stock','<','5')
            ->orwhere('ca.nombre','=','PRODUCCION')
            ->where('ar.stock','<','5')
    		->orderBy('idarticulo','desc')
    		->paginate(7);
	// lista los articulos proximos a vencer 
    		$dingresos=DB::table('detalle_ingreso as ding')
    		->join ('articulo as art', 'ding.idarticulo','=','art.idarticulo')
    		->join ('ingreso as i', 'ding.idingreso','=','i.idingreso')
    		->select ('i.tipo_comprobante', 'i.num_comprobante','i.serie_comprobante','art.nombre','ding.fecha_vencimiento','ding.idingreso')
    		->whereBetween('ding.fecha_vencimiento', array(Carbon::now(), Carbon::now()->addWeek()))
    		->orderBy('ding.fecha_vencimiento','desc')
    		->paginate(7);
    //lista las ultimas producciones 		
    		$produccion=DB::table('produccion as pro')
    		->join ('articulo as art', 'pro.idarticulo','=','art.idarticulo')
    		->select ('art.nombre', 'pro.lote','pro.proceso','pro.fecha_hora1','pro.fecha_hora2','pro.fecha_hora3','pro.fecha_hora4','pro.fecha_vencimiento','pro.idproduccion')
    		->where ('pro.proceso','=','MOLIENDA')
    		//->whereBetween('pro.fecha_hora1', array(Carbon::now(), Carbon::now()->subWeek()))
    		->orwhere ('pro.proceso','=','MEZCLADO')
    		//->whereBetween('pro.fecha_hora2', array(Carbon::now(), Carbon::now()->subWeek()))
    		->orwhere ('pro.proceso','=','EMBUTIDO')
    		//->whereBetween('pro.fecha_hora3', array(Carbon::now(), Carbon::now()->subWeek()))
            ->orwhere ('pro.proceso','=','EMPAQUE')
    		->orderBy('pro.idproduccion','desc')
    		->paginate(7);
            return view('inicio.inicio.index',["ventas"=>$ventas,"articulos"=>$articulos,"dingresos"=>$dingresos,"produccion"=>$produccion]);
        }
    }
}
