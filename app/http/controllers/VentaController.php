<?php

namespace sis2Argentos\Http\Controllers;

use Illuminate\Http\Request;
use sis2Argentos\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sis2Argentos\Http\Requests\VentaFormRequest;
use sis2Argentos\Venta;
use sis2Argentos\DetalleVenta;
use sis2Argentos\Articulo;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
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
    		$ventas=DB::table('venta as ven')
    		->join ('persona as per', 'ven.idcliente','=','per.idpersona')
    		//->join ('detalle_venta as dven', 'ven.idventa','=','dven.idventa')
    		->select ('ven.idventa','ven.fecha_hora','per.nombre','ven.tipo_comprobante', 'ven.num_comprobante','ven.serie_comprobante','ven.impuesto','ven.estado','ven.total_venta')
    		->where('ven.num_comprobante','LIKE','%'.$query.'%')
        ->orwhere('ven.tipo_comprobante','LIKE','%'.$query.'%')
    		->orderBy('ven.idventa','desc')
    	//	->groupBy('ven.idventa','ven.fecha_hora','per.nombre','ven.tipo_comprobante', 'ven.num_comprobante','ven.serie_comprobante','ven.impuesto','ven.estado')
    		->paginate(7);
    		return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);

    	}
    }
    public function create()
  	{
  		$personas=DB::table('persona')->where('tipo_persona','=','CLIENTE')->get();
  		$articulos=DB::table('articulo as art')
  		->join('detalle_ingreso as ding', 'art.idarticulo','=','ding.idarticulo')
  		->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'),'art.idarticulo','art.stock',DB::raw('max(ding.precio_venta) as precio_total'))
  		->where('art.estado','=','ACTIVO')
  		->where('art.stock','>','0')
      ->where('art.idcategoria','=','1')
  		->groupBy('articulo','art.idarticulo','art.stock')
  		->get();
  		return view("ventas.venta.create",["personas"=>$personas,"articulos"=>$articulos]);
  	}
  	public function store (VentaFormRequest $request)
  	{
  		try{
     
  			DB::beginTransaction();
  			$venta= new Venta;
  			$venta->idcliente=$request->get('idcliente');
  			$venta->tipo_comprobante=$request->get('tipo_comprobante');
  			$venta->serie_comprobante=$request->get('serie_comprobante');
  			$venta->num_comprobante=$request->get('num_comprobante');
  			$venta->total_venta=$request->get('total_venta');
  			$mytime=Carbon::now('America/Bogota');
  			$venta->fecha_hora=$mytime->toDateTimeString();
  			$venta->impuesto=$request->get('impuesto');
        $venta->responsable=$request->get('responsable');
  			$venta->estado='A';
        if($request->get('tipo_comprobante')=="CONSIGNACION")
        {
          $venta->aporte=$request->get('aporte');
          $venta->cartera=$request->get('cartera');
          $venta->debe=$request->get('debe');
        }
        if($request->get('tipo_comprobante')=="CORTESIA")
        {
          $venta->detalle=$request->get('detalle');
        }
        if($request->get('tipo_comprobante')=="REPOSICION")
        {
          $venta->detalle=$request->get('detalle');
        }
  			$venta->save();

  			$idarticulo=$request->get('idarticulo');
  			$cantidad=$request->get('cantidad');
  			$descuento=$request->get('descuento');
  			$precio_venta=$request->get('precio_venta');

  			$cont=0;
  			while ($cont < count($idarticulo)){
  				$detalle= new DetalleVenta();
  				$detalle->idventa=$venta->idventa;
  				$detalle->idarticulo=$idarticulo[$cont];
  				$detalle->descuento=$descuento[$cont];
  				$detalle->precio_venta=$precio_venta[$cont];
  				$detalle->cantidad=$cantidad[$cont];
  				$detalle->save();
          if($request->get('tipo_comprobante')!="PEDIDO")
          {
            $articulo=articulo::findOrFail($idarticulo[$cont]);
            $articulo->stock-=$cantidad[$cont];
            $articulo->update();
          }
          
  				$cont=$cont+1;
  			}

  			DB::commit();
  		}catch(\Exception $e)
  		{
  			DB::rollback();
  		}
  		return Redirect::to('ventas/venta');
  	}
    public function edit($id)
    {
        $venta=DB::table('venta as ven')
        ->join ('persona as per', 'ven.idcliente','=','per.idpersona')
        ->join ('detalle_venta as dven', 'ven.idventa','=','dven.idventa')
        ->select ('ven.idventa','ven.fecha_hora','per.nombre','ven.tipo_comprobante', 'ven.num_comprobante','ven.serie_comprobante','ven.impuesto','ven.estado','ven.total_venta','ven.cartera','ven.fecha_pago')
        ->where('ven.idventa','=',$id)
      //      ->groupBy('ven.idventa','ven.fecha_hora','per.nombre','ven.tipo_comprobante', 'ven.num_comprobante','ven.serie_comprobante','ven.impuesto','ven.estado')
        ->first();

        $detalles=DB::table('detalle_venta as dv')
        ->join('articulo as art','dv.idarticulo','=','art.idarticulo')
        ->select('art.nombre as articulo','dv.cantidad','dv.descuento','dv.precio_venta','dv.idarticulo','art.stock')
        ->where('dv.idventa','=',$id)
        ->get();
        return view("ventas.venta.edit",["venta"=>$venta,"detalles"=>$detalles]);
    }
    public function update (Request $request,$id)
    {
      $venta=venta::findOrFail($id);
      $venta->tipo_comprobante=$request->get('tipo_comprobante');
      if ($request->get('tipo_comprobante')=="VENTA")
      {
        $venta->responsable4=$request->get('responsable');
        $mytime=Carbon::now('America/Bogota');
        $venta->fecha_hora4=$mytime->toDateTimeString();
        $venta->update();
      }
      if ($request->get('tipo_comprobante')=="DEVOLUCION")
      {
        $venta->responsable4=$request->get('responsable');
        $mytime=Carbon::now('America/Bogota');
        $venta->fecha_hora4=$mytime->toDateTimeString();
        $venta->detalle=$request->get('detalle');
        $venta->update();
      }
      if ($request->get('tipo_comprobante')=="CONSIGNACION")
      {
        if($request->get('val1')=="" && $request->get('val')!="")
        {
          $venta->responsable2=$request->get('responsable');
          $mytime=Carbon::now('America/Bogota');
          $venta->fecha_hora2=$mytime->toDateTimeString();
          $venta->cartera=$request->get('cartera');
          $venta->aporte2=$request->get('aporte');
          $venta->debe=$request->get('debe');
          $venta->update();
        }
        if($request->get('val2')=="" && $request->get('val1')!="")
        {
          $venta->responsable3=$request->get('responsable');
          $mytime=Carbon::now('America/Bogota');
          $venta->fecha_hora3=$mytime->toDateTimeString();
          $venta->cartera=$request->get('cartera');
          $venta->aporte3=$request->get('aporte');
          $venta->debe=$request->get('debe');
          $venta->update();
        }
      }
      $idarticulo=$request->get('idarticulo');
      $cantidad=$request->get('cantidad');
      $cont=0;
        while ($cont < count($idarticulo))
        {
          if($request->get('tipo_comprobante')!="PEDIDO")
          {
              $articulo=articulo::findOrFail($idarticulo[$cont]);
              $articulo->stock-=$cantidad[$cont];
              $articulo->update(); 
          }
          $cont=$cont+1;
        }

      return Redirect::to('ventas/venta');
    }
  	public function show($id)
  	{
  		$venta=DB::table('venta as ven')
    		->join ('persona as per', 'ven.idcliente','=','per.idpersona')
    		->join ('detalle_venta as dven', 'ven.idventa','=','dven.idventa')
    		->select ('ven.idventa','ven.fecha_hora','per.nombre','ven.tipo_comprobante', 'ven.num_comprobante','ven.serie_comprobante','ven.impuesto','ven.estado','ven.total_venta')
    		->where('ven.idventa','=',$id)
      //      ->groupBy('ven.idventa','ven.fecha_hora','per.nombre','ven.tipo_comprobante', 'ven.num_comprobante','ven.serie_comprobante','ven.impuesto','ven.estado')
    		->first();

    		$detalles=DB::table('detalle_venta as dv')
    		->join('articulo as art','dv.idarticulo','=','art.idarticulo')
    		->select('art.nombre as articulo','dv.cantidad','dv.descuento','dv.precio_venta','dv.idarticulo')
    		->where('dv.idventa','=',$id)
    		->get();

    		return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
  	}
  	public function destroy($id)
  	{
  		$venta=Venta::findOrFail($id);
  		$venta->Estado='C';
  		$venta->update();
  		return Redirect::to('ventas/venta');
  	}
}
