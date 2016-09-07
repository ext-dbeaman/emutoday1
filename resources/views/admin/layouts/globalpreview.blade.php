<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('public.layouts.styles')
    @include('public.layouts.scriptshead')
    @include('include.js')
  </head>
  <body>

<!-- ************* CONTENT-AREA ********** -->
					<div id="content-area">
						@yield('content')
					</div><!-- #content-area -->

		@include('public.layouts.scriptsfooter')
	</body>
