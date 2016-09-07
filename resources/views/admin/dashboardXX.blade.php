@extends('admin.layouts.adminlte')

@section('title', 'Dashboard')
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
						<div class="box box-default">
	        		<div class="box-header with-border">
	          		<h3 class="box-title">Story Queue</h3>
	          		<div class="box-tools pull-right">
	            		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	          		</div>
	        		</div><!-- /.box-header -->
							<div class="box-body">
								<table id="main-story-table" class="table table-bordered table-hover">
									<thead>
										<tr>
		                <th class="text-center">ID</th>
										<th class="text-left">Type</th>
		                <th class="text-left">Title</th>
										<th class="text-center">Featured</th>
										<th class="text-center">Approved</th>
										<th class="text-left">Live</th>
										<th class="text-left">Start Date</th>
										<th class="text-left">End Date</th>
										<th class="text-left">Edit</th>
										<th class="text-left">Delete</th>
		            	</tr>
							</thead>
						</table>
						{{-- {!! $storys->render() !!} --}}
						{{-- {{ $storys->links() }} --}}
					</div>
					<!-- /.box-body -->
	        <div class="box-footer">
	        </div>
	      </div><!-- /.box -->

				<div class="box box-danger">
	            <div class="box-header">
	              <h3 class="box-title">Announcement Queue</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
	            </div>
	            <div class="box-body">
								<div class="box-body">
									<table id="main-announcement-table" class="table table-bordered table-hover">
										<thead>
											<tr>
					                <th class="text-center">ID</th>
					                <th class="text-left">Title</th>
													<th class="text-center">Approved</th>
													  <th class="text-center">Promoted</th>
														<th class="text-left">Start Date</th>
														<th class="text-left">End Date</th>
													<th class="text-left">Edit</th>
													<th class="text-left">Delete</th>
					            </tr>
										</thead>

									</table>
									{{-- {!! $storys->render() !!} --}}
									{{-- {{ $storys->links() }} --}}
								</div>
								<!-- /.box-body -->
	            </div>
	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
						<div class="box box-danger">
									<div class="box-header">
										<h3 class="box-title">Event Queue</h3>
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										</div>
									</div>
									<div class="box-body">
										<div class="box-body">
											<table id="main-event-table" class="table table-bordered table-hover">
												<thead>
													<tr>
															<th class="text-center">ID</th>
															<th class="text-left">Title</th>
															<th class="text-center">Featured</th>
															<th class="text-left">Approved</th>
															<th class="text-center">Canceled</th>
															<th class="text-left">Promoted</th>
															<th class="text-left">Start Date</th>
															<th class="text-left">End Date</th>
															<th class="text-left">Edit</th>
															<th class="text-left">Delete</th>
													</tr>
												</thead>

											</table>
											{{-- {!! $storys->render() !!} --}}
											{{-- {{ $storys->links() }} --}}
										</div>
										<!-- /.box-body -->
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->

@endsection
@section('footer-vendor')
	@parent
	{{-- <!-- jQuery 2.2.0 -->
	<script src="/themes/admin-lte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="/themes/admin-lte/bootstrap/js/bootstrap.min.js"></script> --}}
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

			  $(function () {

					var table_story = $('#main-story-table').DataTable({
						"ajax": "/api/story",
						"columns": [
							{"data": "id"},
							{"data": "type"},
							{"data": "title"},
							{"data": "featured"},
							{"data": "approved",
									"render": function ( data, type, row ) {
										var checkpart = (data == 1)? 'checked="checked"': '';
										return '<input type="checkbox" class="flat-red" name="id' + row.id+'" value=1 ' + checkpart + '>';

												}
											},
							{"data": "live"},
							{"data": "start_date"},
							{"data": "end_date"},
							{"date": null,
								"defaultContent": "<i class='fa fa-pencil'></i>"
							},
							{"date": null,
								"defaultContent": "<i class='fa fa-trash'></i>"
							}
						]
					});

					var table_announce = $('#main-announcement-table').DataTable({
						"ajax": "/api/announcement",
						"columns": [
							{"data": "id"},
							{"data": "title"},
							{"data": "approved",
			 						"render": function ( data, type, row ) {
										var checkpart = (data == 1)? 'checked="checked"': '';
										return '<input type="checkbox" class="flat-red" name="id' + row.id+'" value=1 ' + checkpart + '>';

												}
											},
							{"data": "promoted"},
							{"data": "start_date"},
							{"data": "end_date"},
							{"date": null,
								"defaultContent": "<i class='fa fa-pencil'></i>"
							},
							{"date": null,
								"defaultContent": "<i class='fa fa-trash'></i>"
							}
						]
					});

					var table_event = $('#main-event-table').DataTable({
						"ajax": "/api/event",
						"columns": [
							{"data": "id"},
							{"data": "title"},
							{"data": "featured"},
							{"data": "approved",
									"render": function ( data, type, row ) {
										var checkpart = (data == 1)? 'checked="checked"': '';
										return '<input type="checkbox" class="flat-red" name="id' + row.id+'" value=1 ' + checkpart + '>';

												}
											},
							{"data": "canceled"},
							{"data": "promoted"},
							{"data": "start_date"},
							{"data": "end_date"},
							{"date": null,
								"defaultContent": "<i class='fa fa-pencil'></i>"
							},
							{"date": null,
								"defaultContent": "<i class='fa fa-trash'></i>"
							}
						]
					});
					console.log(table_event.order());
					table_event.order([6, 'desc']).draw();
					console.log(table_event.order());
			    //Initialize Select2 Elements
			    $(".select2").select2();

			    //Datemask dd/mm/yyyy
			    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
			    //Datemask2 mm/dd/yyyy
			    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			    //Money Euro
			    $("[data-mask]").inputmask();

			    //Date range picker
			    $('#reservation').daterangepicker();
			    //Date range picker with time picker
			    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
			    //Date range as a button
			    $('#daterange-btn').daterangepicker(
			        {
			          ranges: {
			            'Today': [moment(), moment()],
			            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			            'This Month': [moment().startOf('month'), moment().endOf('month')],
			            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			          },
			          startDate: moment().subtract(29, 'days'),
			          endDate: moment()
			        },
			        function (start, end) {
			          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			        }
			    );

			    //Date picker
			    $('#datepicker').datepicker({
			      autoclose: true
			    });

			    //iCheck for checkbox and radio inputs
			    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			      checkboxClass: 'icheckbox_minimal-blue',
			      radioClass: 'iradio_minimal-blue'
			    });
			    //Red color scheme for iCheck
			    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			      checkboxClass: 'icheckbox_minimal-red',
			      radioClass: 'iradio_minimal-red'
			    });
			    //Flat red color scheme for iCheck
			    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			      checkboxClass: 'icheckbox_flat-green',
			      radioClass: 'iradio_flat-green'
			    });

			    //Colorpicker
			    $(".my-colorpicker1").colorpicker();
			    //color picker with addon
			    $(".my-colorpicker2").colorpicker();

			    //Timepicker
			    $(".timepicker").timepicker({
			      showInputs: false
			    });

			  });
			</script>
	@endsection
