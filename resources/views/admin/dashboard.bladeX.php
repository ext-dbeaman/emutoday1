@extends('admin.layouts.global')

@section('title', 'Dashboard')
@section('scripthead')
	          @parent
						<link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css">
						{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" /> --}}
							{{-- <script src="{{ '/js/ckeditor/ckeditor.js' }}"></script> --}}
	    @endsection
@section('content')
	<h1 class="text-center">Demo of vue-datetime-picker</h1>
	  <div class="container" id="app">
	    <demo :result1.sync="result1"
	          :start-datetime.sync="startDatetime"
	          :end-datetime.sync="endDatetime">
	    </demo>
	  </div>
@endsection
@section('footer')
    @parent
	{{-- <script type="text/javascript" src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.bootcss.com/moment.js/2.10.6/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="https://cdn.bootcss.com/moment-timezone/0.4.0/moment-timezone-with-data.min.js"></script>
  <script type="text/javascript" src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}
		{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}
	<script src="/js/vue-admin.js"></script>
	<script>

	@endsection
