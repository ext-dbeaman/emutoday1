@extends('public.layouts.master')

@section('title', 'EMU Today Home Page')

@section('content')
<div id="content-area">
     <div id="news-bar">
    <div class="row">
      <!-- if ($featured): -->
             <h3 class="news-caps manageleftpadding">Featured</h3>

     <div class="large-7 medium-12 small-12 columns manageleftpadding">
        <img src="#" alt="featured image">

        </div>
     <div id="featured-text" class="large-5 medium-12 small-12 columns">
         <h3><!--= $featured['title'] --></h3>
        <p><!-- = substr($featured['release'], 0, strpos($featured['release'], '</p>') +4 ) --></p>
         <p class="button-group"><a href="#" class="button">Read More</a></p>
        </div>

    <!-- endif; -->
    </div>


    </div>
    <div id="four-stories-bar">
        <div id="news-title-bar" class="row">
            <div class="large-12 medium-12 small-12 columns manageleftpadding">
                <h5 class="subhead-title">Featured News Stories</h5>
            </div>
        </div>
        <div class="row" >
            <!-- if (count($stories)): -->
            <ul class="small-block-grid-2 medium-block-grid-2 large-block-grid-4 manageleftpadding" data-equalizer>
                 <!-- foreach ($stories as $story): -->
                 <li>
                     <img class="topic-image" src="#" alt="#"/>
                      <div class="stories-content">
                          <div class="stories-text-content" data-equalizer-watch>
                     <p><!--= $story['teaser'] --></p>
                          </div>
                     <p class="button-group"><a href="#" class="button"><!--= $story['more_text'] --> <img class="news-icon" src="images/readmore-arrow.png" alt="Read more button"></a></p>
                     </div>
                </li>
                 <!-- endforeach; -->
             <!-- endif; -->
         </ul>

        </div>

    </div>

    <div id="news-headline-bar">
    <div class="row">

         <div class="large-9 medium-8 small-12 columns manageleftpadding">
             <div class="row">
                 <div class="large-6 medium-6 small-6 columns">
                   <ul class="tabs" data-tab="" role="tablist">
                     <li class="tab-title active"><a href="#panel1">News Headlines</a></li>
                     <li class="tab-title"><a href="#panel2">Announcements</a></li>
                   </ul>
                 </div>
                 <div class="large-6 medium-6 small-6 columns">
                 <h6 class="subhead-title goright"><a href="/emu-today/news/">See All Headlines</a></h6>

                 </div>
             </div>
             <div class="tabs-content">
                 <div class="content active" id="panel1">
                 <div id="newshub-headlines-front">
                 <!-- if (count($releases)): -->
                 <ul>
                     <!-- foreach($releases as $release): -->
                         <li>-</li>
                     <!-- endforeach; -->
                 </ul>
                 <!-- endif; -->
                 </div>
             </div>
            <div class="content" id="panel2">
                 <div id="newshub-headlines-front">
                 <!-- if (count($announcements)): -->
                 <ul>
                     <!-- foreach($announcements as $announcement): -->
                     <li>-</li>
                     <!-- endforeach; -->
                 </ul>
                 <!-- endif; -->
                 </div>
             </div>
             </div>
         </div>
        <div class="large-3 medium-3 small-12 columns">

             <div class="featured-content-block">
                 <h6 class="headline-block">Featured video</h6>
                 <a href="https://www.youtube.com/watch?v=v-3BGoQtOsY" target="blank"><img src="images/lunchbylake.png" alt="featured video"></a>
                 <p><a href="https://www.youtube.com/watch?v=v-3BGoQtOsY" target="blank">Out of the Park Lunch by the Lake All-Campus Picnic</a></p>

            </div>

        </div>
    </div>

    </div>


    <div id="active-bar">
    <div id="containingbox" class="row">
        <!--Calendar-->
         <div  id="calendar-info" class="large-4 medium-6 small-12 columns manageleftpadding">
             <div class="row">
                 <div class="large-12 medium-12 small-12 columns">
                 <h5 class="subhead-title">Events Calendar</h5>
                 </div>
             </div>
             <div id="newshub-calendar-front">

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
                 </ul>
                 <div class="twitterlink">
                     <p><a href="/twitter/">See all EMU twitter Feeds</a></p>

                     <ul class="social-icons">
                         <li><a href="https://www.facebook.com/Eastern.Michigan.University"><img alt="Facebook" src="{{ '/assets/imgs/icons/facebook_icon23x23.png'}}"></a></li>
                         <li><a href="http://www.emich.edu/twitter/"><img alt="Twitter" src="{{ '/assets/imgs/icons/twitter_icon23x23.png' }}"></a></li>
                         <li><a href="https://www.youtube.com/user/emichigan08"><img alt="YouTube" src="{{ '/assets/imgs/icons/youtube_icon23x23.png'}}"></a></li>
                         <li><a href="https://instagram.com/easternmichigan/"><img alt="Instagram" src="{{ '/assets/imgs/icons/instagram_icon23x23.png' }}"></a></li>
                         <li><a href="https://www.linkedin.com/edu/school?id=18604"><img alt="Linked-In" src="{{ '/assets/imgs/icons//linked-in_icon23x23.png' }}"></a></li>
                     </ul>
                 </div>
            </div>
        </div>



        <!--Working at EMU-->
        <div class="large-3 medium-12 small-12 columns">
             <div class="featured-content-block">
                 <h6 class="headline-block">Working &#64; EMU</h6>

               <ul class="feature-list">
                    <li><a href="">Training for something that would interest the campus community</a></li>
                    <li><a href="">An announcement from HR that is interesting to people employed at EMU</a></li>
                    <li><a href="">Get Duo 2-Factor Authentication To Help Combat Phishing Attacks. Sign up today </a></li>
                 </ul>


            </div>
        </div>
    </div>
     </div>
   </div>   <!--end content area-->

   @endsection
