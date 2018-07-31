@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
			<h3>EDITAR ARTICULO: {{ $articulo->nombre}}</h3>
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
			{!!Form::model($articulo,['url'=>['almacen/articulo',$articulo->idarticulo],'method'=>'PATCH','file'=>'true'])!!}
			{{Form::token()}}
				<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">NOMBRE</label>
			<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<lavel>CATEGORIA</lavel>
			<select name="idcategoria" class="form-control" >
				@foreach ($categorias as $cat)
				@if ($cat->idcategoria==$articulo->idcategoria)
				<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
				@else
				<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="codigo">CODIGO</label>
			<input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="stock">STOCK</label>
			<input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="descripcion">DESCRIPCION</label>
			<input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripcion del Articulo...">
		</div>
	</div>
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="imagen">IMAGEN</label>
			<input type="file" name="imagen" class="form-control" >
			@if (($articulo->imagen)!="")
				<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="150px" width="150px">
			@endif
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