@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>LISTADO DE PRODUCCION <a href="produccion/create"><button class="btn btn-success">Nuevo</button></a></h3>

			@include('produccion.produccion.search')
		</div>
	</div>
<!-- {{print_r($produccion)}} -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered tyable -condensed table-hover">
					<thead>
						<!-- <th>ID</th> -->
						<th>FECHA</th>
						<th>RESPONSABLE</th>
						<th>LOTE</th>
						<th>ARTICULO</th>
						<th>PROCESO</th>
						<th>FECHA DE VENCIMIENTO</th>
						<th>ESTADO</th>
						<th>OPCIONES</th>
					</thead>
					@foreach ($produccion as $pro)
					<tr>
						<td>{{ $pro->fecha_hora1}}</td>
						<td>{{ $pro->responsable1}}</td>
						<td>{{ $pro->lote}}</td>
						<td>{{ $pro->nombre}}</td>
						<td>{{ $pro->proceso}}</td>
						<td>{{ $pro->fecha_vencimiento}}</td>
						<td>{{ $pro->estado}}</td>
						<td>
							@if ($pro->proceso != "EMPAQUE")
								<a href="{{URL::action('ProduccionController@edit',$pro->idproduccion)}}"><button class="btn btn-info">PROCESAR</button></a>
							@endif
							<a href="{{URL::action('ProduccionController@show',$pro->idproduccion)}}"><button class="btn btn-primary">DETALLES</button></a>
							@if (Auth::user()->tipo=='ADMIN')
							<a href="" data-target="#modal-delete-{{$pro->idproduccion}}" data-toggle="modal"><button class="btn btn-danger">ANULAR</button></a>
							@endif
						</td>
					</tr>
					@include('produccion.produccion.modal')
					@endforeach
				</table>
			</div>
			{{$produccion->render()}}
		</div>
	</div>
@endsection