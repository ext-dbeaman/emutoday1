@inject('storytypes', 'emutoday\Http\Utilities\StoryTypes')
@extends('admin.layouts.adminlte')
@section('title', 'Editing '.$story->title)
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
	<div class="row">
      <div class="col-md-6">
				{!! Form::model($story, [
					'method' => 'put',
					'route' => ['admin.story.update', $story->id]
				])
				!!}
				<div class="box box-info">
		      <div class="box-header with-border">
		        <h3 class="box-title">Edit Story</h3>
		      </div>
					<form class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
		            {!! Form::label('title') !!}
		            {!! Form::text('title', null, ['class' => 'form-control']) !!}
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
		            {!! Form::textarea('teaser', null, ['class' => 'form-control']) !!}
		          </div>
							<div class="form-group">
			          @if($story->story_type == 'storyexternal')
			              {!! Form::label('external_link') !!}
			              {!! Form::text('external_link', null, ['class' => 'form-control']) !!}
			        	@else
			              {!! Form::label('content') !!}
			              {!! Form::textarea('story_content', $story->content, ['class' => 'form-control']) !!}
			        	@endif
						  </div>
			        <div class="form-group">
			            {!! Form::label('tag_list', 'Tags:') !!}
			            {!! Form::select('tag_list[]',$tags, $story->tags->lists('id')->toArray() , ['class' => 'form-control', 'multiple']) !!}
			        </div>
		          <div class="form-inline">
		            <div class="form-group">
		              {!! Form::label('start_date') !!}
		              {!! Form::text('start_date', null, ['class' => 'form-control datetimepicker']) !!}
		            </div>
		            <div class="form-group">
		              {!! Form::label('end_date') !!}
		              {!! Form::text('end_date', null, ['class' => 'form-control datetimepicker']) !!}
		            </div>
							</div><!-- /.form-inline -->
						</div> <!-- /.box-body -->
						<div class="box-footer">
	            <div class="form-group">
	              {!! Form::label('story_type','Story Type') !!}
	              {!! Form::text('story_type', $story->story_type, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
	            </div>
	            <div class="form-group">
	              {!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'btn btn-primary']) !!}
	            </div>
		        </div> <!-- /.box-footer -->
					</form>
				</div>   <!-- /.box -->
		</div> <!-- /.col -->
    <div class="col-md-6">
			
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

            <!-- list all image assets -->
			</div><!-- /.col -->
		</div><!-- /.row -->
</section>
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
<!-- bootstrap datetimepicker -->
<script src="/themes/plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

	@endsection
	@section('footer-script')
		@parent
<script>
$(function () {

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5();
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

		//Date picker
		$('.datetimepicker').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
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
