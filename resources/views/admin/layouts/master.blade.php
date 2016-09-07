<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')  &mdash; EMU</title>
    @section('style')
          @include('admin.layouts.styles')
    @show
    @section('scripthead')
          @include('admin.layouts.scriptshead')
    @show
    @include('include.js')
  </head>

  <body>
    <div class="top-bar">
      <div class="top-bar-title">
        <ul class="menu">
          <li><span class="navbar-text">Hello, {{ $admin->last_name }}</span></li>
          <li><a href="{{ route('auth.logout') }}">Logout</a></li>
        </ul>
      </div> <!--  top-bar-title -->
      <div class="top-bar-right">
        <ul class="menu">
          <li><a href="/admin/dashboard">Dashboard</a></li>
          <li><a href="/admin/users">Users</a></li>
          <li><a href="/admin/story">Story List</a></li>
          <li><a href="/admin/storyimages">Images</a></li>
          <li><a href="/admin/page">Pages</a></li>
          <li><a href="/admin/magazine">Magazine</a></li>
          <li><a href="/admin/announcement">Announcements</a></li>
          <li><a href="/admin/event">Events</a></li>
          <li><a href="/admin/twitter">Twitter</a></li>
        </ul>
      </div> <!-- top-bar-right -->

    </div> <!--  top-bar -->
<div class="container row column">
      @include('flash::message')
      @include('admin/partials.errors')
      @yield('content')
  </div>
  @section('footer')
    @include('admin.layouts.scriptsfooter')

  @show
</body>
</html>
