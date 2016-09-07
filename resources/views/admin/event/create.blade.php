@extends('admin.layouts.adminlte')
@section('title', $event->exists ? 'Editing '.$event->title : 'Create New Event')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<!-- DataTables -->
<link rel="stylesheet" href="/themes/adminlte/plugins/datatables/dataTables.bootstrap.css">
	@endsection

	@section('style-app')
		@parent
	@endsection

@section('content')
  @section('scripthead')
  @endsection
@section('content')
	<!-- Main content -->
	<section class="content">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Event</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						{!! csrf_field() !!}
						<div id="vueapp">
							<eventform></eventform>
						</div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
	</section>

@endsection

@section('footer-plugin')
	@parent

@endsection


@section('footer-script')
	@parent
	<script type="text/javascript" src="/js/main-form.js"></script>
@endsection
