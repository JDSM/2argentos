@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>NUEVA PRODUCCION</h3>
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
{!!Form::open(array('url'=>'produccion/produccion', 'method'=>'POST', 'autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row" id="bloque1">
	<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
		<div class="form-group">
			<label for="responsable">RESPONSABLE</label>
			<input type="text" name="responsable" required readonly value="{{ Auth::user()->name }}" class="form-control">
		</div>
	</div>
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<label for="referencia">Nº  FACTURA</label>
			<select name="referencia" class="form-control selectpicker"  data-live-search="true">
			@foreach($referencia as $referencia)
				<option value="{{$referencia->num_comprobante}}">{{$referencia->num_comprobante}}</option>
			@endforeach	
			</select>
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<label for="personal">PERSONAL</label>
			<input type="number" name="personal"  value="{{old('personal')}}" id="personal" class="form-control" placeholder="Cantidad del Personal...">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<label for="sidarticulo">PRODUCCION</label>
			<select name="sidarticulo" class="form-control selectpicker"  id="didarticulo" data-live-search="true">
					@foreach($articulos as $articulo)
						<option value="{{$articulo->idarticulo}}">{{$articulo->nombre}}</option>
					@endforeach	
					</select>
					<input type="hidden" name="didarticulo" required id="sidarticulo" class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<label for="cant_produccion">CARNE A PRODUCIR</label>
			<input type="number" name="cant_produccion" required id="cant_produccion" value="{{old('cant_produccion')}}" class="form-control" placeholder="Cantidad de carne a Producir en Kg...">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<label for="proceso">PROCESO</label>
			<select name="proceso" class="form-control"  id="proceso">
				<option value="MOLIENDA" selected>MOLIENDA</option>
				<!-- <option value="MEZCLADO">MEZCLADO</option>
				<option value="EMBUTIDO">EMBUTIDO</option>
				<option value="EMPAQUE">EMPAQUE</option> -->
			</select>
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		<div class="form-group">
			<label for="fecha_vencimiento">F/ VENCIMIENTO</label>
			<input type="date" name="fecha_vencimiento"  value="{{old('fecha_vencimiento')}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12" id="aceptar">
				<div class="form-group">
					<button type="button" id="bt_aceptar" class="btn btn-primary">ACEPTAR</button>
				</div>
			</div>
</div>
<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label>INGREDIENTES</label>
					<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
					@foreach($p_articulos as $p_articulo)
						<option value="{{$p_articulo->idarticulo}}_{{$p_articulo->stock}}_{{$p_articulo->costo_total}}">{{$p_articulo->nombre}}</option>
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
					<label for="costo">COSTO /U</label>
					<input type="number" disabled name="pcosto" id="pcosto" class="form-control" placeholder="Costo Unitario">
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
						<th>COSTO /U</th>
						<th>SUBTOTAL</th>	
					</thead>
					<tfoot>
						<th>TOTAL</th>
						<th></th>
						<th></th>
						<th></th>
						<th><h4 id="total">$. 0.00</h4><input name="costo_produccion" id="costo_produccion" type="hidden"></th>
					</tfoot>
					<tbody>
						
					</tbody>
				</table>
			</div>
	</div>
	<div class="alert alert-danger" id="notas">
  		<strong id="nota">Error!</strong>
	</div>
	<!-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="notas">
		<div class="form-group">
			<h4 id="nota"></h4>
		</div>
	</div> -->
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
		<div class="form-group">
			<input type="hidden" name="_token" value="{{csrf_token()}}"></input>
			<button class="btn btn-primary" type="sumit">GUARDAR</button>
			<button class="btn btn-danger" type="button" onclick="document.location.reload();">CANCELAR</button>
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
		$(document).ready(function(){
			$('#bt_aceptar').click(function(){
				cargarProduccion();
			});
		});
		var cont=0;
		total=0;
		subtotal=[];
		control=[];
		sum=0;
		$("#guardar").hide();
		$("#notas").hide();
		$("#pidarticulo").change(mostrarValores);
		var articulos1=<?php echo json_encode($articulos)?>;
		console.log(articulos1);
		var articulos2=<?php echo json_encode($p_articulos)?>;
		console.log(articulos2);

		function cargarProduccion()
		{
			selarticulo=$("#didarticulo option:selected").text();
			pcantidad=$("#cant_produccion").val();
			personal=$("#personal").val();
			proceso=$("#proceso option:selected").text();
			controlstock=0;	
			esperado=0;
			console.log(selarticulo);
			for (k=0;k<articulos2.length;k++)
			{
				if (articulos2[k].nombre=="CARNE DE CERDO")
				{
					controlstock1=articulos2[k];
				}
				if (articulos2[k].nombre=="GRASA")
				{
					controlstock2=articulos2[k];
				}
				if (articulos2[k].nombre=="CARNE DE RES")
				{
					controlstock3=articulos2[k];
				}
			}
			if (controlstock1.stock<pcantidad||controlstock3<pcantidad)
			{
				controlstock=1;
				alert("ERROR:La cantidad de Carne a producir supera al stock");
				
			}
			if ((controlstock2.stock<pcantidad*0.25||controlstock2<pcantidad*0.446) && controlstock==0)
			{
				controlstock=1;
				alert("ERROR:La cantidad de Grasa requerida supera al stock");
			}
			if(selarticulo!="" && pcantidad!="" && personal!="" && proceso!="" && controlstock==0)
			{
				$("#aceptar").hide();
				sarticulo=$("#didarticulo").val();
				$("#sidarticulo").val(sarticulo);
				$('#didarticulo').attr('disabled', 'disabled');
				$('#bloque1 input').prop('readonly', true);
//  ---------------------------- INICIO FORMULA LONGANIZA CALABRESA -----------------------------------------------
				if (selarticulo=="CHORIZO CLASICO")
				{
					for (var j=0;j<articulos2.length;j++)
					{
						console.log(articulos2[j]);
						if (articulos2[j].nombre=="CARNE DE CERDO")
						{
							
							cantidad=pcantidad;
							esperado=esperado+cantidad;			
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"Kg"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								console.log(control[sum]);
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="GRASA")
						{
							
							cantidad=pcantidad*0.25;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"Kg"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								console.log(control[sum]);
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="SAL")
						{
							
							cantidad=pcantidad*18.75;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PIMIENTA")
						{
							
							cantidad=pcantidad*1.875;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PIMIENTA ROJA")
						{
							
							cantidad=pcantidad*0.625;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="OREGANO")
						{
							
							cantidad=pcantidad*1.5;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="CEBOLLA MOLIDA")
						{
							
							cantidad=pcantidad*0.625;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AJO MOLIDO")
						{
							
							cantidad=pcantidad*0.625;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="HINOJO")
						{
							
							cantidad=pcantidad*0.625;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="VINO")
						{
							
							cantidad=pcantidad*31.25;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="NITRITO")
						{
							
							cantidad=pcantidad*0.25;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ANTIOXIDANTE"||articulos2[j].nombre=="INBAC MDA"||articulos2[j].nombre=="PRESERVAR")
						{
							
							cantidad=pcantidad*3.75;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AGUA")
						{
							
							cantidad=pcantidad*15.625;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
					}
				}
	//			---------------------------------------------------- FIN FORMULA CHORIZO CLASICO		-----------------------------------------------
	//			---------------------------------------------------- INICIO FORMULA LONGANIZA CALABRESA ----------------------------------------------- 
			if (selarticulo=="LONGANIZA CALABRESA")
				{
					for (var j=0;j<articulos2.length;j++)
					{
						console.log(articulos2[j]);
						if (articulos2[j].nombre=="CARNE DE CERDO")
						{
							
							cantidad=pcantidad;
							esperado=esperado+cantidad;			
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"Kg"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="SAL")
						{
							
							cantidad=pcantidad*15;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PIMIENTA")
						{
							
							cantidad=pcantidad*3;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AJI MOLIDO")
						{
							
							cantidad=pcantidad*1.5;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="HINIJO")
						{
							
							cantidad=pcantidad*5;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AJO MOLIDO")
						{
							
							cantidad=pcantidad*1;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="VINO")
						{
							
							cantidad=pcantidad*30;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="NITRITO")
						{
							
							cantidad=pcantidad*0.2;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ANTIOXIDANTE"||articulos2[j].nombre=="INBAC MDA"||articulos2[j].nombre=="PRESERVAR")
						{
							
							cantidad=pcantidad*3;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="NUEZ MOSCADA")
						{
							
							cantidad=pcantidad*1;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AGUA")
						{
							
							cantidad=pcantidad*15;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
					}
				}
		//		-------------------------------------------------- FIN FORMULA LONGANIZA CALABRESA -----------------------------------------------------------
		//		-------------------------------------------------- INICIO FORMULA SALCHICHA ALEMANA ----------------------------------------------------------
				if (selarticulo=="SALCHICHA ALEMANA")
				{
					for (var j=0;j<articulos2.length;j++)
					{
						console.log(articulos2[j]);
						if (articulos2[j].nombre=="CARNE DE CERDO")
						{
							
							cantidad=pcantidad;
							esperado=esperado+cantidad;			
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"Kg"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="SALCHICHA FRANK")
						{
							
							cantidad=pcantidad*15;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="SAL")
						{
							
							cantidad=pcantidad*15;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PIMIENTA")
						{
							
							cantidad=pcantidad*1.5;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="LECHE EN POLVO")
						{
							
							cantidad=pcantidad*50;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="FINAS HIERVAS")
						{
							
							cantidad=pcantidad*1;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="CEBOLLA MOLIDA")
						{
							
							cantidad=pcantidad*0.5;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AJO MOLIDO")
						{
							
							cantidad=pcantidad*0.5;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PROTEINA 90")
						{
							
							cantidad=pcantidad*40;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ALMIDON DE PAPA"||articulos2[j].nombre=="ALMIDON DE YUCA")
						{
							
							cantidad=pcantidad*50;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="NITRITO")
						{
							
							cantidad=pcantidad*0.2;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ANTIOXIDANTE"||articulos2[j].nombre=="INBAC MDA"||articulos2[j].nombre=="PRESERVAR")
						{
							
							cantidad=pcantidad*3;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="EXTRACTO LEV"||articulos2[j].nombre=="EXLV-RUN")
						{
							
							cantidad=pcantidad*10;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AGUA")
						{
							
							cantidad=pcantidad*220;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
					}
				}
		//		--------------------------------------------------------- FIN FORMULA SALCHICHA ALEMANA -----------------------------------------------------
		//		-------------------------------------------------- INICIO FORMULA HAMBURGUESA ----------------------------------------------------------
				if (selarticulo=="HAMBURGUESA 110"||selarticulo=="HAMBURGUESA 150"||selarticulo=="HAMBURGUESA 40"||selarticulo=="HAMBURGUESA 120")
				{
					for (var j=0;j<articulos2.length;j++)
					{
						console.log(articulos2[j]);
						if (articulos2[j].nombre=="CARNE DE RES")
						{
							
							cantidad=pcantidad;
							esperado=esperado+cantidad;			
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"Kg"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="HAMBURGUESA AL CARBON")
						{
							
							cantidad=pcantidad*5;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="SAL")
						{
							
							cantidad=pcantidad*9.5;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="MIGA DE PAN")
						{
							
							cantidad=pcantidad*50;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ERITORBATO")
						{
							
							cantidad=pcantidad*0.5;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PEREJIL"||articulos2[j].nombre=="PEREJIL FRESCO")
						{
							
							cantidad=pcantidad*1;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="CEBOLLA MOLIDA")
						{
							
							cantidad=pcantidad*5;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AJO MOLIDO")
						{
							
							cantidad=pcantidad*5;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PROTEINA 90")
						{
							
							cantidad=pcantidad*15;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ALMIDON DE PAPA"||articulos2[j].nombre=="ALMIDON DE YUCA")
						{
							
							cantidad=pcantidad*20;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="BARBECUE")
						{
							
							cantidad=pcantidad*15;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ANTIOXIDANTE"||articulos2[j].nombre=="INBAC MDA"||articulos2[j].nombre=="PRESERVAR")
						{
							
							cantidad=pcantidad*3;
							esperado=esperado+cantidad;					
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="EXTRACTO LEV"||articulos2[j].nombre=="EXLV-RUN")
						{
							
							cantidad=pcantidad*5;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AGUA")
						{
							
							cantidad=pcantidad*200;
							esperado=esperado+cantidad;							
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
					}
				}
		//		--------------------------------------------------------- FIN FORMULA HAMBURGUESA -----------------------------------------------------
		//			---------------------------------------------------- INICIO FORMULA MORCILLA ARGENTINA ----------------------------------------------- 
			if (selarticulo=="MORCILLA ARGENTINA")
				{
					for (var j=0;j<articulos2.length;j++)
					{
						console.log(articulos2[j]);
						if (articulos2[j].nombre=="CARNE DE CERDO")
						{
							
							cantidad=pcantidad;
							esperado=esperado+cantidad;			
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"Kg"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="GRASA")
						{
							
							cantidad=pcantidad*0.446;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"Kg"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="SAL")
						{
							
							cantidad=pcantidad*34.77;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PIMIENTA")
						{
							
							cantidad=pcantidad*3.48;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="PIMIENTA ROJA")
						{
							
							cantidad=pcantidad*16.23;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="COMINO")
						{
							
							cantidad=pcantidad*2.32;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="CEBOLLA DESHIDRATADA")
						{
							
							cantidad=pcantidad*40;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AGUA")
						{
							
							cantidad=pcantidad*80;
							esperado=esperado+cantidad;						
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ERITORBATO")
						{
							
							cantidad=pcantidad*4.40;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="NITRITO")
						{
							
							cantidad=pcantidad*0.44;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="ANTIOXIDANTE"||articulos2[j].nombre=="INBAC MDA")
						{
							
							cantidad=pcantidad*6.49;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="SANGRE SECA")
						{
							
							cantidad=pcantidad*146.55;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="AGUA")
						{
							
							cantidad=pcantidad*586.18;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"ml"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="NUEZ MOSCADA")
						{
							
							cantidad=pcantidad*2.32;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
						if (articulos2[j].nombre=="CILANTRO MOLIDO")
						{
							
							cantidad=pcantidad*1.16;
							esperado=esperado+cantidad;
							console.log(cantidad);
							subtotal[cont]=(cantidad*articulos2[j].costo_total);
							total=total+subtotal[cont];
							var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+articulos2[j].idarticulo+'">'+articulos2[j].nombre+'</td><td><input type="hidden" readonly name="cantidad[]" value="'+cantidad+'">'+cantidad+"g"+'</td><td><input type="number" readonly name="costo[]" value="'+articulos2[j].costo_total+'"></td><td>'+subtotal[cont]+'</td></tr>';
							cont++;
							limpiar();
							console.log(total);
							$("#total").html("$. "+total);
							$("#costo_produccion").val(total);
							evaluar();
							$('#detalles').append(fila);
							if(articulos2[j].stock<cantidad)
							{
								control[sum]=articulos2[j].nombre;
								sum++;
								console.log(sum);
							}
						}
					}
				}
			//		-------------------------------- FIN FORMULA MORCILLA ARGENTINA --------------------------------

			}	
			else if(controlstock==1){
				document.location.reload();
			}
			else
			{
				alert("LOS CAMPOS DE: PERSONAL, PRODUCCION, CANTIDAD A PRODUCIR Y PROCESO DEBEN ESTAR LLENOS");
			}
		}

		function mostrarValores()
		{

			datosArticulo=document.getElementById('pidarticulo').value.split('_');
			$("#pcosto").val(datosArticulo[2]);
			$("#pstock").val(datosArticulo[1]);
		}
		function agregar()
		{
			datosArticulo=document.getElementById('pidarticulo').value.split('_');

			idarticulo=datosArticulo[0];
			articulo=$("#pidarticulo option:selected").text();
			dcantidad=$("#pcantidad").val();
			console.log(dcantidad);
			costo=$("#pcosto").val();
			stock=$("#pstock").val(datosArticulo[1]);

			if(idarticulo!="" && dcantidad!="" && dcantidad>0 && costo!="")
				{
					if (stock >= dcantidad) 
					{
					esperado=esperado+dcantidad;
					subtotal[cont]=(dcantidad*costo);
					total=total+subtotal[cont];
					var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">x</button></td><td><input type="hidden" name="idarticulo[]" id="idarticulo'+cont+'" value="'+idarticulo+'">'+articulo+'</td><td><input type="text" name="cantidad[]" readonly value="'+dcantidad+'"></td><td><input type="number" name="costo[]" readonly value="'+costo+'"></td><td>'+subtotal[cont]+'</td></tr>';
					cont++;
					limpiar();
					$("#total").html("$. "+total);
					$("#costo_produccion").val(total);
					evaluar();
					$('#detalles').append(fila);
					}
					else
					{
						alert ('La cantidad a usar supera al stock');
					}
					
				}
			else
			{
				alert("ERROR AL INGRESAR UN INGREDIENTE, REVISE LOS DATOS DEL INGREDIENTE ESTEN LLENOS")
			}
		}
		function limpiar()
		{
			$("#pcantidad").val("");
			$("#pstock").val("");
			$("#pcosto").val("");
		}
		function evaluar()
		{
			if (total>0 && sum<1)
			{
				$("#guardar").show();
				$("#notas").hide();
			}
			else
			{
				$("#guardar").hide();
				$("#notas").show();

				console.log(sum);
				console.log(control[sum-1]);

				$("#nota").html("ERROR: debe eliminar el ingrediente "+control[sum-1]+". La cantidad supera al stock");
			}
		}
		function eliminar (index)
		{
			total=total-subtotal[index];
			$("#total").html("$. "+total);
			$("#costo_produccion").val(total);
			y=sum;
			for(x=0;x<y;x++)
			{
				console.log(control[x]);
				
				console.log($("#idarticulo"+index).parent().text());

				if($("#idarticulo"+index).parent().text()==control[x])
					sum--;
				console.log(sum);
			}
			$("#fila"+ index).remove();
			evaluar();
		}
	</script>
@endpush
@endsection