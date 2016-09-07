<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')  Admin EMU</title>
    @section('style')
          @include('admin.layouts.styles')
    @show
    @section('scripthead')
          @include('admin.layouts.scriptshead')
    @show
    @include('include.js')
  </head>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">EMU-TODAY</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
				<li><a href="/admin/users">Users</a></li>
				<li><a href="/admin/story">Story List</a></li>
				<li><a href="/admin/storyimages">Images</a></li>
				<li><a href="/admin/page">Pages</a></li>
				<li><a href="/admin/magazine">Magazine</a></li>
				<li><a href="/admin/announcement">Announcements</a></li>
				<li><a href="/admin/event">Events</a></li>
				<li><a href="/admin/twitter">Twitter</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $admin->last_name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<body>
<div class="container-fluid">
		@include('flash::message')
		@include('admin/partials.errors')
		@yield('content')
</div>
@section('footer')
	@include('admin.layouts.scriptsfooter')

@show
</body>
</html>
