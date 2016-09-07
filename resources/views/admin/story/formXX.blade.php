<!-- inject('storytypes', 'emutoday\Http\Utilities\StoryTypes') -->
@extends('admin.layouts.adminlte')
@section('title', $story->exists ? 'Editing '.$story->title : 'Create New Story')
	@section('style-plugin')
		@parent

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
<!-- Bootstrap Color Picker -->

<!-- Select2 -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

<link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    @endsection
		@section('scriptshead')
					{{-- @include('admin.layouts.scriptshead') --}}
					<script src="/themes/plugins/ckeditor/ckeditor.js"></script>

		@parent

	@endsection
@section('content')
		<div class="row">
			<div class="col-md-8">

			<div class="box box-primary">

    {!! Form::model($story, [
        'method' => $story->exists ? 'put' : 'post',
        'route' => $story->exists ? ['admin.story.update', $story->id] : ['admin.story.store']
    ]) !!}

			<div class="box-header with-border">
					<h3 class="box-title">{{$story->story_folder}} Story</h3>
					@include('admin.layouts.components.boxtools', ['rte' => 'story', 'path' => 'admin/story/', 'cuser'=>$currentUser])

			</div> 	<!-- /.box-header -->
			<form role="form">
					<div class="box-body">
						<div class="form-group @if ($errors->has('title')) has-error @endif">
				        <label for="title">Title</label>
								{!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Title', 'id'=>'title']) !!}

				        {{-- <input type="text" id="title" class="form-control" name="title" placeholder="Title"> --}}
				        @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
				    </div>
				    <div class="form-group">
				        {!! Form::label('slug') !!}
				        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
				    </div>
				    <div class="form-group">
				        {!! Form::label('subtitle') !!}
				        {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
				    </div>
				    <div class="form-group teaser">
				        {!! Form::label('teaser') !!}
				        {!! Form::textarea('teaser', null, ['class' => 'form-control', 'rows'=>'4']) !!}
				    </div>
						<div class="form-group">
				    @if($story->story_type == 'storyexternal')
					        {!! Form::label('external_link') !!}
					        {!! Form::text('external_link', null, ['class' => 'form-control']) !!}
					  @else
					        {!! Form::label('content') !!}
									{!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'story-content']) !!}
					  @endif
  				</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label('start_date') !!}
								{!! Form::text('start_date', null, ['class' => 'form-control', 'id'=>'start-date']) !!}
							</div>
						</div><!-- /.col-md-6 -->
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label('end_date') !!}
								{!! Form::text('end_date', null, ['class' => 'form-control', 'id'=>'end-date']) !!}
							</div>
						</div><!-- /.col-md-6 -->
					</div><!-- /.row -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
									{!! Form::label('is_approved','Approved?', ['class'=>'text-center']) !!}
									<div class="row">
								<div class="col-md-4">
									{!! Form::radio('is_approved', 1, $story->is_approved,['class' => 'form-control', 'id'=>'is-approved-yes']) !!}  {!! Form::label('is_approved', 'yes') !!}
										</div><!-- /.col-md-4 -->
										<div class="col-md-4">
											{{ Form::radio('is_approved', 0, $story->is_approved,['class' => 'form-control', 'id'=>'is-approved-no']) }}  {!! Form::label('is_approved', 'no') !!}
										</div><!-- /.col-md-4-->
								</div><!-- /.row -->
							</div><!-- /.form-group-->
						</div><!-- /.col-md-6 -->
						<div class="col-md-6">
							<div class="form-group">
						{!! Form::label('is_featured') !!}
						<div class="row">
							<div class="col-md-4">
								{!! Form::radio('is_featured', 1, $story->is_featured,['class' => 'form-control', 'id'=>'is-featured-yes']) !!}  {!! Form::label('is_featured', 'yes') !!}
							</div><!-- /.col-md-6 -->
							<div class="col-md-4">
								{!! Form::radio('is_featured', 0, $story->is_featured,['class' => 'form-control', 'id'=>'is-featured-no'] ) !!}  {!! Form::label('is_featured', 'no') !!}
							</div><!-- /.col-md-6 -->
						</div><!-- /.row -->
					</div><!-- /.form-group -->
						</div><!-- /.col-md-6 -->
					</div><!-- /.row -->
					<div class="row">
						<h4>{{$story->exists ? $story->storyType->group : 'Group'}}</h4>
						<div class="col-md-6">
							<div class="form-group">
									{!! Form::label('story_type') !!}
										@if (is_string($stypes))
												{!! Form::text('story_type', $stypes, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
										@else
										{!! Form::select('story_type', $stypes, null, ['class' => 'form-control']) !!}
								@endif
							</div>
						</div><!-- /.col-md-6 -->
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'btn btn-primary btn-block']) !!}
							</div>
						</div><!-- /.col-md-6 -->
					</div><!-- /.row -->
			</div><!-- /.box-body -->
			{!! Form::close() !!}
		</div><!-- /.box -->
	</div><!-- /.col-md-6-->

		<div class="col-md-4">
			@if($story->exists)
					@if($story->story_type == 'storybasic')
						<div class="box box-warning">
							<div class="box-header with-border">
								<form action="promoteStory" method="POST">
										{{ csrf_field() }}
										{!! Form::select('new_story_type', $stypelist, 'storypromoted', ['class' => 'form-control']) !!}


									<button class="btn btn-primary" href="#">Promote Story</button>

								</form>
							</div>
						</div>
					@else
							@if ($story->storyImages()->count() < 3)
						<!-- general form elements disabled -->
										<div class="box box-warning">
											<div class="box-header with-border">
												<form action="addimage" method="POST">
														{{ csrf_field() }}
													<button class="btn btn-primary" href="#">Add Image</button>

												</form>
											</div>
										</div>
							<!--     add image asset -->
							@endif
							@each('admin.story.subviews.storyimage', $story->storyImages, 'storyImage')
					@endif
				@endif
		</div><!-- /.col-md-6 -->
	</div><!-- /.row -->
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

<script src="/themes/plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>

	@endsection
	@section('footer-script')
		@parent
<script>
$(function () {

	  // CKEDITOR.replace('story-content');
		CKEDITOR.replace( 'story-content', {
			// Define changes to default configuration here. For example:
  filebrowserBrowseUrl : '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
    filebrowserImageBrowseUrl: '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
    filebrowserUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
    filebrowserImageUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images'

					} );

		//bootstrap WYSIHTML5 - text editor
		// $("#story-content").wysihtml5();
    //Initialize Select2 Elements
    $(".select2").select2();


		$('input[type="radio"]').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		})
		$('#is-featured-no').iCheck('check');
		$('#is-featured-yes').iCheck('disable');

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

		//Start Date picker
		$('#start-date').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});

		//End Date picker
		$('#end-date').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
			useCurrent: false //Important! See Issue #1075
		});
		$("#start-date").on("dp.change", function (e) {
					$('#end-date').data("DateTimePicker").minDate(e.date);
			});
			$("#end-date").on("dp.change", function (e) {
					$('#start-date').data("DateTimePicker").maxDate(e.date);
			});



  });
$('input[name=title]').on('blur', function () {
		var slugElement = $('input[name=slug]');

		if (slugElement.val()) {
				return;
		}

		slugElement.val(this.value.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, ''));
});
</script>
@endsection
