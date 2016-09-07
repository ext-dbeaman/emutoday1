<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')Admin EMU</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	@section('style-vendor')
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="{{ elixir('css/admin-styles.css') }}" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	@show

	@section('style-plugin')
	@show

	@section('style-app')
		<!-- Theme style -->
		<link rel="stylesheet" href="/themes/adminlte/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
					page. However, you can choose any other skin. Make sure you
					apply the skin class to the body tag so the changes take effect.
		-->
		<link rel="stylesheet" href="/themes/adminlte/css/skins/skin-green.min.css">
	@show
	@section('scripthead')
				{{-- @include('admin.layouts.scriptshead') --}}
	@show
	@include('include.js')
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	</head>
<body>
  <div class="container">
    <div class="row vertical-center">
      <div class="col-md-2"></div>
      <div class="col-md-6">
          <div class="panel panel-{{ $errors->any() ? 'danger' : 'default'}}">
        <div class="panel-heading">
          <h2 class="panel-title">@yield('heading')</h2>
        </div>
        <div class="panel-body">
            @if($errors->any())
                                <div class="alert alert-danger">
                                    <strong>We found some errors!</strong>

                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($status)
                                <div class="alert alert-info">
                                    {{ $status }}
                                </div>
                            @endif
            @yield('content')


        </div>
      </div></div>
      <div class="col-md-2"></div>
    </div>
  </div>
	@section('footer-vendor')
		<script src="{{ elixir('js/vendor-scripts.js') }}"></script>
	@show
	@section('footer-plugin')

	@show
	@section('footer-app')
		<script>
	var AdminLTEOptions = {
		//Enable sidebar expand on hover effect for sidebar mini
		//This option is forced to true if both the fixed layout and sidebar mini
		//are used together
		sidebarExpandOnHover: false,
		//BoxRefresh Plugin
		enableBoxRefresh: true,
		//Bootstrap.js tooltip
		enableBSToppltip: true
	};
	</script>
	<script src="/themes/adminlte/js/app.js" type="text/javascript"></script>
	@show
	@section('footer-script')

	@show
	</body>

</body>
</html>
