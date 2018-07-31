@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>NUEVO ARTICULO</h3>
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
{!!Form::open(array('url'=>'almacen/articulo', 'method'=>'POST', 'autocomplete'=>'off','files'=>'true'))!!}
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
			<lavel>CATEGORIA</lavel>
			<select name="idcategoria" class="form-control" >
				@foreach ($categorias as $cat)
				<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="codigo">CODIGO</label>
			<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo del Articulo...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="stock">STOCK</label>
			<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del Articulo...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="descripcion">DESCRIPCION</label>
			<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripcion del Articulo...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="imagen">IMAGEN</label>
			<input type="file" name="imagen" class="form-control" >
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