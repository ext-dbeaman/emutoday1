<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @yield('head')

  </head>
  <body>
    <div class="off-canvas-wrapper">
      <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
          <div class="off-canvas position-right" id="offCanvas" data-off-canvas>
            <ul class="off-canvas-list"><!-- include($_SERVER['DOCUMENT_ROOT'].'/emu-today/admin/php/top_nav.php'); -->
            <li><a href="#">Today</a></li>
            <li><a href="#">Calendar</a></li>
            <li><a href="#">Announcements</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Student Profiles</a></li>
            <li><a href="#">Athletics</a></li>
            </ul>
            <ul class="off-canvas-list alt"><!-- include($_SERVER['DOCUMENT_ROOT'].'/emu-today/admin/php/secondary_nav.php'); -->
            <li><a href="#">Media Highlights</a></li>
            <li><a href="#">Eastern Magazine</a></li>
            <li><a href="#">Submit an Event</a></li>
            <li><a href="#">Submit an Announcement</a></li>
            </ul>
          </div> <!-- END off-canvas position-right -->
        <div class="off-canvas-content" data-off-canvas-content>
          <div id="connection-bar" data-equalizer>
            <div id="all-connections" data-equalizer-watch>
            @yield('topbar')

          </div> <!-- all-connections -->
        </div> <!-- connection-bar -->

   <section class="main-section">
         @yield('content')
  </section>


  <a class="exit-off-canvas"></a>
      <!-- php $wrapper->base(); -->
      @yield('bottombar')


    </div><!-- off-canvas-content -->
    </div><!-- off-canvas-wrapper-inner -->
 </div> <!-- off-canvas-content -->
 @yield('footer')


  </body>
</html>
