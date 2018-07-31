@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="panel panel-primary" >
		<div class="panel-body">
			<div class="table-responsive">
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table class="table table-striped table-bordered table-condensed table-hover" style="margin: auto">
						<thead style="background-color: #A9D0F5">
							<tr class="success">
								<th style="text-align: center">RESPONSABLE</th>
								<th style="text-align: center">FECHA PRODUCCION</th>
								<th style="text-align: center">PERSONAL</th>
								<th style="text-align: center">PRODUCCION</th>
								<th style="text-align: center">LOTE</th>
								<th style="text-align: center">Nº FACTURA</th>
							</tr>
							<tr style="text-align: center">
								<td>{{$produccion->responsable1}}</td>
								<td>{{$produccion->fecha_hora1}}</td>
								<td>{{$produccion->personal}}</td>
								<td>{{$produccion->nombre}}</td>
								<td>{{$produccion->lote}}</td>
								<td><a href="{{URL::action('IngresoController@index','searchText='.$produccion->referencia)}}">{{$produccion->referencia}}</a></td>
							</tr>
							
						</thead>
						<tbody style="background-color: #A9D0F5">
							<tr class="success">
								<th style="text-align: center">FECHA DE VENCIMIENTO</th>
								<th style="text-align: center">FECHA MEZCLADO</th>
								<th style="text-align: center">FECHA EMBUTIDO</th>
								<th style="text-align: center">FECHA EMPAQUE</th>
								<th style="text-align: center">ESPERADO</th>
								<th style="text-align: center">PRODUCIDO</th>
							</tr>
							<tr style="text-align: center">
								<td>{{$produccion->fecha_vencimiento}}</td>
								<td>{{$produccion->fecha_hora2}}</td>
								<td>{{$produccion->fecha_hora3}}</td>
								<td>{{$produccion->fecha_hora4}}</td>
								<td>{{$produccion->estimado}} Kg</td>
								<td>{{$produccion->producido}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">	
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<table class="table table-striped table-bordered table-condensed table-hover" id="detalles">
					<thead style="background-color: #A9D0F5 ">
						<th>ARTICULO</th>
						<th>CANTIDAD</th>
						<th>COSTO /U</th>
						<th>SUBTOTAL</th>	
					</thead>
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th><h4 id="total">TOTAL: $.{{$produccion->costo_produccion}}</h4></th>
					</tfoot>
					<tbody>
						@foreach($detalles as $det)
						<tr>
							<td>{{$det->articulo}}</td>
							<td>{{$det->cantidad}}</td>
							<td>{{$det->costo}}</td>
							<td>{{$det->cantidad*$det->costo}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection