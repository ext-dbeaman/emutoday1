@extends('admin.layouts.adminlte')
@section('title', 'Announcement')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<!-- DataTables -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">
	@endsection
	@section('style-app')
		@parent
	@endsection
@section('content')
	@include('admin.layouts.modal')
	<div class="box">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Announcement List</h3>
				@include('admin.layouts.components.boxtools', ['rte' => 'announcement', 'path' => 'admin/announcement'])
			</div>	<!-- /.box-header -->

						{{-- @if(isset($announcements))
						<div class="input-group input-group-sm pull-left" style="width: 150px;">
							<input type="text" name="table_search" class="form-control" placeholder="Search">

							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
						@endif
						<div class="btn-group btn-group-sm pull-right">
							<a href="{{ route('admin.announcement.create') }}" class="btn bg-orange"><i class="fa fa-plus-square"></i></a>
						</div><!-- /.btn-group --> --}}



	@if(isset($announcements))

		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">

				<tr>
					<th class="text-center">ID</th>
					<th class="text-left">Title</th>
					<th class="text-center">Aprroved</th>
				
					<th class="text-left">Start Date</th>
					<th class="text-left">End Date</th>
					<th class="text-center">Preview</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
				</tr>
				<tr>

					@foreach($announcements as $announcement)
							<tr>
								<td>
										{{ $announcement->id }}
								</td>
									<td>{{ $announcement->title }}</td>
									<td><i class='fa {{$announcement->is_approved == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>
									<td><i class='fa {{$announcement->is_promoted == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>
									<td>{{ $announcement->start_date }}</td>
									<td>{{ $announcement->end_date }}</td>
									<td>
											<a href="{{ route('admin.announcement.show', $announcement->id) }}">
												<i class="fa fa-eye"></i>

											</a>
									</td>
									<td>
											<a href="{{ route('admin.announcement.edit', $announcement->id) }}">
												<i class="fa fa-pencil"></i>

											</a>
									</td>
									<td>
											<i class="fa fa-trash"></i>
											{{-- <a href="{{ route('admin.role.confirm', $permission->id) }}">
																<i class="fa fa-trash"></i>
											</a> --}}
									</td>
							</tr>
					@endforeach
				@endif
				</tr>

			</table>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->




@endsection
@section('footer-plugin')
	@parent
	<script src="/themes/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
@endsection



@section('footer-script')
	@parent




	@endsection
