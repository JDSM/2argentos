@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
			<h3>EDITAR CATEGORIA: {{ $categoria->nombre}}</h3>
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
			{!!Form::model($categoria,['url'=>['almacen/categoria',$categoria->idcategoria],'method'=>'PATCH'])!!}
			{{Form::token()}}
				<div class="form-group">
					<label for="nombre">NOMBRE</label>
					<input type="text" name="nombre" class="form-control" value="{{$categoria->nombre}}" placeholder="Nombre...">
				</div>
				<div class="form-group">
					<label for="descripcion">DESCRIPCION</label>
					<input type="text" name="descripcion" class="form-control" value="{{$categoria->descripcion}}" placeholder="Descripcion...">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="sumit">GUARDAR</button>
					<button class="btn btn-primary" type="reset">CANCELAR</button>
				</div>
			{!!form::close()!!}
		</div>
	</div>
@endsection