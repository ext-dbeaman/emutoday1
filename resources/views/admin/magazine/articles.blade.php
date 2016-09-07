@extends('admin.layouts.adminlte')
@section('title', 'Articles')
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
					<div class="box-header">
						<h3 class="box-title">Article List</h3>
						@include('admin.layouts.components.boxtools', ['rte' => 'article', 'path' => 'admin/magazine/article', 'cuser'=>$currentUser])
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="main-article-table" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-left">Type</th>
									<th class="text-left">Title</th>
									<th class="text-center">Featured</th>
									<th class="text-center">Approved</th>
									<th class="text-center">Live</th>
									<th class="text-left">Start Date</th>
									<th class="text-left">End Date</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
		            </tr>
							</thead>

						</table>
						{{-- {!! $storys->render() !!} --}}
						{{-- {{ $storys->links() }} --}}
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

{{--
			<label id="stype-filter" for="stype">Filter By Type:
		{!! Form::select('stype', $stypes, $stype, ['id'=> 'stype1', 'class' => 'form-control input-sm']) !!}

		</label> --}}
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
	<script>


		$(function () {
			/* Custom filtering function which will search data in column four between two values */
			// $.fn.dataTable.ext.search.push(
			// function( settings, data, dataIndex ) {
			// 	var stypefilter = $('#stype1').val();
			// 	console.log(stypefilter);
			// 	var stype = data[1]; // use data for the stype column
			// 	if (stypefilter == 'all') {
			// 		return true
			// 	} else {
			// 		if ( stypefilter == stype)
			// 		{
			// 			return true;
			// 		}
			// 	return false;
			// }
			// }
			// );
			var table = $('#main-article-table').DataTable({
				"ajax": "/api/magazine/articles/",
				"columns": [
					{"data": "id"},
					{"data": "type"},
					{"data": "title"},
					{"data": "featured",
							"render": function ( data, type, row ) {
								var checkicon = (data == 1)?'check-square-o' :'square-o';
								return "<i class='fa fa-"+checkicon+"'></i>";
										}
					},
					{"data": "approved",
							"render": function ( data, type, row ) {
								var checkicon = (data == 1)?'check-square-o' :'square-o';
								return "<i class='fa fa-"+checkicon+"'></i>";
										}
					},
					{"data": "live",
							"render": function ( data, type, row ) {
								var checkicon = (data == 1)?'check-square-o' :'square-o';
								return "<i class='fa fa-"+checkicon+"'></i>";
										}
					},
					{"data": "start_date"},
					{"data": "end_date"},
					{"date": null,
						"defaultContent": "<a href='#'><i class='fa fa-pencil'></i></a>"
					},
					{"date": null,
						"defaultContent": "<a href='#'><i class='fa fa-trash'></i></a>"
					}
				]
			});



			//
			// function openroute(rte,id){
			// 	window.location.href =
			// }
			//
			$('#main-article-table tbody').on('click', '.fa-eye', function () {

				var data = table.row( $(this).parents('tr') ).data();
			//	var storyid = data["id"];
				window.location.href = '/admin/story/'+ data["id"];

				//openroute('edit',data["id"]);
				// var data = table.row( $(this).parents('tr') ).data();
				// 	alert( data["id"]);
			});
			$('#main-article-table tbody').on('click', '.fa-pencil', function () {

				var data = table.row( $(this).parents('tr') ).data();
			//	var storyid = data["id"];
				window.location.href = '/admin/story/'+ data["id"] + '/edit';

				//openroute('edit',data["id"]);
				// var data = table.row( $(this).parents('tr') ).data();
				// 	alert( data["id"]);
			});

			$('#main-article-table tbody').on('click', '.fa-trash', function () {

				var data = table.row( $(this).parents('tr') ).data();
				var dataid = data["id"];
				var recordid = 'Record ID: '+ dataid;
				var datatitle = data["title"];
				var modal = $('#modal-confirm-delete').modal('show');
				modal.find('#modal-confirm-title').html('Delete Story');
				modal.find('#record-info').html(datatitle);
				modal.find('#record-id').html(recordid);
				modal.find('#hidden-id').val(dataid);

				document.getElementById("btn-confirm-delete").addEventListener("click", function(){
					form = document.getElementById('admin_destroy');
					form.id = 'story_id';
					form.action = '/api/story/delete';
					form._method = 'POST';
					form.submit();
				});
				//alert('/admin/announcement/'+ data["id"] + '/confirm')
				// window.location.href = '/admin/story/'+ data["id"] + '/confirm';

			})
			// $("#stype1").change(function (e) {
			// 	console.log('	table.draw()');
			// 		table.draw();
			// });

			// $("#main-story-table_length").prepend($("#stype-filter"));
		});
</script>
	@endsection
