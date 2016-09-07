@extends('public.layouts.global')
@section('title', $announcement->exists ? 'Editing '.$announcement->title : 'Create New Announcement')
	@section('content')
	<div class="row">
		<div class="small-6 columns">
			<div class="row">
				<div class="small-12 columns">
					{!! Form::model($announcement, [
						'method' => $announcement->exists ? 'put' : 'post',
						'route' => $announcement->exists ? ['emu-today.announcement.update', $announcement->id] : ['emu-today.announcement.store'],
						'data-abide' => 'data-abide'
						]) !!}
						@include('public.layouts.components.errors')

				<div class="form-group">
					<label>Title
						{!! Form::text('title', null, ['class' => 'form-control','aria-describedby' =>'description-helptext', 'required'=> 'required']) !!}
						<span class="form-error">
							Please Include a Title for your Announcement.
						</span>
					</label>
					<p class="help-text" id="description-helptext">Please enter a title</p>
				</div>
				<div class="form-group">
					<label>Description
						{!! Form::textarea('announcement', null, ['class' => 'form-control htmlwysiwyg','rows' => '4', 'aria-describedby' =>'announcement-helptext', 'required'=> 'required', 'maxlength'=> '400'  ]) !!}
					</label>
					<p class="help-text" id="announcement-helptext">Brief Description of Announcement under 400 characters.</p>
				</div>
				</div><!-- /.small-12 columns -->
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-4 columns">
					<div class="form-group">
						<label>Start Date
							{!! Form::text('start_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-start-date','aria-describedby' =>'start-date-helptext', 'required'=> 'required']) !!}
							<span class="form-error">
								Please Include a Start Date.
							</span>
						</label>
						<p class="help-text" id="start-date-helptext">Please enter a Start Date</p>
					</div>
				</div><!-- /.col-md-3 -->
				<div class="medium-4 columns">
					<div class="form-group">
						<label>End Date
							{!! Form::text('end_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-end-date','aria-describedby' =>'end-date-helptext','data-abide-ignore'=>' data-abide-ignore']) !!}
							<span class="form-error">
								Please Include a Start Date.
							</span>
						</label>
						<p class="help-text" id="end-date-helptext">Please enter a End Date</p>
					</div>
				</div><!-- /.col-md-3 -->
				<div class="medium-4 columns">
					<div class="form-group text-right">
						<label>
							{!! Form::submit($announcement->exists ? 'Save' : 'Create New', ['class' => 'button button-success expanded']) !!}
						</label>

					</div>
				</div><!-- /.medium-3 columns -->
				{!! Form::close() !!}
				</div><!-- /.row -->
			</div><!-- /.small-6 columns -->
			<div class="small-6 columns">

			</div><!-- /.medium-6 columns -->

	</div><!-- row -->
@endsection

@section('scriptsfooter')
	@parent
	<!-- Bootstrap WYSIHTML5 -->
	<script>
	$(function(){
		console.log(JSvars.currentDate);
		$('#announcement-start-date').fdatepicker({
			initialDate: JSvars.currentDate,
			format: 'mm-dd-yyyy',
			disableDblClickSelection: true
		});
	});


	</script>
@endsection
