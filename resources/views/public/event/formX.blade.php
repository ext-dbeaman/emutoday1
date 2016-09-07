@extends('public.layouts.global')
@section('content')
    <div id="calendar-bar">
      <div class="row">
        <div class="small-12 columns">
					  <h3 class="cal-caps toptitle">Create Event</h3>
      </div><!--end calendar row column-->
		</div><!-- /.row-->
		<div class="row">
		<div class="medium-6 column">
			<div class="row">
				<div class="medium-12 column">
							@include('public.layouts.components.errors')
					{!! Form::model($event, [
						'method' => $event->exists ? 'put' : 'post',
						'route' => $event->exists ? ['emu-today.event.update', $event->id] : ['emu-today.event.store'],
						'data-abide' => 'data-abide'
						]) !!}
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
								<label>Short Title
									{!! Form::text('short_title', null, ['class' => 'form-control','aria-describedby' =>'short-title-helptext']) !!}
								</label>
							</div>
							<div class="form-group">
								<select class="form-control" id="select-location">
									<option value="-1" selected="selected">Choose Location</option>
										</select>

								{{-- <select id="select-location" class="js-data-example-ajax">
								  <option value="3620194" selected="selected">select2/select2</option>
								</select> --}}
								{{-- <label>Location
									{!! Form::select('location', null, ['id'=>'select-location', 'class' => 'form-control','aria-describedby' =>'select-location-helptext']) !!}
									<span class="form-error">
										Please Include a location.
									</span>
								</label>
								<p class="help-text" id="select-location-helptext">Please enter a Location</p> --}}
							</div><!-- /.form-group -->
				</div><!-- /.medium-12 column -->
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-6 columns">

					<div class="form-group">
						<label>Start Date
							{!! Form::text('start_date', null, ['class' => 'form-control', 'id'=>'event-start-date','aria-describedby' =>'event-start-date-helptext','required'=> 'required']) !!}
							<span class="form-error">
								Please Include a Start Date.
							</span>
						</label>
						<p class="help-text" id="event-start-date-helptext">Please enter a Start Date</p>
					</div>

				</div><!-- /.col-md-6 -->
				<div class="medium-6 columns">
					{{-- <div class="form-group">
						{!! Form::text('start_time', null, ['class' => 'form-control', 'id'=>'event-start-time' ]) !!}
					</div><!-- /.form-group --> --}}
					<div class="form-group">
						<label>Start Time
							{!! Form::text('start_time', null, ['class' => 'form-control', 'id'=>'event-start-time','aria-describedby' =>'event-start-time-helptext','required'=> 'required']) !!}
							<span class="form-error">
								Please Include a Start Time.
							</span>
						</label>
						<p class="help-text" id="start-time-helptext">Please enter a Start Time</p>
					</div>
				</div><!-- /.medium-6 columns -->

			</div><!-- /.row -->
			<div class="row">
				<fieldset class="form-group medium-6 columns">
						<legend>All Day:</legend>
							{!! Form::radio('all_day', 1, null, ['class' => 'form-control', 'id'=>'all-day-yes' ]) !!} {!!Form::label('all-day-yes', 'Yes')!!}
							{!! Form::radio('all_day', 0, null, ['class' => 'form-control', 'id'=>'all-day-no' ]) !!} {!!Form::label('all-day-no', 'No')!!}
					</fieldset>
					<fieldset class="form-group medium-6 columns">
							<legend>No End Time:</legend>
								{!! Form::radio('no_end_time', 1, null, ['class' => 'form-control', 'id'=>'no-end-time-yes' ]) !!} {!!Form::label('no_end_time-yes', 'Yes')!!}
								{!! Form::radio('no_end_time', 0, null, ['class' => 'form-control', 'id'=>'no-end-time-no' ]) !!} {!!Form::label('no_end_time-no', 'No')!!}
						</fieldset>
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-6 columns">
					{{-- <div class="form-group">
						{!! Form::text('end_date', null, ['class' => 'form-control', 'id'=>'event-end-date' ]) !!}
					</div><!-- /.form-group --> --}}
					<div class="form-group">
						<label>End Date
							{!! Form::text('end_date', null, ['class' => 'form-control', 'id'=>'event-end-date','aria-describedby' =>'event-end-date-helptext','required'=> 'required']) !!}
							<span class="form-error">
								Please Include a End Date.
							</span>
						</label>
						<p class="help-text" id="event-end-date-helptext">Please enter an End Date</p>
					</div>

				</div><!-- /.col-md-6 -->
				<div class="medium-6 columns">
					{{-- <div class="form-group">
						{!! Form::text('end_time', null, ['class' => 'form-control', 'id'=>'event-end-time' ]) !!}
					</div><!-- /.form-group --> --}}
					<div class="form-group">
						<label>End Time
							{!! Form::text('end_time', null, ['class' => 'form-control', 'id'=>'event-end-time','aria-describedby' =>'event-end-time-helptext']) !!}
							<span class="form-error">
								Please Include a End Time.
							</span>
						</label>
						<p class="help-text" id="event-end-time-helptext">Please enter a End Time</p>
					</div>
				</div><!-- /.medium-6 columns -->

			</div><!-- /.row -->

			<div class="row">
				<div class="medium-12 column">
					<div class="form-group">
						<label>Description
							{!! Form::textarea('description', null, ['class' => 'form-control', 'id'=>'event-description','aria-describedby' =>'event-description-helptext', 'rows'=>'5','required'=> 'required']) !!}
							<span class="form-error">
								Please Include an Event Description.
							</span>
						</label>
						<p class="help-text" id="event-description-helptext">Please Include an Event Description.</p>
					</div>
				</div><!-- /.medium-12 column -->
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-12 column">
					<div class="form-group">
							{!! Form::label('category_list', 'Categories:') !!}
							{!! Form::select('category_list[]',$cats, $event->categories->lists('id')->toArray() , ['class' => 'form-control','id'=>'select-categories','aria-describedby' =>'categories-helptext', 'multiple']) !!}
							<p class="help-text" id="categories-helptext">Please choose relevant categories</p>

					</div>
				</div><!-- /.medium-12 column -->
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-6 columns">
					<div class="form-group">
						<label>Contact Person
							{!! Form::text('contact_person', null, ['class' => 'form-control','aria-describedby' =>'contact-person-helptext', 'required'=> 'required']) !!}
							<span class="form-error">
								Please Include a contact person's name.
							</span>
						</label>
						<p class="help-text" id="contact-person-helptext">Please enter a Name for Contact Person</p>
					</div>
				</div><!-- /.medium-6 column -->
				<div class="medium-6 columns">
					<div class="form-group">
						<label>Contact Email <em>(ex. janedoe@emich.edu)</em>
							{!! Form::text('contact_email', null, ['class' => 'form-control','aria-describedby' =>'contact-email-helptext', 'required'=> 'required']) !!}
							<span class="form-error">
								Please Include a contact person's email address.
							</span>
						</label>
						<p class="help-text" id="contact-phone-helptext">Please Include a contact person's email address</p>
					</div>
				</div><!-- /.medium-6 columns -->
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-6 columns">
					<div class="form-group">
						<label>Contact Phone <em>(ex. 734.487.1849)</em>
							{!! Form::text('contact_phone', null, ['class' => 'form-control','aria-describedby' =>'contact-phone-helptext', 'required'=> 'required']) !!}
							<span class="form-error">
								Please Include a contact person's phone number.
							</span>
						</label>
						<p class="help-text" id="contact-phone-helptext">Please Include a contact person's phone number.</p>
					</div>
				</div><!-- /.medium-6 columns -->
				<div class="medium-6 columns">
					<div class="form-group">
						<label>Contact Fax <em>(ex. 734.487.1849)</em>
							{!! Form::text('contact_fax', null, ['class' => 'form-control','aria-describedby' =>'contact-fax-helptext']) !!}

						</label>
						<p class="help-text" id="contact-fax-helptext">Please Include a contact person's fax number </p>
					</div>
				</div><!-- /.medium-6 columns -->
			</div><!-- /.row -->
			<div class="row">
				<div class="mdium-4 columns">
					<div class="form-group">
						<label>Related Link 1 <em>(ex. http://www.emich.edu/calendar)</em>
							{!! Form::text('related_link_1', null, ['class' => 'form-control related-link','aria-describedby' =>'related-link-helptext']) !!}
						</label>
						<p class="help-text" id="crelated-link-helptext">Add related link if you have one</p>
					</div>
				</div><!-- /.mdium-4 columns -->
				<div class="mdium-4 columns">
					<div class="form-group">
						<label>Related Link 2 <em>(ex. http://www.emich.edu/calendar)</em>
							{!! Form::text('related_link_2', null, ['class' => 'form-control related-link','aria-describedby' =>'related-link-helptext']) !!}
						</label>
						<p class="help-text" id="crelated-link-helptext">Add related link if you have one</p>
					</div>
				</div><!-- /.mdium-4 columns -->
				<div class="mdium-4 columns">
					<div class="form-group">
						<label>Related Link 3 <em>(ex. http://www.emich.edu/calendar)</em>
							{!! Form::text('related_link_3', null, ['class' => 'form-control related-link','aria-describedby' =>'related-link-helptext']) !!}
						</label>
						<p class="help-text" id="crelated-link-helptext">Add related link if you have one</p>
					</div>
				</div><!-- /.mdium-4 columns -->
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-12 column">
					<div class="form-group">
						<label>Registration Deadline
							{!! Form::text('reg_deadline', null, ['class' => 'form-control','aria-describedby' =>'reg-deadline-helptext', 'required'=> 'required']) !!}
							<span class="form-error">
								Please Include a Registration Deadline Date.
							</span>
						</label>
						<p class="help-text" id="reg-deadline-helptext">Please Include a Registration Deadline Date.</p>
					</div>
				</div><!-- /.medium-12 column -->
			</div><!-- /.row -->
			<div class="row">

					<fieldset class="medium-6 columns">
							<legend>Event Free:	</legend>
							{!! Form::radio('free', 1, null, ['class' => 'form-control', 'id'=>'event-free-yes' ]) !!} 	{!!Form::label('event-free-yes', 'Yes')!!}
								{!! Form::radio('free', 0, null, ['class' => 'form-control', 'id'=>'event-free-no' ]) !!} {!!Form::label('event-free-no', 'No')!!}

						</fieldset>

				<div class="medium-6 columns">
					<div class="form-group">
						<label>Event Cost
							{!! Form::text('cost', null, ['class' => 'form-control','aria-describedby' =>'event-cost-helptext']) !!}
							<span class="form-error">
								Please Include an Event Cost.
							</span>
						</label>
						<p class="help-text" id="event-cost-helptext">Please Include an Event Cost.</p>
					</div>

				</div><!-- /.medium-6 columns -->
			</div><!-- /.row -->
			<div class="row">
				<div class="medium-12 column">
					<div class="form-group text-right">
						<label>
							{!! Form::submit($event->exists ? 'Update' : 'Create New', ['class' => 'button button-success expanded']) !!}
						</label>
					</div>
				</div><!-- /.medium-12 column -->
			</div><!-- /.row -->

				{!! Form::close() !!}
			</div><!-- /.medium-6 coliumns -->
			<div class="medium-6 columns">

			</div><!-- /.medium-6 columns -->
		</div><!-- /.row -->
	</div><!-- /#calendar-bar -->
@endsection

@section('scriptsfooter')
  @parent
<script>

$(function () {
	//Initialize Select2 Elements
	$(".select2").select2();

	function formatRepo (repo) {
		 if (repo.loading) return repo.text;

		 var markup = "<div class='select2-result-repository clearfix'>" +
			 "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
			 "<div class='select2-result-repository__meta'>" +
				 "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

		 if (repo.description) {
			 markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
		 }

		 markup += "<div class='select2-result-repository__statistics'>" +
			 "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
			 "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
			 "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
		 "</div>" +
		 "</div></div>";

		 return markup;
	 }

	 function formatRepoSelection (repo) {
		 return repo.full_name || repo.text;
	 }

	function formatResults(location) {

	  return location.id || location.name;
	}
	function formatSelection(location) {
		if (typeof location.name !== "undefined") {
          return formatResults(location);
      }
      return location.text;
	}
	$("#select-location").select2({
  ajax: {
    url:'{{url("/api/zbuildings")}}',
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        q: params.term//, // search term
        // page: params.page
      };
    },
    processResults: function (data) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used

      // params.page = params.page || 1;

      return {
				results: $.map(data, function (item) {
                return {
                        text: item.name,
                        id: item.id
                    }
                })

				// data
        // results: data.building,
        // pagination: {
        //   more: (params.page * 30) < data.total_count
        // }
      };
    },
    cache: true
  }
	// templateResult: formatResults,
	// templateSelection: formatSelection

	// escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  // minimumInputLength: 1,
  // templateResult: formatRepo, // omitted for brevity, see the source of this page
  // templateSelection: formatRepoSelection
});

	$("#select-categories").select2({
		tags:true
	});

});
	// $("select-location").select2({
	//   ajax: {
	//     url: "/api/buildings",
	//     dataType: 'json',
	//     delay: 250,
	//     data: function (params) {
	//       return {
	//         q: params.term, // search term
	//         page: params.page
	//       };
	//     },
	//     processResults: function (data, params) {
	//       // parse the results into the format expected by Select2
	//       // since we are using custom formatting functions we do not need to
	//       // alter the remote JSON data, except to indicate that infinite
	//       // scrolling can be used
	//       params.page = params.page || 1;
	//
	//       return {
	//         results: data.items,
	//         pagination: {
	//           more: (params.page * 30) < data.total_count
	//         }
	//       };
	//     },
	//     cache: true
	//   }
	// });





</script>
@endsection
