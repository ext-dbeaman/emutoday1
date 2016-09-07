<template>

				<form>
					<slot name="csrf"></slot>
					<!-- <slot name="author_id" v-model="newevent.author_id"></slot> -->
					<div class="row">
						<div class="column">
							<div v-show="formMessage.isOk"  class="callout success">
								<h5>{{formMessage.msg}}</h5>
									</div>
								</div><!-- /.column -->
					</div><!-- /.row -->
					<div class="row">
						<div class="column">
							<label>Title <i class="fi-star reqstar"></i></label>
								<p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
								<input v-model="newevent.title" v-bind:class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text">
								<p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>

									<label>Short Title	</label>
									<input v-model="newevent.short_title" type="text" placeholder="Short Title" name="short-title" >


						</div><!-- /.column -->
					</div><!-- /.row -->
					<div class="row">
						<div class="column">
							<label>Is Event on Campus?
								<input id="on-campus-yes" name="on_campus" type="checkbox" value="1" v-model="newevent.on_campus"/>
							</label>
						</div><!-- /.column -->
					</div><!-- /.row -->
					<template v-if="isOnCampus">
								<div class="row">
									<div class="column">
											<label>Building</label>
										<select id="select-zbuilding" class="js-example-basic-multiple" style="width: 100%" v-myselect="zbuildings"  ajaxurl="/api/zbuildings" v-bind:resultvalue="buildings" data-tags="false" multiple="multiple" data-maximum-selection-length="1">
											<!-- <option value="0">default</option> -->
										</select>
									</div><!-- /.medium-8 columns -->
									<div class="column">
										<label>Room</label>
										<input v-model="newevent.room" v-bind:class="[formErrors.room ? 'invalid-input' : '']" name="room" type="text">
									</div><!-- /.medium-4 columns -->
								</div> <!-- /.row -->
							</template>
							<div class="row">
								<div class="column">
							<template v-if="isOnCampus">

								<label>Location <i class="fi-star reqstar"></i></label>
									<input v-model="computedLocation" v-bind:class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text" readonly="readonly">
								</template>
								<template v-else>
									<label>Location <i class="fi-star reqstar"></i></label>
									<input v-model="newevent.locationoffcampus" v-bind:class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text">
								</template>
							</div><!-- /. column -->
							</div><!-- /.row -->
						<div class="row">
	 					<div class="column">
							<label for="start-date">Start Date: <i class="fi-star reqstar"></i></label>
							<input id="start-date" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" v-model="newevent.start_date" aria-describedby="errorStartDate" v-mydatedropper />
							<p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
					</div>
	 					<div class="column">	<label for="end-date">End Date: <i class="fi-star reqstar"></i></label>
							<input id="end-date" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="newevent.end_date"  aria-describedby="errorEndDate" v-mydatedropper />
							<!-- <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> -->
							<p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>
						</div>
					</div><!-- /.row -->

					<div class="row">
						<div class="column">
							<label for="all-day">All Day Event:
							<input id="all-day" name="all_day" type="checkbox" value="1" v-model="newevent.all_day"/>
						</label>
						</div><!-- /.column -->
						<div class="column">
							<div v-show="hasEndTime">
								<label for="no-end-time">No End Time:
									<input id="no-end-time" name="no_end_time" type="checkbox" value="1" v-model="newevent.no_end_time"/>
										<!-- <label for="no-end-time-no" class="radiobtns">no</label><input id="no-end-time-no"  name="no_end_time" type="radio" value="0" v-model="newevent.no_end_time"/> -->
									</div>
						</div><!-- /.column -->
					</div><!-- /.row -->

					<div class="row">
						<div class="column">
							<div v-show="hasStartTime">
									<label for="start-time">Start Time: <i class="fi-star reqstar"></i></label>
								<input id="start-time" type="text" v-model="newevent.start_time" v-mytimedropper />
							</div><!-- /.form-group -->
						</div><!-- /.column -->
						<div class="column">
							<div v-show="hasEndTime">
							<label for="end-time">End Time: <i class="fi-star reqstar"></i></label>
							<input id="end-time" type="text" v-model="newevent.end_time" v-mytimedropper />
								</div><!-- /.form-group -->
						</div><!-- /.column -->
					</div><!-- /.row -->

					<div class="row">
						<div class="column">
							<label>Categories: <i class="fi-star reqstar"></i></label>
							<select  v-bind:class="[formErrors.categories ? 'invalid-input' : '']" id="select-zcats" style="width: 100%" v-myselect="zcategories" v-bind:resultvalue="zcats" ajaxurl="/api/zcats" data-close-on-select="false" data-placeholder="zcats" data-tags="false"  multiple="multiple">
								<option value="0">
									default
								</option>
							</select>
						</div><!-- /.column -->
					</div><!-- /.row -->

					<div class="row">
						<div class="column">

								<label>Contact Person <i class="fi-star reqstar"></i>
									<input v-model="newevent.contact_person" v-bind:class="[formErrors.contact_person ? 'invalid-input' : '']" name="contact-person" type="text">
									<p v-if="formErrors.contact_person" class="help-text invalid">Need a Contact Person!</p>
								</label>
						</div><!-- / columns -->
						<div class="column">

								<label>Contact Email: <i class="fi-star reqstar"></i> <em>(ex. janedoe@emich.edu)</em>
									<input v-model="newevent.contact_email" v-bind:class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact-email" type="text">
									<p v-if="formErrors.contact_email" class="help-text invalid">Need a Contact Email!</p>
								</label>
							</div>
					</div><!-- /.row -->
					<div class="row">
						<div class="column">


								<label>Contact Phone <i class="fi-star reqstar"></i> <em>(ex. 734.487.1849)</em>
									<input v-model="newevent.contact_phone" v-bind:class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact-phone" type="text">
									<p v-if="formErrors.contact_phone" class="help-text invalid">Need a Contact Phone!</p>
								</label>
						</div><!-- /columns -->
						<div class="column">

								<label>Contact Fax: <em>(ex. 734.487.1849)</em>
									<input v-model="newevent.contact_fax" v-bind:class="[formErrors.contact_fax ? 'invalid-input' : '']" name="contact-fax" type="text">
								</label>

						</div><!-- / columns -->
					</div><!-- /.row -->

					<div class="row">
							<div class="column">

									<label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
										<input v-model="newevent.related_link_1" v-bind:class="[formErrors.related_link_1 ? 'invalid-input' : '']" name="related-link-1" type="text">
									</label>
									<label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
										<input v-model="newevent.related_link_2" v-bind:class="[formErrors.related_link_2 ? 'invalid-input' : '']" name="related-link-2" type="text">
									</label>
									<label>Related Link: <em>(ex. http://www.emich.edu/calendar)</em>
										<input v-model="newevent.related_link_1" v-bind:class="[formErrors.related_link_1 ? 'invalid-input' : '']" name="related-link-1" type="text">
									</label>
							</div><!-- / column -->
					</div><!-- /.row -->
					<div class="row">
							<div class="column">

									<label for="reg-deadline">Registration Deadline</label>
									<input id="reg-deadline" type="text" v-model="newevent.reg_deadline" :value.sync="rdate" aria-describedby="errorRegDeadline" v-mydatedropper />

							</div><!-- /. columns-->
						</div><!-- /.row -->

						<div class="row">
								<div class="column">

										<div class="row">
											<div class="column">
												<label>Free</label>

													<input id="free" name="free" type="checkbox" value="1" v-model="newevent.free"/>

											</div><!-- /.medium-4 columns -->
											<div class="column">
												<label>Event Cost <i class="fi-star reqstar"></i></label>
												<div v-show="hasCost" class="form-group">
															<div class="input-group">
																<span class="input-group-label">$</span>
																	<input v-model="newevent.cost" v-bind:class="[formErrors.cost ? 'invalid-input' : '']" name="event-cost"  type="text">
															</div><!-- /. input-group -->
												</div>
												<div v-else class="form-group">
															<div class="input-group">
																<span class="input-group-label">$</span>
																	<input v-model="newevent.cost" v-bind:class="[formErrors.cost ? 'invalid-input' : '']" name="event-cost"  type="text" readonly="readonly">
															</div><!-- /. input-group -->
												</div>
											</div><!-- /columns -->
										</div><!-- /.row -->
							</div><!-- /.column -->
					</div><!-- /.row -->

					<div class="row">
								<div class="column">

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
								</div><!-- /.form-group -->
							</div><!-- /column -->
					</div><!-- /.row -->

					<div class="row">
						<div class="medium-12 column">
							<div class="form-group">
								<label>Participants
									<select v-model="newevent.participants">
										<option v-for="participant in participants" v-bind:value="participant.value">
									 {{ participant.text }}
									</option>
								</select>
							</label>
							</div>
						</div><!--/.medium-12 column -->
					</div><!-- /.row -->
						<div class="row">
							<div class="column">

									<label for="lbc-reviewed">LBC Approved: <em>(pre-approval required)</em>
									<input id="lbc-reviewed" name="lbc-reviewed" type="checkbox" value="1" v-model="newevent.lbc_reviewed"/>
								</label>

							</div><!-- / columns -->
							<div class="column">

							</div><!-- /.medium-6 columns -->
						</div><!-- /.row -->
						<div class="row">
							<div class="column">

									<label>Description <i class="fi-star reqstar"></i> <p class="help-text" id="description-helptext">({{descriptionChars}} characters left)</p>

									<textarea v-model="newevent.description" v-bind:class="[formErrors.description ? 'invalid-input' : '']" name="description" type="textarea" rows="6"></textarea>
								</label>
								<p v-if="formErrors.description" class="help-text invalid">Need a Description!</p>


							</div><!-- /column -->
						</div><!-- /.row -->

						<div class="row">
							<div class="column">

							<label>Group Website Calendar <p class="help-text" id="minicalendar-helptext">If your groups website has a calendar that is fed from this one, and you would like this event to show up on it, please select it from the list below:</p>
									<select v-model="newevent.mini_calendar" id="mini_calendar">
								<option v-for="minicalendar in minicalendars" :value="minicalendar.id">
									{{minicalendar.calendar}}
								</option>
							</select>
							</label>
						</div><!-- / column -->
					</div><!-- /.row -->


					<div class="row">
						<div class="column">

								<button v-on:click="submitForm" type="submit" class="button button-primary">Submit For Approval</button>

								</form>
						</div><!-- /.medium-12 column -->
				</form>



</template>

<style scoped>
/*!
 * Milligram v1.1.0
 * http://milligram.github.io
 *
 * Copyright (c) 2016 CJ Patoilo
 * Licensed under the MIT license
*/


html {
  box-sizing: border-box;
  font-size: 62.5%;
}

body {
  color: #606c76;
  font-family: "Roboto", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
  font-size: 1.6em;
  font-weight: 300;
  letter-spacing: 0.01em;
  line-height: 1.6;
}

*,
*:after,
*:before {
  box-sizing: inherit;
}

blockquote {
  border-left: 0.3rem solid #d1d1d1;
  margin-left: 0;
  margin-right: 0;
  padding: 1rem 1.5rem;
}
blockquote *:last-child {
  margin: 0;
}

.button,
button,
input[type='button'],
input[type='reset'],
input[type='submit'] {
  background-color: #9b4dca;
  border: 0.1rem solid #9b4dca;
  border-radius: 0.4rem;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-size: 1.1rem;
  font-weight: 700;
  height: 3.8rem;
  letter-spacing: 0.1rem;
  line-height: 3.8rem;
  padding: 0 3rem;
  text-align: center;
  text-decoration: none;
  text-transform: uppercase;
  white-space: nowrap;
}
.button:hover, .button:focus,
button:hover,
button:focus,
input[type='button']:hover,
input[type='button']:focus,
input[type='reset']:hover,
input[type='reset']:focus,
input[type='submit']:hover,
input[type='submit']:focus {
  background-color: #606c76;
  border-color: #606c76;
  color: #fff;
  outline: 0;
}
.button.button-disabled, .button[disabled],
button.button-disabled,
button[disabled],
input[type='button'].button-disabled,
input[type='button'][disabled],
input[type='reset'].button-disabled,
input[type='reset'][disabled],
input[type='submit'].button-disabled,
input[type='submit'][disabled] {
  opacity: 0.5;
  cursor: default;
}
.button.button-disabled:hover, .button.button-disabled:focus, .button[disabled]:hover, .button[disabled]:focus,
button.button-disabled:hover,
button.button-disabled:focus,
button[disabled]:hover,
button[disabled]:focus,
input[type='button'].button-disabled:hover,
input[type='button'].button-disabled:focus,
input[type='button'][disabled]:hover,
input[type='button'][disabled]:focus,
input[type='reset'].button-disabled:hover,
input[type='reset'].button-disabled:focus,
input[type='reset'][disabled]:hover,
input[type='reset'][disabled]:focus,
input[type='submit'].button-disabled:hover,
input[type='submit'].button-disabled:focus,
input[type='submit'][disabled]:hover,
input[type='submit'][disabled]:focus {
  background-color: #9b4dca;
  border-color: #9b4dca;
}
.button.button-outline,
button.button-outline,
input[type='button'].button-outline,
input[type='reset'].button-outline,
input[type='submit'].button-outline {
  color: #9b4dca;
  background-color: transparent;
}
.button.button-outline:hover, .button.button-outline:focus,
button.button-outline:hover,
button.button-outline:focus,
input[type='button'].button-outline:hover,
input[type='button'].button-outline:focus,
input[type='reset'].button-outline:hover,
input[type='reset'].button-outline:focus,
input[type='submit'].button-outline:hover,
input[type='submit'].button-outline:focus {
  color: #606c76;
  background-color: transparent;
  border-color: #606c76;
}
.button.button-outline.button-disabled:hover, .button.button-outline.button-disabled:focus, .button.button-outline[disabled]:hover, .button.button-outline[disabled]:focus,
button.button-outline.button-disabled:hover,
button.button-outline.button-disabled:focus,
button.button-outline[disabled]:hover,
button.button-outline[disabled]:focus,
input[type='button'].button-outline.button-disabled:hover,
input[type='button'].button-outline.button-disabled:focus,
input[type='button'].button-outline[disabled]:hover,
input[type='button'].button-outline[disabled]:focus,
input[type='reset'].button-outline.button-disabled:hover,
input[type='reset'].button-outline.button-disabled:focus,
input[type='reset'].button-outline[disabled]:hover,
input[type='reset'].button-outline[disabled]:focus,
input[type='submit'].button-outline.button-disabled:hover,
input[type='submit'].button-outline.button-disabled:focus,
input[type='submit'].button-outline[disabled]:hover,
input[type='submit'].button-outline[disabled]:focus {
  color: #9b4dca;
  border-color: inherit;
}
.button.button-clear,
button.button-clear,
input[type='button'].button-clear,
input[type='reset'].button-clear,
input[type='submit'].button-clear {
  color: #9b4dca;
  background-color: transparent;
  border-color: transparent;
}
.button.button-clear:hover, .button.button-clear:focus,
button.button-clear:hover,
button.button-clear:focus,
input[type='button'].button-clear:hover,
input[type='button'].button-clear:focus,
input[type='reset'].button-clear:hover,
input[type='reset'].button-clear:focus,
input[type='submit'].button-clear:hover,
input[type='submit'].button-clear:focus {
  color: #606c76;
  background-color: transparent;
  border-color: transparent;
}
.button.button-clear.button-disabled:hover, .button.button-clear.button-disabled:focus, .button.button-clear[disabled]:hover, .button.button-clear[disabled]:focus,
button.button-clear.button-disabled:hover,
button.button-clear.button-disabled:focus,
button.button-clear[disabled]:hover,
button.button-clear[disabled]:focus,
input[type='button'].button-clear.button-disabled:hover,
input[type='button'].button-clear.button-disabled:focus,
input[type='button'].button-clear[disabled]:hover,
input[type='button'].button-clear[disabled]:focus,
input[type='reset'].button-clear.button-disabled:hover,
input[type='reset'].button-clear.button-disabled:focus,
input[type='reset'].button-clear[disabled]:hover,
input[type='reset'].button-clear[disabled]:focus,
input[type='submit'].button-clear.button-disabled:hover,
input[type='submit'].button-clear.button-disabled:focus,
input[type='submit'].button-clear[disabled]:hover,
input[type='submit'].button-clear[disabled]:focus {
  color: #9b4dca;
}

code {
  background: #f4f5f6;
  border-radius: 0.4rem;
  font-size: 86%;
  padding: 0.2rem 0.5rem;
  margin: 0 0.2rem;
  white-space: nowrap;
}

pre {
  background: #f4f5f6;
  border-left: 0.3rem solid #9b4dca;
  font-family: "Menlo", "Consolas", "Bitstream Vera Sans Mono", "DejaVu Sans Mono", "Monaco", monospace;
}
pre > code {
  background: transparent;
  border-radius: 0;
  display: block;
  padding: 1rem 1.5rem;
  white-space: pre;
}

hr {
  border: 0;
  border-top: 0.1rem solid #f4f5f6;
  margin-bottom: 3.5rem;
  margin-top: 3rem;
}

input[type='email'],
input[type='number'],
input[type='password'],
input[type='search'],
input[type='tel'],
input[type='text'],
input[type='url'],
textarea,
select {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  background-color: transparent;
  border: 0.1rem solid #d1d1d1;
  border-radius: 0.4rem;
  box-shadow: none;
  height: 3.8rem;
  padding: 0.6rem 1rem;
  width: 100%;
}
input[type='email']:focus,
input[type='number']:focus,
input[type='password']:focus,
input[type='search']:focus,
input[type='tel']:focus,
input[type='text']:focus,
input[type='url']:focus,
textarea:focus,
select:focus {
  border: 0.1rem solid #9b4dca;
  outline: 0;
}

select {
  padding: 0.6rem 3rem 0.6rem 1rem;
  background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIgICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiICAgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjkgMTQiICAgaGVpZ2h0PSIxNHB4IiAgIGlkPSJMYXllcl8xIiAgIHZlcnNpb249IjEuMSIgICB2aWV3Qm94PSIwIDAgMjkgMTQiICAgd2lkdGg9IjI5cHgiICAgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjQ4LjQgcjk5MzkiICAgc29kaXBvZGk6ZG9jbmFtZT0iY2FyZXQtZ3JheS5zdmciPjxtZXRhZGF0YSAgICAgaWQ9Im1ldGFkYXRhMzAzOSI+PHJkZjpSREY+PGNjOldvcmsgICAgICAgICByZGY6YWJvdXQ9IiI+PGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+PGRjOnR5cGUgICAgICAgICAgIHJkZjpyZXNvdXJjZT0iaHR0cDovL3B1cmwub3JnL2RjL2RjbWl0eXBlL1N0aWxsSW1hZ2UiIC8+PC9jYzpXb3JrPjwvcmRmOlJERj48L21ldGFkYXRhPjxkZWZzICAgICBpZD0iZGVmczMwMzciIC8+PHNvZGlwb2RpOm5hbWVkdmlldyAgICAgcGFnZWNvbG9yPSIjZmZmZmZmIiAgICAgYm9yZGVyY29sb3I9IiM2NjY2NjYiICAgICBib3JkZXJvcGFjaXR5PSIxIiAgICAgb2JqZWN0dG9sZXJhbmNlPSIxMCIgICAgIGdyaWR0b2xlcmFuY2U9IjEwIiAgICAgZ3VpZGV0b2xlcmFuY2U9IjEwIiAgICAgaW5rc2NhcGU6cGFnZW9wYWNpdHk9IjAiICAgICBpbmtzY2FwZTpwYWdlc2hhZG93PSIyIiAgICAgaW5rc2NhcGU6d2luZG93LXdpZHRoPSI5MDMiICAgICBpbmtzY2FwZTp3aW5kb3ctaGVpZ2h0PSI1OTQiICAgICBpZD0ibmFtZWR2aWV3MzAzNSIgICAgIHNob3dncmlkPSJ0cnVlIiAgICAgaW5rc2NhcGU6em9vbT0iMTIuMTM3OTMxIiAgICAgaW5rc2NhcGU6Y3g9Ii00LjExOTMxODJlLTA4IiAgICAgaW5rc2NhcGU6Y3k9IjciICAgICBpbmtzY2FwZTp3aW5kb3cteD0iNTAyIiAgICAgaW5rc2NhcGU6d2luZG93LXk9IjMwMiIgICAgIGlua3NjYXBlOndpbmRvdy1tYXhpbWl6ZWQ9IjAiICAgICBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJMYXllcl8xIj48aW5rc2NhcGU6Z3JpZCAgICAgICB0eXBlPSJ4eWdyaWQiICAgICAgIGlkPSJncmlkMzA0MSIgLz48L3NvZGlwb2RpOm5hbWVkdmlldz48cG9seWdvbiAgICAgcG9pbnRzPSIwLjE1LDAgMTQuNSwxNC4zNSAyOC44NSwwICIgICAgIGlkPSJwb2x5Z29uMzAzMyIgICAgIHRyYW5zZm9ybT0ibWF0cml4KDAuMzU0MTEzODcsMCwwLDAuNDgzMjkxMSw5LjMyNDE1NDUsMy42MjQ5OTkyKSIgICAgIHN0eWxlPSJmaWxsOiNkMWQxZDE7ZmlsbC1vcGFjaXR5OjEiIC8+PC9zdmc+) center right no-repeat;
}
select:focus {
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIgICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiICAgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjkgMTQiICAgaGVpZ2h0PSIxNHB4IiAgIGlkPSJMYXllcl8xIiAgIHZlcnNpb249IjEuMSIgICB2aWV3Qm94PSIwIDAgMjkgMTQiICAgd2lkdGg9IjI5cHgiICAgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjQ4LjQgcjk5MzkiICAgc29kaXBvZGk6ZG9jbmFtZT0iY2FyZXQuc3ZnIj48bWV0YWRhdGEgICAgIGlkPSJtZXRhZGF0YTMwMzkiPjxyZGY6UkRGPjxjYzpXb3JrICAgICAgICAgcmRmOmFib3V0PSIiPjxkYzpmb3JtYXQ+aW1hZ2Uvc3ZnK3htbDwvZGM6Zm9ybWF0PjxkYzp0eXBlICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPjwvY2M6V29yaz48L3JkZjpSREY+PC9tZXRhZGF0YT48ZGVmcyAgICAgaWQ9ImRlZnMzMDM3IiAvPjxzb2RpcG9kaTpuYW1lZHZpZXcgICAgIHBhZ2Vjb2xvcj0iI2ZmZmZmZiIgICAgIGJvcmRlcmNvbG9yPSIjNjY2NjY2IiAgICAgYm9yZGVyb3BhY2l0eT0iMSIgICAgIG9iamVjdHRvbGVyYW5jZT0iMTAiICAgICBncmlkdG9sZXJhbmNlPSIxMCIgICAgIGd1aWRldG9sZXJhbmNlPSIxMCIgICAgIGlua3NjYXBlOnBhZ2VvcGFjaXR5PSIwIiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIgICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iOTAzIiAgICAgaW5rc2NhcGU6d2luZG93LWhlaWdodD0iNTk0IiAgICAgaWQ9Im5hbWVkdmlldzMwMzUiICAgICBzaG93Z3JpZD0idHJ1ZSIgICAgIGlua3NjYXBlOnpvb209IjEyLjEzNzkzMSIgICAgIGlua3NjYXBlOmN4PSItNC4xMTkzMTgyZS0wOCIgICAgIGlua3NjYXBlOmN5PSI3IiAgICAgaW5rc2NhcGU6d2luZG93LXg9IjUwMiIgICAgIGlua3NjYXBlOndpbmRvdy15PSIzMDIiICAgICBpbmtzY2FwZTp3aW5kb3ctbWF4aW1pemVkPSIwIiAgICAgaW5rc2NhcGU6Y3VycmVudC1sYXllcj0iTGF5ZXJfMSI+PGlua3NjYXBlOmdyaWQgICAgICAgdHlwZT0ieHlncmlkIiAgICAgICBpZD0iZ3JpZDMwNDEiIC8+PC9zb2RpcG9kaTpuYW1lZHZpZXc+PHBvbHlnb24gICAgIHBvaW50cz0iMjguODUsMCAwLjE1LDAgMTQuNSwxNC4zNSAiICAgICBpZD0icG9seWdvbjMwMzMiICAgICB0cmFuc2Zvcm09Im1hdHJpeCgwLjM1NDExMzg3LDAsMCwwLjQ4MzI5MTEsOS4zMjQxNTUzLDMuNjI1KSIgICAgIHN0eWxlPSJmaWxsOiM5YjRkY2Y7ZmlsbC1vcGFjaXR5OjEiIC8+PC9zdmc+);
}

textarea {
  padding-bottom: 0.6rem;
  padding-top: 0.6rem;
  min-height: 6.5rem;
}

label,
legend {
  font-size: 1.6rem;
  font-weight: 700;
  display: block;
  margin-bottom: 0.5rem;
}

fieldset {
  border-width: 0;
  padding: 0;
}

input[type='checkbox'],
input[type='radio'] {
  display: inline;
}

.label-inline {
  font-weight: normal;
  display: inline-block;
  margin-left: 0.5rem;
}

.container {
  margin: 0 auto;
  max-width: 112rem;
  padding: 0 2rem;
  position: relative;
  width: 100%;
}

.row {
  display: flex;
  flex-direction: column;
  padding: 0;
  width: 100%;
}
.row .row-wrap {
  flex-wrap: wrap;
}
.row .row-no-padding {
  padding: 0;
}
.row .row-no-padding > .column {
  padding: 0;
}
.row .row-top {
  align-items: flex-start;
}
.row .row-bottom {
  align-items: flex-end;
}
.row .row-center {
  align-items: center;
}
.row .row-stretch {
  align-items: stretch;
}
.row .row-baseline {
  align-items: baseline;
}
.row .column {
  display: block;
  flex: 1;
  margin-left: 0;
  max-width: 100%;
  width: 100%;
}
.row .column .col-top {
  align-self: flex-start;
}
.row .column .col-bottom {
  align-self: flex-end;
}
.row .column .col-center {
  align-self: center;
}
.row .column.column-offset-10 {
  margin-left: 10%;
}
.row .column.column-offset-20 {
  margin-left: 20%;
}
.row .column.column-offset-25 {
  margin-left: 25%;
}
.row .column.column-offset-33, .row .column.column-offset-34 {
  margin-left: 33.3333%;
}
.row .column.column-offset-50 {
  margin-left: 50%;
}
.row .column.column-offset-66, .row .column.column-offset-67 {
  margin-left: 66.6666%;
}
.row .column.column-offset-75 {
  margin-left: 75%;
}
.row .column.column-offset-80 {
  margin-left: 80%;
}
.row .column.column-offset-90 {
  margin-left: 90%;
}
.row .column.column-10 {
  flex: 0 0 10%;
  max-width: 10%;
}
.row .column.column-20 {
  flex: 0 0 20%;
  max-width: 20%;
}
.row .column.column-25 {
  flex: 0 0 25%;
  max-width: 25%;
}
.row .column.column-33, .row .column.column-34 {
  flex: 0 0 33.3333%;
  max-width: 33.3333%;
}
.row .column.column-40 {
  flex: 0 0 40%;
  max-width: 40%;
}
.row .column.column-50 {
  flex: 0 0 50%;
  max-width: 50%;
}
.row .column.column-60 {
  flex: 0 0 60%;
  max-width: 60%;
}
.row .column.column-66, .row .column.column-67 {
  flex: 0 0 66.6666%;
  max-width: 66.6666%;
}
.row .column.column-75 {
  flex: 0 0 75%;
  max-width: 75%;
}
.row .column.column-80 {
  flex: 0 0 80%;
  max-width: 80%;
}
.row .column.column-90 {
  flex: 0 0 90%;
  max-width: 90%;
}

@media (min-width: 40rem) {
  .row {
    flex-direction: row;
    margin-left: -1rem;
    width: calc(100% + 2.0rem);
  }
  .row .column {
    margin-bottom: inherit;
    padding: 0 1rem;
  }
}
a {
  color: #9b4dca;
  text-decoration: none;
}
a:hover {
  color: #606c76;
}

dl,
ol,
ul {
  margin-top: 0;
  padding-left: 0;
}
dl ul,
dl ol,
ol ul,
ol ol,
ul ul,
ul ol {
  font-size: 90%;
  margin: 1.5rem 0 1.5rem 3rem;
}

dl {
  list-style: none;
}

ul {
  list-style: circle inside;
}

ol {
  list-style: decimal inside;
}

dt,
dd,
li {
  margin-bottom: 1rem;
}

.button,
button {
  margin-bottom: 1rem;
}

input,
textarea,
select,
fieldset {
  margin-bottom: 1.5rem;
}

pre,
blockquote,
dl,
figure,
table,
p,
ul,
ol,
form {
  margin-bottom: 2.5rem;
}

table {
  width: 100%;
}

th,
td {
  border-bottom: 0.1rem solid #e1e1e1;
  padding: 1.2rem 1.5rem;
  text-align: left;
}
th:first-child,
td:first-child {
  padding-left: 0;
}
th:last-child,
td:last-child {
  padding-right: 0;
}

p {
  margin-top: 0;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-weight: 300;
  margin-bottom: 2rem;
  margin-top: 0;
}

h1 {
  font-size: 4rem;
  letter-spacing: -0.1rem;
  line-height: 1.2;
}

h2 {
  font-size: 3.6rem;
  letter-spacing: -0.1rem;
  line-height: 1.25;
}

h3 {
  font-size: 3rem;
  letter-spacing: -0.1rem;
  line-height: 1.3;
}

h4 {
  font-size: 2.4rem;
  letter-spacing: -0.08rem;
  line-height: 1.35;
}

h5 {
  font-size: 1.8rem;
  letter-spacing: -0.05rem;
  line-height: 1.5;
}

h6 {
  font-size: 1.6rem;
  letter-spacing: 0;
  line-height: 1.4;
}

@media (min-width: 40rem) {
  h1 {
    font-size: 5rem;
  }

  h2 {
    font-size: 4.2rem;
  }

  h3 {
    font-size: 3.6rem;
  }

  h4 {
    font-size: 3rem;
  }

  h5 {
    font-size: 2.4rem;
  }

  h6 {
    font-size: 1.5rem;
  }
}
.float-right {
  float: right;
}

.float-left {
  float: left;
}

.clearfix {
  *zoom: 1;
}
.clearfix:after, .clearfix:before {
  content: "";
  display: table;
}
.clearfix:after {
  clear: both;
}

</style>


<script>
module.exports  = {
				props:{
					authorid: {default : '0'},
					eventexists: {default: false},
					editeventid: {default: ''},
				},
			  data: function() {
			    return {
			      sdate: '',
			      edate: '',
			      stime: '',
			      rdate: '',
			      ticketoptions: [
			        { text: 'Online', value: 'online'},
			        { text: 'Phone', value: 'phone'},
			        { text: 'Ticket Office', value: 'office'},
			        { text: 'Online, Phone and Ticket Office', value: 'all'},
			        { text: 'Other', value: 'other'},
			      ],
			      participants: [
							{ text: 'Campus Only', value: 'campus'},
			        { text: 'Open to Public', value: 'public'},
			        { text: 'Students Only', value: 'students'},
			        { text: 'Invitation Only', value: 'invite'},
			        { text: 'Tickets Required', value: 'tickets'},
			      ],
						totalChars: {
							start: 0,
							title: 100,
							description: 255
						},
						newbuilding: '',
						zcategories: [],
						zbuildings: [],
			      buildings: [],
						  zcats: [],
			      categories: {},
			      minicalendars: {},
			      newevent: {
								on_campus: 1,
								all_day: 0,
								no_end_time: 0,
								free: 0,
								title: '',
								description: ''
						},
			      response: {

						},
			      formStatus: {},
			      vModelLike: "",
						formMessage: {
							isOk: false,
							msg: ''
						},
			      formInputs : {},
			      formErrors : {}
			    }
			  },
				ready: function() {
					//  this.fetchCategoryList();
						// console.log('editevent='+ this.editevent)
							console.log('eventexists'+ this.eventexists)

						if(this.eventexists){
							console.log('editeventid'+ this.editeventid)
							this.fetchCurrentEvent(this.editeventid)

						}


						 this.fetchMiniCalendarList();
				},


			  computed: {
					computedLocation: function() {
						if (this.zbuildings) {
							this.newevent.building  = (this.zbuildings.length > 0)?this.zbuildings[0]:'';
							buildingChoice = 	this.newevent.building
						} else {
							return
						}
						var room = (this.newevent.room)?' - Room:' + this.newevent.room:'';
						return buildingChoice + room;
						// return this.zbuilding[0] + room
					},
					isOnCampus: function() {
						return this.newevent.on_campus == 1 ? true:false;
					},
					realCost: function() {
						if(this.newevent.free == 1 ) {
							return '0.00';
						} else {
							// this.newevent.cost = '';
							return '';
						}
						// return this.newevent.free == 1 ? false:true;
					},
					hasCost: function() {
						if(this.newevent.free == 1 ) {
							this.newevent.cost = '0.00';
							return false;
						} else {
							// this.newevent.cost = '';
							return true;
						}
						// return this.newevent.free == 1 ? false:true;
					},
					titleChars: function() {
						var str = this.newevent.title;


						console.log(str.length);
						var cclength = str.length;
						return this.totalChars.title - cclength;
						// this.totalChars.title - (this.newevent.title).length
					},
					descriptionChars: function() {
						var str = this.newevent.description;
						console.log(str.length);
						var cclength = str.length;
						return this.totalChars.description - cclength;
						// this.totalChars.title - (this.newevent.title).length
					},
					hasStartTime: function() {
						return this.newevent.all_day == 1? false : true;

					},
					hasEndTime: function() {
						return (this.newevent.all_day == 1 || this.newevent.no_end_time == 1)?false : true;
					}

			  },
			  methods: {
					fetchCurrentEvent: function() {
						this.$http.get('/api/event/'+ this.editeventid +'/edit')

							.then((response) =>{
									//response.status;
									console.log('response.status=' + response.status);
									console.log('response.ok=' + response.ok);
									console.log('response.statusText=' + response.statusText);
									// console.log('response.data=' + response.data.json());
									this.newevent = response.data;

									this.checkOverData();
								}, (response) => {
									//error callback
									console.log("ERRORS");

									// this.formErrors =  response.data.error.message;

								}).bind(this);
					},
					checkOverData: function() {

						if (this.newevent.building) {
							this.buildings.push(this.newevent.building);
						}
						if (this.newevent.room) {
							this.newevent.room = this.newevent.room;
						}

						if (this.newevent.eventcategories){
							for (var i= 0; i < this.newevent.eventcategories.length ; i++){
								var reduceobj = this.newevent.eventcategories[i].id;
								this.zcats.push(reduceobj)

							}

							console.log('this.zcats'+ this.zcats.length)
						}

						// this.newbuilding = this.newevent.building;
						// this.zbuilding.push(this.newevent.building);

					},
					fetchMiniCalendarList: function() {
			      this.$http.get('/api/minicalendars').then(function(response){
			        // console.log('response->minicalendars=' + JSON.stringify(response.data));
			        this.minicalendars = response.data.data;

			      }, function(response) {
			      //  this.$set(this.formErrors, response.data);
			          console.log(response);
			      });
			    },

			    submitForm: function(e) {
			    //  console.log('this.eventform=' + this.eventform.$valid);
					e.preventDefault();
			      // this.newevent.start_date = this.sdate;
			      // this.newevent.end_date = this.edate;
			      // this.newevent.reg_deadline = this.rdate;
			      this.newevent.author_id = this.authorid;
						if(this.newevent.on_campus == true) {
							this.newevent.location = this.computedLocation;
						} else {
							this.newevent.location = this.newevent.locationoffcampus;
						}
						// this.newevent.location = (this.on_campus)?this.computedLocation: this.newevent.location;
						this.newevent.categories = this.zcategories;
						console.log("cats="+ this.newevent.categories);
			      this.$http.post('/api/event', this.newevent)

							.then((response) =>{
									//response.status;
									console.log('response.status=' + response.status);
									console.log('response.ok=' + response.ok);
									console.log('response.statusText=' + response.statusText);
									console.log('response.data=' + response.data.message);
									this.formMessage.msg = response.data.message;
									this.formMessage.isOk = response.ok;
								}, (response) => {
									//error callback
									// console.log("FORM ERRORS     "+ response.json() );

									this.formErrors =  response.data.error.message;

								}).bind(this);
							}
						},

				watch: {

				},

				directives: {
					mydatedropper: require('../directives/mydatedropper.js'),
					mytimedropper: require('../directives/mytimedropper.js'),
					myselect: require('../directives/myselect.js')

				},
				components: {
					datepicker: require('../vendor/datepicker.vue')
						// listselect2: require('./ListSelect2.vue')
						// autocomplete: require('./vue-autocomplete.vue'),
				    // 'datepicker': require('../vendor/datepicker.vue'),

				},
				events: {

					// 'building-change':function(name) {
					// 	this.newbuilding = '';
					// 	this.newbuilding = name;
					// 	console.log(this.newbuilding);
					// },
					// 'categories-change':function(list) {
					// 	this.categories = '';
					// 	this.categories = list;
					// 	console.log(this.categories);
					// }
				}
};


</script>
