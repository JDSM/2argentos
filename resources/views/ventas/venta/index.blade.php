@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>LISTADO DE VENTAS   <a href="venta/create"><button class="btn btn-success">Nuevo</button></a></h3>

			@include('ventas.venta.search')
		</div>
	</div>
<!-- {{print_r($ventas)}} -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered tyable -condensed table-hover">
					<thead>
						<!-- <th>ID</th> -->
						<th>FECHA</th>
						<th>CLIENTE</th>
						<th>COMPROBANTE</th>
						<th>IMPUESTO</th>
						<th>TOTAL</th>
						<th>ESTADO</th>
						<th>OPCIONES</th>
					</thead>
					@foreach ($ventas as $ven)
					<tr>
						<!-- <td>{{ $ven->idventa}}</td> -->
						<td>{{ $ven->fecha_hora}}</td>
						<td>{{ $ven->nombre}}</td>
						<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->num_comprobante}}</td>
						<td>{{ $ven->impuesto}}</td>
						<td>{{ $ven->total_venta}}</td>
						<td>{{ $ven->estado}}</td>
						<td>
							@if (($ven->tipo_comprobante == "PEDIDO"||$ven->tipo_comprobante == "CONSIGNACION")&&(Auth::user()->tipo=='ADMIN'))
								<a href="{{URL::action('VentaController@edit',$ven->idventa)}}"><button class="btn btn-info">PROCESAR</button></a>
							@endif
							<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">DETALLES</button></a>
							@if (Auth::user()->tipo=='ADMIN')
							<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">ANULAR</button></a>
							@endif
						</td>
					</tr>
					@include('ventas.venta.modal')
					@endforeach
				</table>
			</div>
			{{$ventas->render()}}
		</div>
	</div>
@endsection