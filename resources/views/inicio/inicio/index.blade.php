	@extends('layouts.admin')
	@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="box">
				<div class="box-content">
					<h3 class="box-title">LISTADO DE PEDIDOS</h3>
					<div class="table-responsive">
						<table class="table table-striped table-bordered tyable -condensed table-hover">
							<thead>
								<!-- <th>ID</th> -->
								<th>FECHA</th>
								<th>CLIENTE</th>
								<th>COMPROBANTE</th>
								<th>TOTAL</th>
							</thead>
							@foreach ($ventas as $ven)
							<tr>
								<!-- <td>{{ $ven->idventa}}</td> -->
								<td><a href="{{URL::action('VentaController@show',$ven->idventa)}}">{{ $ven->fecha_hora}}</a></td>
								<td>{{ $ven->nombre}}</td>
								<td>{{ $ven->tipo_comprobante.': '.$ven->serie_comprobante.'-'.$ven->num_comprobante}}</td>
								<td>{{ $ven->total_venta}}</td>
							</tr>
							@endforeach
						</table>
					</div>
					{{$ventas->render()}}
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="box">
				<div class="box-content">
					<h3 class="box-title">LISTADO DE ARTICULOS</h3>
					<div class="table-responsive">
						<table class="table table-striped table-bordered tyable -condensed table-hover">
							<thead>
								<th>NOMBRE</th>
								<th>CODIGO</th>
								<th>CATEGORIA</th>
								<th>STOCK</th>
							</thead>
							@foreach ($articulos as $art)
							<tr>
								<td>{{ $art->nombre}}</td>
								<td>{{ $art->codigo}}</td>
								<td>{{ $art->categoria}}</td>
								<td>{{ $art->stock}}</td>
							</tr>
							@endforeach
						</table>
					</div>
					{{$articulos->render()}}
				</div>
			</div>
		</div>
	</div>
	@endsection