@extends('layouts.auth')

@section('title', 'Login')

@section('style-plugin')
	@parent
	<!-- iCheck -->
<link rel="stylesheet" href="/themes/adminlte/plugins/iCheck/square/blue.css">
@endsection


@section('content')

	<div class="login-box">
  <div class="login-logo">
    <h3>ADMIN EMU-TODAY</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
  {!! Form::open() !!}

      <div class="form-group has-feedback">
				{!! Form::label('email') !!}
				{!! Form::text('email', null) !!}
        {{-- <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span> --}}
      </div>
      <div class="form-group has-feedback">
				{!! Form::label('password') !!}
				{!! Form::password('password') !!}
        {{-- <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span> --}}
      </div>
      <div class="form-group">
				{{-- <input id="show-password" type="checkbox"><label for="show-password">Show password</label> --}}
		 {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
		 <p class="text-center"><a href="{{ route('auth.password.email') }}">Forgot your password?</a></p>
			</div>
			{!! Form::close() !!}

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
	@section('footer-plugin')
		<!-- iCheck -->
		<script src="/themes/adminlte/plugins/iCheck/icheck.min.js"></script>
		@parent
	@endsection
@section('footer-script')
	@parent
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@endsection
