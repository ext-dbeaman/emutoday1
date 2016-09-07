<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')  &mdash; EMU</title>
    @include('layouts.style')
    @include('layouts.headscripts')
  </head>

  <body>
  <div class="top-bar" id="dash-menu">
      <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
          <li class="menu-text">EMU TODAY</li>
          <li><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
          <li><a href="{{ route('backend.users.index') }}">Users</a></li>
          <li><a href="{{ route('backend.story.index') }}">Story Posts</a></li>
          <li><a href="{{ route('backend.storyimages.index') }}">Story Images</a></li>
        </ul>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <li><span class="navbar-text">Hello, {{ $admin->name }}</span></li>
          <li><a href="{{ route('auth.logout') }}">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <div class="row">

          <h3>@yield('title')</h3>
            @if($errors->any())
              <div class="callout alert">
                <strong>We found some errors!</strong>
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if($status)
              <div class="callout primary">
                {{ $status }}
              </div>
            @endif



              @yield('content')

            </div>
      </div>
            @include('layouts.footscripts')
  </body>
</html>
