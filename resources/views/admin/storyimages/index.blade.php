@extends('admin.layouts.adminlte')

@section('title', 'Story Images')
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
				<a href="{{ route('admin.storyimages.create') }}" class="button">Create New Story Image</a>

				<!-- SELECT2 EXAMPLE -->
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Story Images</h3>

						<div class="box-tools pull-right">
						</div> <!-- /.box-tools -->
					</div> <!-- /.box-header -->
					<div class="box-body">
						<table class="table table-striped table-hover">
        	<thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Thumbnail</th>
                <th class="text-left">Image Name</th>
								<th class="text-left">Image Type</th>
                <th class="text-center">Story ID</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($storyImages as $storyImage)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.storyimages.show', $storyImage->id) }}">{{ $storyImage->id }}</a>
                    </td>
                    <td class="text-center">
                        <img src="{{ $storyImage->present()->thumbnailImageURL.'?'. 'time='. time() }}">
                    </td>
                    <td class="text-left">{{ $storyImage->image_name }}</td>
										  <td class="text-left">{{ $storyImage->image_type }}</td>
                    <td class="text-center">{{ $storyImage->story_id }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.storyimages.edit', $storyImage->id) }}">
																<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>

                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.storyimages.confirm', $storyImage->id) }}">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>

                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
	</div><!-- /.box-body -->
	<div class="box-footer text-right">
		    {!! $storyImages->render() !!}
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
