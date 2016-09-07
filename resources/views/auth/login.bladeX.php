@extends('layouts.auth')

@section('title', 'Login')

@section('style-plugin');
	@parent
	<!-- iCheck -->
<link rel="stylesheet" href="/themes/adminlte/plugins/iCheck/square/blue.css">
@endsection


@section('content')
  <div class="row">
    <div class="medium-6 medium-centered large-4 large-centered columns">
    {!! Form::open() !!}
  <div class="row column log-in-form">
    <h4 class="text-center">Log in with you user account</h4>
        <label>
       {!! Form::label('email') !!}
       {!! Form::text('email', null) !!}
</label>
       <label>
       {!! Form::label('password') !!}
       {!! Form::password('password') !!}
       </label>
       <input id="show-password" type="checkbox"><label for="show-password">Show password</label>
   {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
  <p class="text-center"><a href="{{ route('auth.password.email') }}">Forgot your password?</a></p>

   {!! Form::close() !!}
   </div>
@endsection


  </div>
</div>
