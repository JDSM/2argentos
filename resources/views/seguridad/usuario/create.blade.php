@extends('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>NUEVO USUARIO</h3>
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
		{!!Form::open(array('url'=>'seguridad/usuario', 'method'=>'POST', 'autocomplete'=>'off'))!!}
		{{Form::token()}}
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="name" class="col-md-4 control-label">NOMBRE</label>

			<div class="col-md-6">
				<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

				@if ($errors->has('name'))
				<span class="help-block">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<label for="email" class="col-md-4 control-label">E-MAIL</label>

			<div class="col-md-6">
				<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<label for="password" class="col-md-4 control-label">Password</label>

			<div class="col-md-6">
				<input id="password" type="password" class="form-control" name="password" required>

				@if ($errors->has('PASSWORD'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label for="password-confirm" class="col-md-4 control-label">CONFIRMAR PASSWORD</label>

			<div class="col-md-6">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
			</div>
		</div>
		<div class="form-group">
			<lavel for="tipo" class="col-md-4 control-label">TIPO USUARIO</lavel>
			<div class="col-md-6">
				<select name="tipo" class="form-control" required >
				<option value="ADMIN">ADMIN</option>
				<option value="NORMAL">NORMAL</option>
				<option value="CLIENTE">CLIENTE</option>
				</select>
			</div>
		</div>
		<div class="form-group">
		<lavel for="boton" class="col-md-4 control-label"></lavel>
			<div class="col-md-6">
			<button class="btn btn-primary" type="sumit">GUARDAR</button>
			<button class="btn btn-danger" type="reset">CANCELAR</button>
			</div>
		</div>
		{!!form::close()!!}
	</div>
</div>
@endsection