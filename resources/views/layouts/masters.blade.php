@extends('layouts.master')

@section('title', 'MAIN TITLE')

@section('head')
    @include('public.layouts.styles')
    @include('public.layouts.scriptshead')
  
@endsection


@section('offcanvas')
    @include('layouts.partials.offcanvas')
@endsection

@section('topbar')
    @include('layouts.partials.topbar')
@endsection

@section('content')
<p>
    Content Content  Content Content Content Content Content Content Content
    Content Content Content Content Content Content Content  Content Content 
    Content Content Content Content Content Content Content Content Content
    Content Content Content  Content Content Content Content Content Content 
    Content Content Content Content Content Content Content Content  Content
    Content Content Content Content Content Content Content Content Content 
    Content Content Content Content  Content Content Content Content Content
    Content Content Content Content Content Content Content Content Content  
    Content Content Content Content Content Content Content Content Content
    Content Content Content Content Content  Content Content Content Content 
    Content Content Content Content Content Content Content Content Content
    Content  Content Content Content Content Content Content Content Content 
    Content Content Content Content 
</p>

@endsection

  @section('bottombar')
      @include('layouts.partials.bottombar')
  @endsection

  @section('footer')
     @include('admin.layouts.scriptsfooter')

  @endsection
