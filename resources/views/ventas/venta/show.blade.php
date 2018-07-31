@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			<label for="cliente">CLIENTE</label>
			<p>{{$venta->nombre}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<lavel>TIPO COMPROBANTE</lavel>
			<p>{{$venta->tipo_comprobante}}</p>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">LOTE</label>
			<p>{{$venta->serie_comprobante}}</p>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="num_comprobante">NUMERO COMPROBANTE</label>
			<p>{{$venta->num_comprobante}}</p>
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<lavel>IVA</lavel>
			<p>{{$venta->impuesto}}</p>
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
						<th>PRECIO VENTA</th>
						<th>DESCUENTO</th>
						<th>SUBTOTAL</th>	
					</thead>
					<tfoot>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><h4 id="total">TOTAL: ${{$venta->total_venta}}</h4></th>
					</tfoot>
					<tbody>
						@foreach($detalles as $det)
						<tr>
							<td>{{$det->articulo}}</td>
							<td>{{$det->cantidad}}</td>
							<td>{{$det->precio_venta}}</td>
							<td>{{$det->descuento}}</td>
							<td>{{$det->cantidad*$det->precio_venta-$det->descuento}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection