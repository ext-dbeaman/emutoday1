@extends('admin.layouts.adminlte')
@section('title', $announcement->exists ? 'Editing '.$announcement->title : 'Create New Announcement')
@section('style-plugin')
	@parent
		<!-- daterange picker -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/datepicker/datepicker3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

<link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		@endsection
		@section('scripthead')
					{{-- @include('admin.layouts.scriptshead') --}}
		@show
		@include('include.js')
@section('content')
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Announcement Edit</h3>
			</div>	<!-- /.box-header -->
			<div class="box-body">
    {!! Form::model($announcement, [
        'method' => $announcement->exists ? 'put' : 'post',
        'route' => $announcement->exists ? ['admin.announcement.update', $announcement->id] : ['admin.announcement.store']
    ]) !!}
    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('announcement') !!}
        {!! Form::textarea('announcement', null, ['class' => 'form-control htmlwysiwyg']) !!}
    </div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
							{!! Form::label('start_date') !!}
							{!! Form::text('start_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-start-date']) !!}
						</div>
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="form-group">
							{!! Form::label('end_date') !!}
								{!! Form::text('end_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-end-date']) !!}
						</div>
					</div><!-- /.col-md-3 -->
				<div class="col-md-2">
				<div class="form-group">

						{!! Form::label('is_approved','Approved?', ['class'=>'text-center']) !!}


					<div class="row">
					<div class="col-md-4">
								{{ Form::radio('is_approved', 1) }} {!! Form::label('is_approved', 'yes') !!}
							</div><!-- /.form-group-->
							<div class="col-md-4">
								{{ Form::radio('is_approved', 0) }}  {!! Form::label('is_approved', 'no') !!}
							</div><!-- /.form-group-->
					</div><!-- /.row -->

		</div><!-- /.form-group -->
				</div><!-- /.col-md-4 -->
				<div class="col-md-2">
							<div class="form-group">
						{!! Form::label('is_promoted') !!}
						<div class="row">
							<div class="col-md-4">
								{!! Form::radio('is_promoted', 1) !!}  {!! Form::label('is_promoted', 'yes') !!}
							</div><!-- /.col-md-6 -->
							<div class="col-md-4">
								{!! Form::radio('is_promoted', 0) !!}  {!! Form::label('is_promoted', 'no') !!}
							</div><!-- /.col-md-6 -->
						</div><!-- /.row -->
					</div><!-- /.form-group -->
				</div><!-- /.col-md-4 -->
				<div class="col-md-2">
					<div class="form-group">
						{!! Form::submit($announcement->exists ? 'Save Announcement' : 'Create New Announcement', ['class' => 'btn btn-success pull-right']) !!}

						{!! Form::close() !!}
					</div>
				</div><!-- /.col-md-2 -->



			</div><!-- /.row form-inline -->

    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection
@section('footer-vendor')
	@parent
@endsection
@section('footer-plugin')
	{{-- <script src="/js/admintools.js"></script> --}}

	@parent
	@endsection
@section('footer-app')
@parent
@endsection
@section('footer-script')
		@parent
		<!-- Bootstrap WYSIHTML5 -->
<script src="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<script>
			$(function () {
				  $(".htmlwysiwyg").wysihtml5();
					//Date picker
					// $('.datetimepicker').datetimepicker({
					// 	format: 'YYYY-MM-DD HH:mm:ss'
					// 	});
					});

		</script>
	@endsection
