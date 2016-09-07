@extends('admin.layouts.adminlte')

@section('title', 'Media Files')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<!-- DataTables -->
	<link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">


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

				<!-- SELECT2 EXAMPLE -->
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Mediafiles</h3>

						<div class="box-tools pull-right">
						</div> <!-- /.box-tools -->
					</div> <!-- /.box-header -->
					<div class="box-body">
						<table class="table table-striped table-hover">
        	<thead>
            <tr>
                <th class="text-center">ID</th>
								<th class="text-center">Img</th>
								  <th class="text-center">Type</th>
									<th class="text-left">Path</th>

                <th class="text-left">Name</th>
								<th class="text-left">Filename</th>
								<th class="text-left">is active</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mediafiles as $mediafile)
                <tr>
                    <td class="text-center">
                        {{ $mediafile->id }}
                    </td>
                    <td class="text-center">
                        <img src="/imagecache/smallthumb/{{$mediafile->filename}}">
                    </td>
                    <td class="text-left">{{ $mediafile->type }}</td>
										  <td class="text-left">{{ $mediafile->path }}</td>
                      <td class="text-left">{{ $mediafile->name }}</td>
											  <td class="text-left">{{ $mediafile->filename }}</td>
												  <td class="text-center">
														{{ $mediafile->is_active }}
													</td>
                    <td class="text-center">
                        <a href="#">
																<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>

                        </a>
                    </td>
                    <td class="text-center">
                        <a href="#">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>

                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
	</div><!-- /.box-body -->
	<div class="box-footer text-right">
		    {!! $mediafiles->render() !!}
	</div> <!-- /.box-footer -->
</div> <!-- /.box -->
</section>
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
</body>
