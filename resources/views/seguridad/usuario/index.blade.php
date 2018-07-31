@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>LISTADO DE USUARIO  <a href="usuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('seguridad.usuario.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered tyable -condensed table-hover">
					<thead>
						<th>ID</th>
						<th>NOMBRE</th>
						<TH>EMAIL</TH>
						@if (Auth::user()->tipo=='ADMIN')
						<th>OPCIONES</th>
						@endif
					</thead>
					@foreach ($usuarios as $usu)
					<tr>
						<td>{{ $usu->id}}</td>
						<td>{{ $usu->name}}</td>
						<td>{{ $usu->email}}</td>
						@if (Auth::user()->tipo=='ADMIN')
						<td>
							<a href="{{URL::action('UsuarioController@edit',$usu->id)}}"><button class="btn btn-info">EDITAR</button></a>
							<a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button class="btn btn-danger">ELIMINAR</button></a>
						</td>
						@endif
					</tr>
					@include('seguridad.usuario.modal')
					@endforeach
				</table>
			</div>
			{{$usuarios->render()}}
		</div>
	</div>
@endsection