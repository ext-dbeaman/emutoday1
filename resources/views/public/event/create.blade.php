@extends('public.layouts.global')
@section('content')
    <div id="calendar-bar">
      <div class="row">
        <div class="small-12 columns">
					  <h3 class="cal-caps toptitle">Event</h3>
      </div><!--end calendar row column-->
		</div><!-- /.row-->
		<div class="row">
			<div class="small-12 column">
				@include('public.layouts.components.errors')

				@submit.prevent="submitForm">
				
					<div class="form-group" v-bind:class="[formErrors.title ? 'invalid-input' : '']">

							<label>Title
							<input v-model="newevent.title"  name="title" type="text">
							<p v-if="formErrors.title" class="help-text invalid">Need a Title!</p>
						</label>

					</div>
					<div class="form-group">

						<label>Short Title
							<input v-model="newevent.short_title" type="text" placeholder="Short Title" name="short-title" >
						</label>

					</div>

					<div class="form-group" v-bind:class="[formErrors.location ? 'invalid-input' : '']">

						<label>Location
							<autocomplete
								id="location"
								class="location"
								name="locationlist"
								placeholder="Type Here"
								url="/api/buildings"
								param="q"
								anchor="name"
								label="alias"
								model="vModelLike">
							</autocomplete>
							<p v-if="formErrors.location" class="help-text invalid">Need a Location!</p>
						</label>
					</div>

					<div class="form-group" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']">
						<label for="start-date">Start Date:</label>
						<datepicker id="start-date" :readonly="true" format="YYYY-MM-DD" name="start-date" :value.sync="sdate" aria-describedby="errorStartDate"></datepicker>
						<p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
					</div>
					<div class="form-group">
						<label for="start-time">Start Time:</label>
						<input id="start-time" type="time" v-model="newevent.start_time" />
					</div>
					<fieldset class="form-group">
						<label for="all-day">All Day?</label>
						<label for="allDayYes" class="radiobtns">Yes</label><input type="radio" name="all-day" id="allDayYes" value="1" v-model="newevent.all_day" />
						<label for="allDayNo" class="radiobtns">No</label><input type="radio" name="all-day" id="allDayNo" value="0" v-model="newevent.all_day" />
					</fieldset>
					<div class="form-group" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']">
						<label for="end-date">End Date:</label>
						<datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker>
					</div>
					<div class="form-group">
						<label for="end-time">Start Time:</label>
						<input id="end-time" type="time" v-model="newevent.end_time" />
					</div>
					<fieldset class="form-group">
						<label>No End Date:</label>
						<label for="end-time-yes" class="radiobtns">yes</label><input id="end-time-yes" name="no-end-time" type="radio" value="1" v-model="newevent.no_end_time"/>
						<label for="end-time-no" class="radiobtns">no</label><input id="end-time-no"  name="no-end-time" type="radio" value="0" v-model="newevent.no_end_time"/>
					</fieldset>
				<div class="form-group" v-bind:class="[formErrors.categories ? 'invalid-input' : '']">

						<label for="categories">Categories:</label>
						<select v-model="newevent.categories" id="categories" multiple="multiple" class="multiselect">
							<option v-for="category in categories" :value="category.id">
								{{category.category}}
							</option>
					</select>
			</div>
			<div class="form-group" v-bind:class="[formErrors.contact_person ? 'invalid-input' : '']">

				<label>Contact Person
					<input v-model="newevent.contact_person"  name="contact-person" type="text">
					<p v-if="formErrors.contact_person" class="help-text invalid">Need a Contact Person!</p>
				</label>

			</div>
			<div class="form-group" v-bind:class="[formErrors.contact_phone? 'invalid-input' : '']">

				<label>Contact Phone <em>(ex. 734.487.1849)</em>
					<input v-model="newevent.contact_phone" v-bind:class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact-phone" type="text">
					<p v-if="formErrors.contact_phone" class="help-text invalid">Need a Contact Phone!</p>
				</label>
			</div>
			<div class="form-group" v-bind:class="[formErrors.contact_email? 'invalid-input' : '']">
				<label>Contact Email: <em>(ex. janedoe@emich.edu)</em>
					<input v-model="newevent.contact_email" v-bind:class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact-email" type="text">
					<p v-if="formErrors.contact_email" class="help-text invalid">Need a Contact Email!</p>
				</label>
			</div>
			<div class="form-group">
				<label>Contact Fax: <em>(ex. 734.487.1849)</em>
					<input v-model="newevent.contact_fax" v-bind:class="[formErrors.contact_fax ? 'invalid-input' : '']" name="contact-fax" type="text">
				</label>
			</div>
			<div class="form-group">
				<label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
					<input v-model="newevent.related_link_1" v-bind:class="[formErrors.related_link_1 ? 'invalid-input' : '']" name="related-link-1" type="text">
				</label>
				<label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
					<input v-model="newevent.related_link_2" v-bind:class="[formErrors.related_link_2 ? 'invalid-input' : '']" name="related-link-2" type="text">
				</label>
				<label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
					<input v-model="newevent.related_link_1" v-bind:class="[formErrors.related_link_1 ? 'invalid-input' : '']" name="related-link-1" type="text">
				</label>
			</div>
			<div class="form-group">
				<label for="reg-deadline">Registration Deadline  </label>
					<datepicker id="reg-deadline" :readonly="true" format="YYYY-MM-DD" name="reg-deadline" :value.sync="rdate"></datepicker>
			</div>
			<div class="form-group">
					<label>Event Cost
						<input v-model="newevent.event_cost" v-bind:class="[formErrors.event_cost ? 'invalid-input' : '']" name="event-cost" type="text">
					</label>
			</div>
				<fieldset class="form-group">
					<label>Free</label>
					<label for="free-yes" class="radiobtns">yes</label><input id="free-yes" name="free-time" type="radio" value="1" v-model="newevent.free"/>
					<label for="free-no" class="radiobtns">no</label><input id="free-no"  name="free-time" type="radio" value="0" v-model="newevent.free"/>
				</fieldset>


				<div class="form-group">
				<label>Tickets Available
					<select v-model="newevent.tickets">
						<option v-for="ticketoption in ticketoptions" v-bind:value="ticketoption.value">
						 {{ ticketoption.text }}
					 </option>
				</select>
				</label>
				<template v-if="newevent.tickets == 'online' || newevent.tickets == 'all'">
					<label>Link: <em>(ex. http://www.emich.edu/calendar)</em>
						<input v-model="newevent.ticket_details_online" v-bind:class="[formErrors.ticket_details_online ? 'invalid-input' : '']" name="ticket-details-online" type="text">
					</label>
				</template>
				<template v-if="newevent.tickets == 'phone' || newevent.tickets == 'all'">
					<label>Tickets by Phone <em>(ex. 734.487.1849)</em>
						<input v-model="newevent.ticket_details_phone" v-bind:class="[formErrors.ticket_details_phone ? 'invalid-input' : '']" name="ticket-details-phone" type="text">
					</label>
				</template>
				<template v-if="newevent.tickets == 'office' || newevent.tickets == 'all'">
					<label>Address
						<input v-model="newevent.ticket_details_office" v-bind:class="[formErrors.ticket_details_office ? 'invalid-input' : '']" name="ticket-details-office" type="text">
					</label>
				</template>
				<template v-if="newevent.tickets == 'other'">
					<label>Other
						<input v-model="newevent.ticket_details_other" v-bind:class="[formErrors.ticket_details_other ? 'invalid-input' : '']" name="ticket-details-other" type="text">
					</label>
				</template>
			</div>
			<div class="form-group">
			<label>Participants
				<select v-model="newevent.participants">
					<option v-for="participant in participants" v-bind:value="participant.value">
					 {{ participant.text }}
				 </option>
			</select>
			</label>
			</div>

			<div class="form-group">
			<fieldset class="small-4 columns">
				<label for="lbc-reviewed">LBC Approved: (pre-approval required)</label>
				<label for="lbc-yes" class="radiobtns">yes</label><input id="lbc-reviewed-yes" name="lbc-reviewed" type="radio" value="1" v-model="newevent.lbc_reviewed"/>
				<label for="lbc-no" class="radiobtns">no</label><input id="lbc-reviewed-no"  name="lbc-reviewed" type="radio" value="0" v-model="newevent.lbc_reviewed"/>
			</fieldset>
			</div>
			<div class="form-group" v-bind:class="[formErrors.description ? 'invalid-input' : '']">

			<label>Description</label>
				<textarea v-model="newevent.description" v-bind:class="[formErrors.description ? 'invalid-input' : '']" name="description" type="textarea"></textarea>
				<p v-if="formErrors.description" class="help-text invalid">Need a Description!</p>

			</div>

				<div class="form-group">
			<label>If your groups website has a calendar that is fed from this one, and you would like this event to show up on it, please select it from the list below:</label>
			<select v-model="newevent.mini_calendar" id="mini_calendar">
				<option v-for="minicalendar in minicalendars" :value="minicalendar.id">
					{{minicalendar.calendar}}
				</option>
			</select>
			</div>
			<div class="form-group">
				<button class="button" type="submit">Publish</button>
			</div>


			</form>
		</div><!-- /.medium-6 columns -->
		<div class="medium-6 columns">

		</div><!-- /.medium-6 columns -->
</div><!-- /.row -->
