@extends('admin.layouts.adminlte')
@section('title', $mediatype->exists ? 'Editing MediaType' : 'Create New MediaType')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
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
	@endsection

	@section('style-app')
		@parent
	@endsection
	@section('scripthead')
		@parent
	@endsection

	@section('content')

		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">{{$mediatype->exists ? 'Editing MediaType': 'Create New MediaType'}}</h3>
							@include('admin.layouts.components.boxtools', ['rte' => 'mediatype', 'path' => 'admin/mediatype'])

						</div>
						<div class="box-body">

						{!! Form::model($mediatype,[
							'method' => $mediatype->exists ? 'put' : 'post',
							'route' => $mediatype->exists ? ['admin.mediatype.update', $mediatype->id] : ['admin.mediatype.store']
							]) !!}
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('group') !!}
										{!! Form::text('group', null, ['class' => 'form-control']) !!}
									</div>
								</div><!-- /.col-md-4 -->
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::label('type') !!}
										{!! Form::text('type', null, ['class' => 'form-control']) !!}
									</div>
								</div><!-- /.col-md-4 -->
								<div class="col-md-4">
									@if($mediatype->exists)
									<div class="form-group">
										{!! Form::label('name') !!}
										{!! Form::text('name', null, ['class' => 'form-control', 'readonly'=>'readonly']) !!}
									</div>
								@endif
								</div><!-- /.col-md-4 -->

							</div><!-- /.row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
											{!! Form::label('is_required','Required', ['class'=>'text-center']) !!}
											<div class="row">
										<div class="col-md-4">
											{!! Form::radio('is_required', 1, $mediatype->is_required,['class' => 'form-control', 'id'=>'is-required-yes']) !!}  {!! Form::label('is_required', 'yes') !!}
												</div><!-- /.col-md-4 -->
												<div class="col-md-4">
											{{ Form::radio('is_required', 0, $mediatype->is_required,['class' => 'form-control', 'id'=>'is-required-no']) }}  {!! Form::label('is_required', 'no') !!}
												</div><!-- /.col-md-4-->
										</div><!-- /.row -->
									</div><!-- /.form-group-->
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										{!! Form::label('width') !!}
										{!! Form::number('width', null, ['class' => 'form-control']) !!}
									</div>
								</div><!-- /.col-md-6 -->
								<div class="col-md-6">
									<div class="form-group">
										{!! Form::label('height') !!}
										{!! Form::number('height', null, ['class' => 'form-control']) !!}
									</div>
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										{!! Form::label('infotxt') !!}
										{!! Form::text('infotxt', null, ['class' => 'form-control']) !!}
									</div>
									<div class="form-group">
										{!! Form::label('helptxt') !!}
										{!! Form::text('helptxt', null, ['class' => 'form-control']) !!}
									</div>
									<div class="form-group">
										{!! Form::label('rules') !!}
										{!! Form::text('rules', null, ['class' => 'form-control']) !!}
									</div>
									<div class="form-group">
										{!! Form::label('notes') !!}
										{!! Form::text('notes', null, ['class' => 'form-control']) !!}
									</div>
								</div><!-- /.col-md-12 -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->
						<div class="box-footer">
									{!! Form::submit($mediatype->exists ? 'Save MediaType' : 'Create New MediaType', ['class' => 'btn btn-primary pull-right']) !!}
									{!! Form::close() !!}
						</div><!-- /.box-footer -->
					</div><!-- /.box -->
			</div><!--	/.col-sm-12 -->
		</div><!--/.row -->
@endsection

@section('footer-vendor')
	@parent
	{{-- <!-- jQuery 2.2.0 -->
	<script src="/themes/adminlte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="/themes/adminlte/bootstrap/js/bootstrap.min.js"></script> --}}
@endsection
@section('footer-plugin')
	@parent
	<!-- Select2 -->
	<script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="/themes/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="/themes/admin-lte/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap time picker -->
	<script src="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	{{-- <script src="/themes/admin-lte/js/app.min.js"></script> --}}
	<!-- AdminLTE for demo purposes -->
	{{-- <script src="/themes/admin-lte/js/demo.js"></script> --}}
@endsection
@section('footer-app')
	@parent
@endsection

@section('footer-script')
    @parent
<!-- Page script -->
			<script>
			  $(function () {
			    //Initialize Select2 Elements
			    $(".select2").select2();


			    //iCheck for checkbox and radio inputs
			    $('input[type="checkbox"], input[type="radio"]').iCheck({
			      checkboxClass: 'icheckbox-blue',
			      radioClass: 'iradio-blue'
			    });




			  });
			</script>
	@endsection
