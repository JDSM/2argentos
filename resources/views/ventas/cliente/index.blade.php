@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>LISTADO DE CLIENTES  <a href="cliente/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('ventas.cliente.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered tyable -condensed table-hover">
					<thead>
						<th>ID</th>
						<th>NOMBRE</th>
						<th>TIPO DOC.</th>
						<th>NUMERO DE DOC.</th>
						<th>TELEFONO</th>
						<th>EMAIL</th>
						@if (Auth::user()->tipo=='ADMIN')
						<th>OPCIONES</th>
						@endif
					</thead>
					@foreach ($personas as $per)
					<tr>
						<td>{{ $per->idpersona}}</td>
						<td>{{ $per->nombre}}</td>
						<td>{{ $per->tipo_documento}}</td>
						<td>{{ $per->num_documento}}</td>
						<td>{{ $per->telefono}}</td>
						<td>{{ $per->email}}</td>
						@if (Auth::user()->tipo=='ADMIN')
						<td>
							<a href="{{URL::action('ClienteController@edit',$per->idpersona)}}"><button class="btn btn-info">EDITAR</button></a>
							<a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">ELIMINAR</button></a>
						</td>
						@endif
					</tr>
					@include('ventas.cliente.modal')
					@endforeach
				</table>
			</div>
			{{$personas->render()}}
		</div>
	</div>
@endsection