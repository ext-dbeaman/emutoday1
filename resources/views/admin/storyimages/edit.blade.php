@extends('admin.layouts.adminlte')
@section('title', 'Editing '.$storyImage->name)
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
@section('content')
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-6">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Edit {{ $storyImage->image_name. '.' . $storyImage->image_extension }}</h3>
				<p>Note: name and path values cannot be changed.  If you wish to change these, then delete and create a new photo:</p>
			</div><!-- /.box-header -->
			<div class="box-body">
			    {!! Form::model($storyImage, ['route' => ['admin.storyimages.update', $storyImage->id],
			    'method' => 'PATCH',
			    'class' => 'form',
			    'files' => true]
			    ) !!}
					  <div class="form-group">
							{!! Form::label('filename', 'File Name') !!}
							{!! Form::text('filename', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
						</div>
						<!-- is_something Form Input -->
				    <div class="form-group">
				        {!! Form::label('is_active', 'Is Active:') !!}
				        {!! Form::checkbox('is_active') !!}
				    </div>
				    <!-- is_featured Form Input -->
				    <div class="form-group">
				        {!! Form::label('is_featured', 'Is Featured:') !!}
				        {!! Form::checkbox('is_featured') !!}
				    </div>
				    <!-- form field for file -->
				    <div class="form-group">
				        {!! Form::label('image', 'Primary Image') !!}
				        {!! Form::file('image', null, array('class'=>'form-control')) !!}
				    </div>
						<div class="form-group">
				        {!! Form::submit('Edit', array('class'=>'button')) !!}
				    </div>
						{!! Form::close() !!}
    		</div><!-- /.box-body -->
				<div class="box-footer">
	        {!! Form::model($storyImage, ['route' => ['admin.storyimages.destroy', $storyImage->id],
	        'method' => 'DELETE',
	        'class' => 'form',
	        'files' => true]
	        ) !!}
					<div class="form-group">
            {!! Form::submit('Delete Photos', array('class'=>'button alert', 'Onclick' => 'return ConfirmDelete();')) !!}
        	</div>
					{!! Form::close() !!}
				</div><!-- /.box-footer -->
		</div><!-- /.box-info -->
	</div><!-- /.col-md-6 -->
	<div class="col-md-6">
		<img src="/imgs/story/thumbnails/{{ 'thumb-' . $storyImage->image_name . '.' . $storyImage->image_extension . '?'. 'time='. time() }}"
		alt="{{$storyImage->image_name}}">
	</div><!-- /.col-md-6 -->
</div><!-- /.row -->
</section>
@endsection
@section('footer')
    @parent
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

@endsection
