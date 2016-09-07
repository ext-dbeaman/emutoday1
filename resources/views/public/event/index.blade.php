<!-- Event Views with Vues -->
@extends('public.layouts.global')
@section('content')
  <div id="content-area">
        <div id="calendar-bar">
            <div class="row">
              <div class="large-12 medium-12 small-12 columns">
                <div class="row">
                  <div class="large-12 medium-12 small-12 columns"><h3 class="cal-caps toptitle">Events Calendar</h3></div>
                </div>
                <div id="five-events-container" class="row">

                  <div class="large-12 medium-12 small-12 columns">

                    <div id="five-events-bar">
                      <div id="news-title-bar" class="row">
                        <div class="large-12 medium-12 show-for-medium columns">
                          <h5 class="subhead-title">Featured Events</h5>
                        </div>
                      </div>

                      <div class="row large-up-5 medium-up-3 show-for-medium" data-equalizer>
                        <div class="column">
                          <div class="date-tag">Jul 22</div>
                          <img class="topic-image" src="/assets/imgs/calendar/baseball.png" alt="calendar-feature"/>
                          <div class="calendar-content">
                            <div class="calendar-text-content" data-equalizer-watch>
                              <h6>TRUEMU night at Comerica Park</h6>
                              <p>From 7:00 PM to 10:00 PM</p>
                              <p>Comerica Park </p>
                            </div>
                          </div>
                        </div>
                        <div class="column">
                          <div class="date-tag">Jul 25</div>
                          <img  class="topic-image" src="/assets/imgs/calendar/saturn.png" alt="calendar-feature"/>
                          <div class="calendar-content">
                            <div class="calendar-text-content" data-equalizer-watch>
                              <h6>Saturn: Jewel of the Heavens</h6>
                              <p>From 7:00 PM to 10:00 PM</p>
                              <p>MJ Science Complex - 402</p>
                            </div>

                          </div>
                        </div>
                        <div class="column">
                          <div class="date-tag">Jul 28</div>
                          <img  class="topic-image" src="/assets/imgs/calendar/nursing.png" alt="calendar-feature"/>
                          <div class="calendar-content">
                            <div class="calendar-text-content" data-equalizer-watch>
                              <h6>Learn about the BS in Nursing</h6>
                              <p>From 3:30 PM to 4:30 PM</p>
                              <p>Marshall Building - 108</p>
                            </div>
                          </div>
                        </div>
                        <div class="column">
                          <div class="date-tag">Jul 31</div>
                          <img  class="topic-image" src="/assets/imgs/calendar/horse.png" alt="calendar-feature"/>
                          <div class="calendar-content">
                            <div class="calendar-text-content" data-equalizer-watch>
                              <h6>The Gala of the Royal Horses</h6>
                              <p>From 7:00 PM to 9:00 PM</p>
                              <p>Convocation Center - Arena</p>
                            </div>
                          </div>
                        </div>
                        <div class="column">
                          <div class="date-tag">Sep 10</div>
                          <img  class="topic-image" src="/assets/imgs/calendar/note.png" alt="calendar-feature"/>
                          <div class="calendar-content">
                            <div class="calendar-text-content" data-equalizer-watch>
                              <h6>Campus Jam </h6>
                              <p>From 5:00 PM to 10:00 PM</p>
                              <p>Student Center Patio</p>
                            </div>
                          </div>
                        </div>
                      </div><!-- row event block grid end -->
                    </div> <!--end of five events bar-->


                  </div>
                </div><!--row 2 in calendar bar-->
              </div><!--end calendar row column-->

        </div><!--end calendar bar row 1-->

        <div id="vueapp">
        <component  :var-year-unit="{!! $varYearUnit !!}" }}
                    :var-month-unit="{!! $varMonthUnit !!}"
                    :var-day-unit="{!! $varDayUnit !!}"
                    is="event-view">
        </component>
      </div><!-- end calendar-bar -->
</div> <!-- end content-area -->
@endsection

@section('scriptsfooter')
  @parent
  <script type="text/javascript" src="/js/main.js"></script>
@endsection
