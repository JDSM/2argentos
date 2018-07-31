@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>NUEVA VENTA</h3>
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
{!!Form::open(array('url'=>'ventas/venta', 'method'=>'POST', 'autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			<label for="cliente">CLIENTE</label>
			<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
				@foreach($personas as $per)
					<option value="{{$per->idpersona}}">{{$per->nombre}}</option>
				@endforeach	
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<lavel>TIPO COMPROBANTE</lavel>
			<select name="tipo_comprobante" class="form-control" id="tipo_comprobante" onchange="mostrar (this)">
				<option value="PEDIDO">PEDIDO</option>
				<option value="CONSIGNACION">CONSIGNACION</option>
				<option value="VENTA">VENTA</option>
				<option value="REPOSICION">REPOSICION</option>
				<option value="CORTESIA">CORTESIA</option>
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" id="detalle" style="display: none;">
		<div class="form-group">
			<label for="detalle">DETALLE</label>
			<input type="text" name="detalle"  value="{{old('detalle')}}" class="form-control" placeholder="Detalle ...">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" id="cartera" style="display: none;">
		<div class="form-group">
			<label>CARTERA</label>
			<select name="cartera" class="form-control">
				<option value="7">7 DIAS</option>
				<option value="15">15 DIAS</option>
				<option value="30">30 DIAS</option>
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display: none;" id="fecha">
    	<div class="form-group">
    		<label for="fecha_pago">F/PAGO</label>
    		<input type="date" name="fecha_pago" class="form-control">
    	</div>
    </div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<lavel>IVA</lavel>
			<select name="impuesto" class="form-control" id="iva" onchange="calcular(this)" >
				<option value="0">0%</option>
				<option value="6">6%</option>
				<option value="9">9%</option>
				<option value="12">12%</option>
				<option value="19">19%</option>
			</select>
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">LOTE</label>
			<input type="text" name="serie_comprobante"  value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie del Comprobante...">
		</div>
	</div>
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="form-group">
			<label for="num_comprobante">NUMERO COMPROBANTE</label>
			<input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Numero del Comprobante...">
		</div>
	</div>
<!-- 	campo oculto para guaradr el responsable de la venta -->
			<label for="responsable" ></label>
			<input type="hidden" name="responsable" required value="{{ Auth::user()->name }}" class="form-control">
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" id="aporte" style="display: none;">
		<div class="form-group">
			<label for="aporte">APORTE</label>
			<input type="number" name="aporte"  value="{{old('aporte')}}" class="form-control" placeholder="$ 0,00" onblur="descontar (this)">
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label>ARTICULO</label>
					<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
					@foreach($articulos as $articulo)
						<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_total}}">{{$articulo->articulo}}</option>
					@endforeach	
					</select>
				</div>
			</div>
			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<label for="cantidad">CANTIDAD</label>
					<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
				</div>
			</div>
			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<label for="stock">STOCK</label>
					<input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock">
				</div>
			</div>
			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<label for="precio_venta">PRECIO VENTA</label>
					<input type="number" disabled name="pprecio_compra" id="pprecio_venta" class="form-control" placeholder="Precio Compra">
				</div>
			</div>
			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<label for="descuento">DESCUENTO</label>
					<input type="number" name="pdescuento" id="pdescuento" class="form-control" placeholder="Descuento">
				</div>
			</div>	
			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<button type="button" id="bt_add" class="btn btn-primary">AGREGAR</button>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<table class="table table-striped table-bordered table-condensed table-hover" id="detalles">
					<thead style="background-color: #A9D0F5 ">
						<th>OCIONES</th>
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
						<th></th>
						<th><h4 id="impu">$. 0.00</h4></th>
						<th><h4 id="total">$. 0.00</h4><input name="total_venta" id="total_venta" type="hidden"></th>
						<th><h4 id="aporte2" style="display: none;">$. 0.00</h4><input name="debe" id="debe" type="hidden"></th>
					</tfoot>
					<tbody>
						
					</tbody>
				</table>
			</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
		<div class="form-group">
			<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
			<button class="btn btn-primary" type="sumit">GUARDAR</button>
			<button class="btn btn-danger" type="reset">CANCELAR</button>
		</div>
	</div>
</div>

{!!form::close()!!}
@push ('scripts')
	<script>
		$(document).ready(function(){
			$('#bt_add').click(function(){
				agregar();
			});
		});
		var cont=0;
		total=0;
		subtotal=[];
		des=0;
		itotal=0;
		ftotal=0;
		deuda=0;
		$("#guardar").hide();
		$("#pidarticulo").change(mostrarValores);
		function calcular(imp)
		{
			i=parseInt(imp.value);
			i=i/100;
			itotal=total*i;
			ftotal=total+itotal;
			deuda=ftotal-des;
			$("#total").html("$. "+ftotal);
			$("#total_venta").val(ftotal);
			$("#impu").html("$. "+itotal);
			$("#aporte2").html("$. "+deuda);
			$("#debe").val(deuda);
		}
		function descontar(valor)
		{
			des=valor.value;
			deuda=ftotal-des;
			$("#aporte2").html("$. "+deuda);
			$("#debe").val(deuda);
		}
		function limpiar2()
		{
			if(typeof(des) != "undefined")
			{
				$("#aporte2").html("$. "+ftotal);
				$("#debe").val(ftotal);
			}
		}
		function mostrar(sel)
		{
			if (sel.value=="CORTESIA"||sel.value=="REPOSICION")
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
           		divG = document.getElementById("fecha");
           		divG.style.display = "none";

      		}
		}

		function mostrarValores()
		{
			datosArticulo=document.getElementById('pidarticulo').value.split('_');
			$("#pprecio_venta").val(datosArticulo[2]);
			$("#pstock").val(datosArticulo[1]);
		}
		function agregar()
		{
			datosArticulo=document.getElementById('pidarticulo').value.split('_');

			idarticulo=datosArticulo[0];
			articulo=$("#pidarticulo option:selected").text();
			cantidad=$("#pcantidad").val();
			descuento=$("#pdescuento").val();
			precio_venta=$("#pprecio_venta").val();
			stock=$("#pstock").val(datosArticulo[1]);

			if(idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="")
				{
					if (stock >= cantidad) 
					{
						subtotal[cont]=(cantidad*precio_venta-descuento);
					total=total+subtotal[cont];
					var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" readonly value="'+cantidad+'"></td><td><input type="number" name="precio_venta[]" readonly value="'+precio_venta+'"></td><td><input type="number" name="descuento[]" readonly value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
					cont++;
					limpiar();
					itotal=total*i;
					ftotal=total+itotal;
					deuda=ftotal-des;
					$("#total").html("$. "+ftotal);
					$("#total_venta").val(ftotal);
					$("#impu").html("$. "+itotal);
					$("#aporte2").html("$. "+deuda);
					$("#debe").val(deuda);
					evaluar();
					$('#detalles').append(fila);
					}
					else
					{
						alert ('La cantidad a vender supera al stock');
					}
					
				}
			else
			{
				alert("ERROR AL INGRESAR EL DETALLE DE LA VENTA, REVISE LOS DATOS DEL ARTICULO")
			}
		}
		function limpiar()
		{
			$("#pcantidad").val("");
			$("#pstock").val("");
			$("#pdescuento").val("");
			$("#pprecio_venta").val("");
		}
		function evaluar()
		{
			if (total>0)
			{
				$("#guardar").show();
			}
			else
			{
				$("#guardar").hide();
			}
		}
		function eliminar (index)
		{
			total=total-subtotal[index];
			itotal=total*i;
			ftotal=total+itotal;
			deuda=ftotal-des;
			$("#total").html("$. "+ftotal);
			$("#total_venta").val(ftotal);
			$("#impu").html("$. "+itotal);
			$("#aporte2").html("$. "+deuda);
			$("#debe").val(deuda);
			$("#fila"+ index).remove();
			evaluar();
		}
	</script>
@endpush
@endsection