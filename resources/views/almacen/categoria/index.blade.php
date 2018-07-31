@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>LISTADO DE CATEGORIAS   <a href="categoria/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('almacen.categoria.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered tyable -condensed table-hover">
					<thead>
						<th>ID</th>
						<th>NOMBRE</th>
						<TH>DESCRIPCION</TH>
						@if (Auth::user()->tipo=='ADMIN')
						<th>OPCIONES</th>
						@endif
					</thead>
					@foreach ($categorias as $cat)
					<tr>
						<td>{{ $cat->idcategoria}}</td>
						<td>{{ $cat->nombre}}</td>
						<td>{{ $cat->descripcion}}</td>
						@if (Auth::user()->tipo=='ADMIN')
						<td>
							<a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info">EDITAR</button></a>
							<a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">ELIMINAR</button></a>
						</td>
						@endif
					</tr>
					@include('almacen.categoria.modal')
					@endforeach
				</table>
			</div>
			{{$categorias->render()}}
		</div>
	</div>
@endsection