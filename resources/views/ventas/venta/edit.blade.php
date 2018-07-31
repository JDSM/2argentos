@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>PROCESAR VENTA: {{$venta->nombre}} {{$venta->serie_comprobante}}-{{$venta->num_comprobante}}</h3>
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
{!!Form::model($venta,['url'=>['ventas/venta',$venta->idventa],'method'=>'PATCH','file'=>'true'])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			<label for="cliente">CLIENTE</label>
			<input type="text" name="cliente"  value="{{$venta->nombre}}" disabled class="form-control">
		</div>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<lavel>TIPO DE VENTA</lavel>
			<select name="tipo_comprobante" class="form-control" onchange="mostrar (this)" id="tipo_venta">
				@if ($venta->tipo_comprobante=="PEDIDO")
				<option value="{{$venta->tipo_comprobante}}" selected>{{$venta->tipo_comprobante}}</option>
				<option value="CONSIGNACION">CONSIGNACION</option>
				<option value="VENTA">VENTA</option>
				<option value="DEVOLUCION">DEVOLUCION</option>
				@endif
				@if ($venta->tipo_comprobante=="CONSIGNACION")
				<option value="{{$venta->tipo_comprobante}}" selected>{{$venta->tipo_comprobante}}</option>
				<option value="VENTA">VENTA</option>
				<option value="DEVOLUCION">DEVOLUCION</option>
				@endif
				@if ($venta->tipo_comprobante=="REPOSICION")
				<option value="{{$venta->tipo_comprobante}}" selected>{{$venta->tipo_comprobante}}</option>
				<option value="DEVOLUCION">DEVOLUCION</option>
				@endif
				@if ($venta->tipo_comprobante=="VENTA")
				<option value="{{$venta->tipo_comprobante}}" selected>{{$venta->tipo_comprobante}}</option>
				<option value="DEVOLUCION">DEVOLUCION</option>
				@endif
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" id="detalle" style="display: none;">
		<div class="form-group">
			<label for="detalle">DETALLE</label>
			<input type="text" name="detalle"  value="{{$venta->serie_comprobante}}" disabled class="form-control">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" id="cartera" style="display: none;">
		<div class="form-group">
			<label>CARTERA</label>
			<select name="cartera" class="form-control">
			@if ($venta->cartera=="7")
				<option value="{{$venta->cartera}}" selected>{{$venta->cartera}}</option>
				<option value="15">15 DIAS</option>
				<option value="30">30 DIAS</option>
			@endif
			@if ($venta->cartera=="15")
				<option value="{{$venta->cartera}}" selected>{{$venta->cartera}}</option>
				<option value="7">7 DIAS</option>
				<option value="30">30 DIAS</option>
			@endif
			@if ($venta->cartera=="30")
				<option value="{{$venta->cartera}}" selected>{{$venta->cartera}}</option>
				<option value="7">7 DIAS</option>
				<option value="15">15 DIAS</option>
			@endif
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display: none;" id="fecha">
    	<div class="form-group">
    		<label for="fecha_pago">F/PAGO</label>
    		<input type="date" name="fecha_pago" class="form-control" value="{{$venta->fecha_pago}}" readonly>
    	</div>
    </div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" id="aporte" style="display: none;">
		<div class="form-group">
			<label for="aporte">APORTE</label>
			<input type="number" name="aporte"  value="{{old('aporte')}}" class="form-control" placeholder="$ 0,00" onblur="descontar (this)">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">LOTE</label>
			<input type="text" name="serie_comprobante"  value="{{$venta->serie_comprobante}}" disabled class="form-control">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="num_comprobante">NUMERO COMPROBANTE</label>
			<input type="text" name="num_comprobante" required value="{{$venta->num_comprobante}}" readonly class="form-control">
		</div>
	</div>
	<!-- 	campo oculto para guaradr el responsable de la venta -->
	<label for="responsable" ></label>
	<input type="hidden" name="responsable" required value="{{ Auth::user()->name }}" class="form-control">
	<input type="hidden" name="val" required value="{{$venta->responsable }}" class="form-control">
	<input type="hidden" name="val1" required value="{{$venta->responsable2 }}" class="form-control">
	<input type="hidden" name="val2" required value="{{$venta->responsable3 }}" class="form-control">
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<lavel>IVA</lavel>
			<input type="text" name="impuesto" required value="{{$venta->impuesto.'%'}}" readonly= class="form-control">
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
						<th>IVA</th>
						<th>TOTAL</th>	
						<th id="aporte3" style="display: none;">CARTERA</th>
					</thead>
					<tfoot>
						<th></th>
						<th id="aporte4" style="display: none;"></th>
						<th></th>
						<th></th>
						<th></th>
						<th><h4 id="impu">$. {{($venta->total_venta*$venta->impuesto)/100}}</h4></th>
						<th><h4 id="total">$. {{$venta->total_venta}}</h4><input name="total_venta" id="total_venta" type="hidden"></th>
						<th><h4 id="aporte2" style="display: none;">$. 0.00</h4><input name="debe" id="debe" type="hidden"></th>
					</tfoot>
					<tbody>
						@foreach($detalles as $det)
						<tr>
							<td>{{$det->articulo}}</td>
							<input type="hidden" name="idarticulo[]" required value="{{$det->idarticulo}}" class="form-control">
							<td>{{$det->cantidad}}</td>
							<input type="hidden" name="cantidad[]" required value="{{$det->cantidad}}" class="form-control">
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
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
	<div class="form-group">
		<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
		<?php $control=0;?>
		@foreach($detalles as $det2)
			@if($det2->cantidad > $det->stock)
				<?php $control=1;?>
			@endif
		@endforeach
		@if ($control==0)
			<button class="btn btn-primary" type="sumit">GUARDAR</button>
			<button class="btn btn-danger" type="reset">CANCELAR</button>
		@endif
		@if ($control==1)
			<div class="alert alert-danger" id="notas">
  				<strong id="nota">Error! Uno o más productos superan el stock. Debe anular el pedido y generar uno nuevo.</strong>
			</div>
		@endif
	</div>
</div>
{!!form::close()!!}
@push ('scripts')
	<script>
	selec=$("#tipo_venta").val();
	deuda={{$venta->debe}};
	fdeuda=deuda;
	console.log(ftotal);
	window.onload = cargar();
	function cargar()
	{
  			if (selec=="CONSIGNACION")
			{
           		divC = document.getElementById("cartera");
           		divC.style.display = "";
           		divD = document.getElementById("aporte");
           		divD.style.display = "";
           		divF = document.getElementById("aporte4");
           		divF.style.display = "";
           		divE = document.getElementById("aporte3");
           		divE.style.display = "";
           		divB = document.getElementById("aporte2");
           		divB.style.display = "";
           		divG = document.getElementById("fecha");
           		divG.style.display = "";
      		}
	}
		function descontar(valor)
		{
			des=valor.value;
			fdeuda=deuda-des;
			$("#aporte2").html("$. "+fdeuda);
			$("#debe").val(fdeuda);
		}
		function limpiar2()
		{
			if(typeof(des) != "undefined")
			{
				$("#aporte2").html("$. "+deuda);
				$("#debe").val(deuda);
			}
		}
		function mostrar(sel)
		{
			if (sel.value=="DEVOLUCION")
			{
           		divA = document.getElementById("detalle");
           		divA.style.display = "";
      		}
      		if (sel.value=="CONSIGNACION")
			{
           		divC = document.getElementById("cartera");
           		divC.style.display = "";
           		divD = document.getElementById("aporte");
           		divD.style.display = "";
           		divF = document.getElementById("aporte4");
           		divF.style.display = "";
           		divE = document.getElementById("aporte3");
           		divE.style.display = "";
           		divB = document.getElementById("aporte2");
           		divB.style.display = "";
           		divG = document.getElementById("fecha");
           		divG.style.display = "";
      		}
      		if (sel.value=="VENTA"||sel.value=="PEDIDO")
      		{
      			divA = document.getElementById("detalle");
           		divA.style.display = "none";
      			divC = document.getElementById("cartera");
           		divC.style.display = "none";
           		divD = document.getElementById("aporte");
           		divD.style.display = "none";
           		limpiar2();
           		divF = document.getElementById("aporte4");
           		divF.style.display = "none";
           		divE = document.getElementById("aporte3");
           		divE.style.display = "none";
           		divB = document.getElementById("aporte2");
           		divB.style.display = "none";
           		divG = document.getElementById("FECHA");
           		divG.style.display = "none";
      		}
		}
	</script>
@endpush
@endsection