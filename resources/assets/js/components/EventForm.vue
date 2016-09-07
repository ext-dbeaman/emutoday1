<template>

                <form>
                    <slot name="csrf"></slot>
                    <!-- <slot name="author_id" v-model="newevent.author_id"></slot> -->
                    <div class="row">
                        <div class="small-12 columns">
                            <div v-show="formMessage.isOk"  class="callout success">
                                <h5>{{formMessage.msg}}</h5>
                                    </div>
                            <!-- <div class="form-group">
                                <label>zBuilding</label>
                                    <select id="select-zbuilding" style="width: 75%" v-myselect="zbuilding"  ajaxurl="/api/zbuildings" data-placeholder="zbuildings" data-tags="false" multiple="multiple" data-maximum-selection-length="1">
                                        <option value="0">default</option>
                                    </select>
                            </div> -->
                            <!-- /.data-minimum-results-for-search="Infinity" data-maximum-input-length="0" form-group -->
                            <!-- <div class="form-group">
                                <label>zCats</label>
                                    <select id="select-zcats" style="width: 75%" v-myselect="zcategories" ajaxurl="/api/zcats" data-close-on-select="false" data-placeholder="zcats" data-tags="false"  multiple="multiple">
                                        <option value="0">
                                            default
                                        </option>
                                    </select>
                            </div> -->
                            <!-- /.form-group -->
                                <!-- <input v-model="newevent.building2" v-bind:class="[formErrors.building ? 'invalid-input' : '']" name="select-building" type="text"> -->
                                <div class="form-group">
                                    <label>Title <span v-bind:class="iconStar" class="reqstar"></span></label>
                                        <p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
                                        <input v-model="newevent.title" v-bind:class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text">
                                        <p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>
                            </div>
                                <div class="form-group">
                                    <label>Short Title	</label>
                                        <input v-model="newevent.short_title" type="text" placeholder="Short Title" name="short-title" >
                                </div>
                        </div><!-- /.small-12 columns -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="medium-6 columns">
                            <div class="form-group">
                                    <label>Is Event on Campus?
                                        <input id="on-campus-yes" name="on_campus" type="checkbox" value="1" v-model="newevent.on_campus"/>
                                    </label>
                            </div>
                        </div><!-- /.medium-6 columns -->
                        <div class="medium-6 columns">

                        </div><!-- /.medium-6 columns -->
                    </div><!-- /.row -->
                    <div class="row">
                            <div class="medium-12 column">
                                <template v-if="isOnCampus">
                                    <div class="row">
                                        <div class="medium-8 columns">
                                                <label>Building</label>
                                            <select id="select-zbuilding" class="js-example-basic-multiple" style="width: 100%" v-myselect="zbuildings"  ajaxurl="/api/zbuildings" v-bind:resultvalue="buildings" data-tags="false" multiple="multiple" data-maximum-selection-length="1">
                                                <!-- <option value="0">default</option> -->
                                            </select>
                                        </div><!-- /.medium-8 columns -->
                                        <div class="medium-4 columns">
                                            <label>Room</label>
                                            <input v-model="newevent.room" v-bind:class="[formErrors.room ? 'invalid-input' : '']" name="room" type="text">

                                        </div><!-- /.medium-4 columns -->
                                    </div><!-- /.row -->
                                </template>
                                <div class="row">
                                    <div class="medium-12 column">
                                        <template v-if="isOnCampus">
                                            <label>Location <span v-bind:class="iconStar" class="reqstar"></span></label>
                                                <input v-model="computedLocation" v-bind:class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text" readonly="readonly">
                                            </template>
                                            <template v-else>
                                                <label>Location <span v-bind:class="iconStar" class="reqstar"></span></label>
                                                <input v-model="newevent.locationoffcampus" v-bind:class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text">
                                            </template>
                                        </div><!-- /.medium-12 column -->
                                </div><!-- /.row -->
                            </div><!-- /.medium-12 column -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="small-6 columns">
                                <div class="form-group">
                                    <label for="start-date">Start Date: <span v-bind:class="iconStar" class="reqstar"></span></label>
                                    <input id="start-date" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" v-model="newevent.start_date" aria-describedby="errorStartDate" v-mydatedropper />
                                    <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
                                </div><!--form-group -->
                        </div><!-- /.small-6 columns -->
                        <div class="small-6 columns">
                                <div class="form-group">
                                        <label for="end-date">End Date: <span v-bind:class="iconStar" class="reqstar"></span></label>
                                        <input id="end-date" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="newevent.end_date"  aria-describedby="errorEndDate" v-mydatedropper />
                                        <!-- <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> -->
                                        <p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>

                                    </div><!--form-group -->
                        </div><!-- /.small-6 columns -->
                    </div><!-- /.row -->

                    <div class="row">
                            <div class="small-6 columns">
                                <div class="form-group">
                                  <label for="all-day">All Day Event:
                                    <input id="all-day" name="all_day" type="checkbox" value="1" v-model="newevent.all_day"/>
                                </label>
                                </div>
                            </div><!-- /.small-6 column -->
                            <div class="small-6 columns">
                                <div v-show="hasEndTime" class="form-group">
                                    <label for="no-end-time">No End Time:
                                        <input id="no-end-time" name="no_end_time" type="checkbox" value="1" v-model="newevent.no_end_time"/>
                                            <!-- <label for="no-end-time-no" class="radiobtns">no</label><input id="no-end-time-no"  name="no_end_time" type="radio" value="0" v-model="newevent.no_end_time"/> -->
                                        </div>
                            </div><!-- /.small-6 column -->
                    </div><!-- /.row -->
                    <div class="row">
                            <div class="medium-6 columns">
                                <div v-show="hasStartTime" class="form-group">
                                        <label for="start-time">Start Time: <span v-bind:class="iconStar" class="reqstar"></span></label>
                                    <input id="start-time" type="text" v-model="newevent.start_time" v-mytimedropper />
                                </div><!-- /.form-group -->
                            </div><!-- /.medium-6 columns -->
                            <div class="medium-6 columns">
                                <div v-show="hasEndTime" class="form-group">
                                <label for="end-time">End Time: <span v-bind:class="iconStar" class="reqstar"></span></label>
                                <input id="end-time" type="text" v-model="newevent.end_time" v-mytimedropper />
                                    </div><!-- /.form-group -->
                            </div><!-- /.medium-6 columns -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="small-12 column">
                            <div class="form-group">
                                <label>Categories: <span v-bind:class="iconStar" class="reqstar"></span></label>
                                <select  v-bind:class="[formErrors.categories ? 'invalid-input' : '']" id="select-zcats" style="width: 100%" v-myselect="zcategories" v-bind:resultvalue="zcats" ajaxurl="/api/zcats" data-close-on-select="false" data-placeholder="zcats" data-tags="false"  multiple="multiple">
                                    <option value="0">
                                        default
                                    </option>
                                </select>
                                    <!-- <listselect2 v-on:val-change="categoriesValChange" v-bind:class="[formErrors.categories ? 'invalid-input' : '']" id="select-categories" ismultiple='true' :resultvalue.sync="newevent.categoriessync" ajaxurl="/api/zevent-catgeories" minforsearch="Infinity" tags="false" placeholder="Choose Categories"></listselect2> -->
                            </div><!-- /.form-group -->
                                    <!-- <div class="form-group" v-bind:class="[formErrors.categories ? 'invalid-input' : '']">

                                            <label for="categories">Categories:</label>
                                            <select v-model="newevent.categories" id="categories" multiple="multiple" class="multiselect">
                                                <option v-for="category in categories" :value="category.id">
                                                    {{category.category}}
                                                </option>
                                        </select>
                                    </div> -->
                        </div><!-- /.small-12 column -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="medium-6 columns">
                            <div class="form-group">
                                <label>Contact Person <span v-bind:class="iconStar" class="reqstar"></span>
                                    <input v-model="newevent.contact_person" v-bind:class="[formErrors.contact_person ? 'invalid-input' : '']" name="contact-person" type="text">
                                    <p v-if="formErrors.contact_person" class="help-text invalid">Need a Contact Person!</p>
                                </label>
                            </div>
                        </div><!-- /.medium-6 columns -->
                        <div class="medium-6 columns">
                            <div class="form-group">
                                <label>Contact Email: <span v-bind:class="iconStar" class="reqstar"></span> <em>(ex. janedoe@emich.edu)</em>
                                    <input v-model="newevent.contact_email" v-bind:class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact-email" type="text">
                                    <p v-if="formErrors.contact_email" class="help-text invalid">Need a Contact Email!</p>
                                </label>
                            </div>
                        </div><!-- /.medium-6 columns -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="medium-6 columns">
                            <div class="form-group">

                                <label>Contact Phone <span v-bind:class="iconStar" class="reqstar"></span> <em>(ex. 734.487.1849)</em>
                                    <input v-model="newevent.contact_phone" v-bind:class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact-phone" type="text">
                                    <p v-if="formErrors.contact_phone" class="help-text invalid">Need a Contact Phone!</p>
                                </label>
                            </div>
                        </div><!-- /.medium-6 columns -->
                        <div class="medium-6 columns">
                            <div class="form-group">
                                <label>Contact Fax: <em>(ex. 734.487.1849)</em>
                                    <input v-model="newevent.contact_fax" v-bind:class="[formErrors.contact_fax ? 'invalid-input' : '']" name="contact-fax" type="text">
                                </label>
                            </div>
                        </div><!-- /.medium-6 columns -->
                    </div><!-- /.row -->
                    <div class="row">
                            <div class="medium-12 column">
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
                            </div><!-- /.medium-12 column -->
                    </div><!-- /.row -->
                    <div class="row">
                            <div class="medium-6 columns">
                                <div class="form-group">
                                    <label for="reg-deadline">Registration Deadline</label>
                                    <input id="reg-deadline" type="text" v-model="newevent.reg_deadline" :value.sync="rdate" aria-describedby="errorRegDeadline" v-mydatedropper />
                                </div>
                            </div><!-- /.medium-6 columns-->
                        </div><!-- /.row -->
                        <div class="row">
                                <div class="medium-12 columns">

                                        <div class="row">
                                            <div class="medium-4 columns">
                                                <label>Free</label>
                                                <div class="form-group">
                                                    <input id="free" name="free" type="checkbox" value="1" v-model="newevent.free"/>
                                            </div><!-- /.form-group -->
                                            </div><!-- /.medium-4 columns -->
                                            <div class="medium-8 columns">
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
                                            </div><!-- /.medium-8 columns -->
                                        </div><!-- /.row -->


                            </div><!-- /.medium-6 -->
                    </div><!-- /.row -->
                    <div class="row">
                                <div class="medium-12 column">
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
                                </div><!-- /.form-group -->
                            </div><!-- /.medium-12 column -->
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
                            <div class="medium-6 columns">
                                <div class="form-group">
                                    <label for="lbc-reviewed">LBC Approved: <em>(pre-approval required)</em>
                                    <input id="lbc-reviewed" name="lbc-reviewed" type="checkbox" value="1" v-model="newevent.lbc_reviewed"/>
                                </label>
                                </div>
                            </div><!-- /.medium-6 columns -->
                            <div class="medium-6 columns">

                            </div><!-- /.medium-6 columns -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="medium-12 column">
                                <div class="form-group">
                                    <label>Description <i class="fi-star reqstar"></i> <p class="help-text" id="description-helptext">({{descriptionChars}} characters left)</p>

                                    <textarea v-model="newevent.description" v-bind:class="[formErrors.description ? 'invalid-input' : '']" name="description" type="textarea" rows="6"></textarea>
                                </label>
                                <p v-if="formErrors.description" class="help-text invalid">Need a Description!</p>

                                </div>
                            </div><!-- /.medium-12 column -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="medium-12 column">

                                <div class="form-group">
                            <label>Group Website Calendar <p class="help-text" id="minicalendar-helptext">If your groups website has a calendar that is fed from this one, and you would like this event to show up on it, please select it from the list below:</p>
                                    <select v-model="newevent.mini_calendar" id="mini_calendar">
                                <option v-for="minicalendar in minicalendars" :value="minicalendar.id">
                                    {{minicalendar.calendar}}
                                </option>
                            </select>
                            </label>
                            </div>
                        </div><!-- /.medium-12 column -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="medium-12 column">
                            <div class="form-group">
                                <button v-on:click="submitForm" type="submit" class="button button-primary">Submit For Approval</button>
                            </div>
                                </form>
                        </div><!-- /.medium-12 column -->


</template>
<style scoped>
 p {
     margin:0;
 }
      label {
           display: block;
           /*margin-bottom: 1.5em;*/
       }

       label > span {
           display: inline-block;
           width: 8em;
           vertical-align: top;
       }
.valid-titleField {
  background-color: #fefefe;
  border-color: #cacaca;
}
.no-input {
  background-color: #fefefe;
  border-color: #cacaca;
}
.invalid-input {
  background-color: rgba(236, 88, 64, 0.1);
  border: 1px dotted red;
}
.invalid {
  color: #ff0000;
}


fieldset label.radiobtns  {
  display: inline;
  margin: 4px;
  padding: 2px;
}

[type='text'], [type='password'], [type='date'], [type='datetime'], [type='datetime-local'], [type='month'], [type='week'], [type='email'], [type='number'], [type='search'], [type='tel'], [type='time'], [type='url'], [type='color'],
textarea {
    margin: 0;
    padding: 0;
    padding-left: 8px;
}
[type='file'], [type='checkbox'], [type='radio'] {
    margin: 0;
    margin-left: 8px;
    padding: 0;
    padding-left: 2px;
}
.reqstar {
    font-size: .5rem;
    color: #E33100;
        vertical-align:text-top;
}
button.button-primary {
    margin-top: 1rem;
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
                        this.$http.get('/api/event/'+ this.editeventid)

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
                                    // .then(function(response){
                      //get status
                              // response.status;
                                //   console.log('response.status=' + response.status);
                                //   console.log('response.ok=' + response.ok);
                                //     console.log('response.statusText=' + response.statusText);
                                //     console.log('response.request=' + JSON.stringify(response.request));

                                                // var responseData = response.data;

                                                // console.log('response-length=' + responseData.length);

                                            // for (var key in responseData){
                                            //     var attrName = key;
                                            //     var attrValue = responseData[key];
                                                // 		console.log('attrName='+attrName +'____attrValue='+attrValue);
                                            // }




                      // // //get all headers
                      // response.headers();
                      // // //get 'expirese' header
                      // response.headers('expires');
                                //
                      // //set data on vm
                      // if (response.data.errors){
                                // 	console.log('has errrrrrrrrrrrrors');
                      //     this.formErrors = response.data.errors;
                                //
                      // } else {
                      //   this.formErrors = {};
                      // }
                                // console.log('json-'+JSON.stringify(response.data));
              //     }, function(response) {
                // 				console.log(this.newevent.title);
                // 				console.log("FORM ERRORS     "+ JSON.stringify(response.data));
                //
              //       	this.formErrors =  response.data.error.message;
                //
              //     }).bind(this);
              //   }
              // },
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
