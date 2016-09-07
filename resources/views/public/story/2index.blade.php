@extends('public.layouts.master')
@section('content')

  <div id="content-area">
    <div id="news-bar">
      <div class="row">
        <h3 class="news-caps manageleftpadding">Featured!</h3>
        <div class="large-7 medium-12 small-12 columns manageleftpadding">
          <img src="{{$heroImg->present()->mainImageURL}}" alt="featured image">
        </div>
        <div id="featured-text" class="large-5 medium-12 small-12 columns">
          <h3>{{$heroImg->caption}}</h3>
          <p>{{$heroImg->teaser}}</p>
          <p class="button-group"><a href="storytype/{{$heroImg->story->story_type}}/{{$heroImg->story->id}}" class="button">{{$heroImg->moretext}}</a></p>
        </div>
      </div>
    </div>
    <div id="four-stories-bar">
      <div id="news-title-bar" class="row">
        <div class="large-12 medium-12 small-12 columns manageleftpadding">
          <h5 class="subhead-title">Featured News Stories</h5>
        </div>
      </div>
      <div class="row small-up-2 medium-up-2 large-up-4">
        @each('public.layouts.components.smallimg', $barImgs, 'barImg')
      </div>
    </div>
    <div id="news-headline-bar">
      <div class="row">
         <div class="large-9 medium-8 small-12 columns manageleftpadding">
           <div class="row">
             <ul class="tabs" data-tabs id="newshub-tabs">
                  <li class="tabs-title is-active"><a href="#newshub-headlines-front" aria-selected="true"><p class="subhead-title">News Headlines</p></a></li>
                  <li class="tabs-title"><a href="#newshub-announcements-front"><p class="subhead-title">Announcements</p></a></li>
                </ul>
                <div class="tabs-content" data-tabs-content="newshub-tabs">
                  <div class="tabs-panel newshub-tab-front is-active" id="newshub-headlines-front">
                    <ul>
                      @foreach ($currentStorysBasic as $basicstory)
                      <li><a href="/news/{{$basicstory->id}}">{{$basicstory->title}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="tabs-panel newshub-tab-front" id="newshub-announcements-front">
                    <ul>
                      @foreach ($currentAnnouncements as $announcement)
                      <li><a href="/announcement/{{$announcement->id}}">{{$announcement->title}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
           </div>
         </div>
         <div class="large-3 medium-3 small-12 columns">
              <div class="featured-content-block">
                  <h6 class="headline-block">Featured video</h6>
                  <a href="https://www.youtube.com/watch?v=v-3BGoQtOsY" target="blank"><img src="{{theme('imgs/home/video_featured.png')}}" alt="featured video"></a>
                  <p><a href="https://www.youtube.com/watch?v=v-3BGoQtOsY" target="blank">Out of the Park Lunch by the Lake All-Campus Picnic</a></p>
             </div>
         </div>

      </div>
 </div>
     </div>
     <div id="active-bar">
       <div id="containingbox" class="row">
           <!--Calendar-->
            <div id="calendar-info" class="large-4 medium-6 small-12 columns manageleftpadding">
                <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
                    <h5 class="subhead-title">Events Calendar</h5>
                    </div>
                </div>
                <div id="newshub-calendar-front">
                   <ul class="calendar-event-group">
                     @foreach ($events as $event)
                        <li class="row calendar-unit">
                          <div class="large-2 medium-2 small-2 columns nopadding date-box">
                            <p>{{$event->present()->eventStartDateMonth}}</p>
                              <p>{{$event->present()->eventStartDateDay}}</p>
                          </div>
                          <div class="large-10 medium-10 small-10 columns">
                           <p class="datecontent-box"><a href="">{{$event->title}}</a></p>
                          </div>
                        </li>
                     @endforeach
                    </ul>
                    <p><a href="">More Events</a></p>
                    </div>
                </div>


           <!--Twitter-->
           <div id="twitter-info" class="large-5 medium-6 small-12 columns">
               <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
                    <h5 class="subhead-title">Twitter</h5>
                    </div>
                </div>
                <div class="twitter-feed">
                  <ul class="twitter-content">
                       <li><a href="">EMU_Swoop</a> .@kimschatzel, good luck on your first day as interim president! </li>
                       <li><a href="">EMU_Swoop RT</a> @emusg: RT to say Thank you President Martin for all she's done for EMU over the past 7 years. #goodluck #truEMU #emu #thanks @EMU_Swoop </li>
                       <li><a href="">EMU_Swoop RT</a> @EMUAlumni: Alumni Legacy Scholarship Winner #1 - Congratulations Brielle Bashore! #TRUEMU http://t.co/wI9m7QoWOH http://t.co/pCzbjwjTha</li>
                    </ul>
                    <div class="twitterlink">
                        <p><a href="">See all EMU twitter Feeds</a></p>
                        <ul class="social-icons">
                        <li>
                            <a href="https://www.facebook.com/Eastern.Michigan.University">
                                <img alt="Facebook" src="{{theme('imgs/icons/facebook_icon23x23.png')}}">
                            </a>
                        </li>
                        <li>
                            <a href="http://www.emich.edu/twitter/">
                                <img alt="Twitter" src="{{theme('imgs/icons/twitter_icon23x23.png')}}">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/user/emichigan08">
                                <img alt="YouTube" src="{{theme('imgs/icons/youtube_icon23x23.png')}}">
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com/easternmichigan/">
                                <img alt="Instagram" src="{{theme('imgs/icons/instagram_icon23x23.png')}}">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/edu/school?id=18604">
                                <img alt="Linked-In" src="{{theme('imgs/icons//linked-in_icon23x23.png')}}">
                            </a>
                        </li>
                      </ul>
                    </div>
               </div>
           </div>



           <!--Working at EMU-->
           <div class="large-3 medium-12 small-12 columns">
             <div class="featured-content-block">
               <h6 class="headline-block">Working @ EMU</h6>
               <ul class="feature-list">
                 <li><a href="">Training for something that would interest the campus community</a></li>
                 <li><a href="">An announcement from HR that is interesting to people employed at EMU</a></li>
                 <li><a href="">Get Duo 2-Factor Authentication To Help Combat Phishing Attacks. Sign up today </a></li>
                 <!-- <li><a href="">Health care sign up in going on now. For more information contact Joan Johnson.</a></li> -->
               </ul>
             </div>
           </div>
         </div>
       </div>
  </div>
@endsection
