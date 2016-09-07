@extends('admin.layouts.adminlte')
@section('title', 'Twitter Admin')
	@section('style-vendor')
		@parent
	@endsection
	@section('style-plugin')
		@parent
		<!-- DataTables -->
	<link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">

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
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Admin List of Tweets</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						@include('admin.twitter.list-admin')
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-md-6 -->
			<div class="col-md-6">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Twitter</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
				<div class="twitter-feed">
			 	 <ul class="twitter-content">
			 				 @foreach($tweets as $tweet)
			 					 <li><a href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id }}">{{ '@' . $tweet->user_screen_name }}</a> {{ $tweet->tweet_text }}</li>
			 				 @endforeach
			 		 </ul>
			 		 <div class="twitterlink">
			 				 <p><a href="http://emich.edu/twitter">See all EMU Twitter Feeds</a></p>
			 		 </div>
			 </div>
		 </div><!-- /.box-body -->
	 </div><!-- /.box -->
			</div><!-- /.col-md-6 -->
		</div><!-- /.row -->
	</section>
@endsection
@section('footer-vendor')
	@parent
	<!-- jQuery 2.2.0 -->
	<script src="/themes/admin-lte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="/themes/admin-lte/bootstrap/js/bootstrap.min.js"></script>
@endsection
@section('footer-plugin')
	@parent
	<script src="/themes/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
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
			</script>
@endsection
