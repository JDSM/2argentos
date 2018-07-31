@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>EDITAR USUARIO: {{ $usuario->name}}</h3>
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
		{!!Form::model($usuario,['url'=>['seguridad/usuario',$usuario->id],'method'=>'PATCH'])!!}
		{{Form::token()}}
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			<label for="name" class="">NOMBRE</label>

			<div class="">
				<input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name}}" required autofocus>

				@if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>
		</div>
		
		<div class="">
			<div class="form-group">
				<lavel class="">TIPO</lavel>
				<select name="tipo" class="form-control" >
					<option value="{{$usuario->tipo}}" selected>{{$usuario->tipo}}</option>
					@if($usuario->tipo!="ADMIN")<option value="ADMIN">ADMIN</option>@endif
					@if($usuario->tipo!="NORMAL")<option value="NORMAL">NORMAL</option>@endif
					@if($usuario->tipo!="CLIENTE")<option value="CLIENTE">CLIENTE</option>@endif
				
				</select>
			</div>
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<label for="password" class="">Password</label>

			<div class="">
				<input id="password" type="password" class="form-control" name="password" required>

				@if ($errors->has('PASSWORD'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label for="password-confirm" class="">CONFIRMAR PASSWORD</label>

			<div class="">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="sumit">GUARDAR</button>
			<button class="btn btn-danger" type="reset">CANCELAR</button>
		</div>
		{!!form::close()!!}
	</div>
</div>
@endsection