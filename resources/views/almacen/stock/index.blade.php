@extends('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>STOCK</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered tyable -condensed table-hover">
					<thead style="background-color: #A9D0F5">
						<th>ID</th>
						<th>NOMBRE</th>
						<th>CODIGO</th>
						<th>CATEGORIA</th>
						<th>STOCK</th>
						<th>IMAGEN</th>
						<th>ESTADO</th>
						<th>DESCRIPCION</th>
					</thead>
					@foreach ($articulos as $art)
					<tr>
						<td>{{ $art->idarticulo}}</td>
						<td>{{ $art->nombre}}</td>
						<td>{{ $art->codigo}}</td>
						<td>{{ $art->categoria}}</td>
						<td>{{ $art->stock}}</td>
						<td>
							<img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail">
						</td>
						<td>{{ $art->estado}}</td>
						<td>{{ $art->descripcion}}</td>
					</tr>
					@endforeach
				</table>
			</div>
			{{$articulos->render()}}
		</div>
	</div>
@endsection