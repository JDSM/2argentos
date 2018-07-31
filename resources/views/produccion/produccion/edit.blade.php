@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>PROCESAR PRODUCCION: {{$produccion->nombre}} <br> LOTE:{{$produccion->lote}} <br> FECHA PRODUCCION: {{$produccion->fecha_hora1}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>
					{{$error}}
				</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
{!!Form::model($produccion,['url'=>['produccion/produccion',$produccion->idproduccion],'method'=>'PATCH','file'=>'true'])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			<label for="cliente">RESPONSABLE</label>
			<input type="text" name="responsable"  value="{{ Auth::user()->name }}" readonly class="form-control">
		</div>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<lavel>PROCESO DE LA PRODUCCION</lavel>
			<select name="proceso" class="form-control" >
				@if ($produccion->proceso=="MOLIENDA")
				<option value="{{$produccion->proceso}}" selected>{{$produccion->proceso}}</option>
				<option value="MEZCLADO">MEZCLADO</option>
				@endif
				@if ($produccion->proceso=="MEZCLADO")
				<option value="{{$produccion->proceso}}" selected>{{$produccion->proceso}}</option>
				<option value="EMBUTIDO">EMBUTIDO</option>
				@endif
				@if ($produccion->proceso=="EMBUTIDO")
				<option value="{{$produccion->proceso}}" selected>{{$produccion->proceso}}</option>
				<option value="EMPAQUE">EMPAQUE</option>
				@endif
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="personal">PERSONAL DE LA PRODUCCION</label>
			<input type="text" name="personal"  value="{{$produccion->personal}}" disabled class="form-control">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="cant_produccion">CANTIDAD DE CARNE USADA</label>
			<input type="text" name="cant_produccion" required value="{{$produccion->cant_produccion}}" disabled class="form-control">
		</div>
	</div>
	@if ($produccion->proceso=="EMBUTIDO")
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="producido">PRODUCIDO</label>
			<input type="text" name="producido" required value="{{old('producido')}}" class="form-control" placeholder="Cantidad de paquetes producidos...">
		</div>
	</div>
	@endif
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
					<?php $estimado=0; ?>
						@foreach($detalles as $det)
						<tr>
							<td>{{$det->articulo}}</td>
							<td>{{$det->cantidad}}</td>
							<?php 
								if($det->articulo=="CARNE DE CERDO"||$det->articulo=="CARNE DE RES"||$det->articulo=="GRASA")
								{
									$estimado=$estimado+$det->cantidad;
								}
								else $estimado=$estimado+($det->cantidad/1000);
							?>
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
	<label for="estimado" ></label>
	<input type="hidden" name="estimado" required value="{{$estimado}}" class="form-control">
	<label for="idarticulo" ></label>
	<input type="hidden" name="idarticulo" required value="{{$produccion->idarticulo}}" class="form-control">
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
	<div class="form-group">
		<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
		<button class="btn btn-primary" type="sumit">GUARDAR</button>
		<button class="btn btn-danger" type="reset">CANCELAR</button>
	</div>
</div>
{!!form::close()!!}
@endsection