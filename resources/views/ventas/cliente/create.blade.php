@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>NUEVO CLIENTE</h3>
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
{!!Form::open(array('url'=>'ventas/cliente', 'method'=>'POST', 'autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">NOMBRE</label>
			<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="direccion">DIRECCION</label>
			<input type="text" name="direccion"  value="{{old('direccion')}}" class="form-control" placeholder="Direccion...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<lavel>DOCUMENTO</lavel>
			<select name="tipo_documento" class="form-control" >
				<option value="CI">CI</option>
				<option value="CE">CE</option>
				<option value="NIT">NIT</option>
				<option value="PAS">PAS</option>
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="num_documento">NUMERO DOCUMENTO</label>
			<input type="text" name="num_documento" required value="{{old('num_documento')}}" class="form-control" placeholder="Numero del Documento de Identidad...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">TELEFONO</label>
			<input type="text" name="telefono"  value="{{old('telefono')}}" class="form-control" placeholder="Numero Telefonico...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="email">EMAIL</label>
			<input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<button class="btn btn-primary" type="sumit">GUARDAR</button>
			<button class="btn btn-danger" type="reset">CANCELAR</button>
		</div>
	</div>
</div>

{!!form::close()!!}
@endsection