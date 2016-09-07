<div id="connection-bar" data-equalizer>
	<div id="all-connections" data-equalizer-watch>
		<div id="white-bar">
			<div id="tier1-nav">
				<div class="row">
					<div class="large-9 large-push-3 medium-10 medium-push-2 small-10 small-push-2 columns">
						<div class="row">
							<div class="large-5 medium-7 small-12 columns">
								<h1><a href="/emu-today/hub"><span class="first-word">EMU</span> Today</a></h1>
							</div>
							<div class="large-7 medium-5 small-12 columns">
								<div class="icon-menu float-right">
									<span class="search-area"><a href="#">Search <i class="fi-magnifying-glass"></i></a></span>
									<span class="menu-area show-for-small-only"><a href="#" data-toggle="offCanvasRight">Menu <i class="fi-list"></i></a></span>
								</div> <!-- .icon-menu -->

{{--
									<li class="search-area"><a class="search-glass" href="">Search</a></li>
									<li class="menu-area"><a class="menu-icon" href="">Menu</a></li> --}}

							</div>
						</div>
					</div><!-- large-9 -->
					<div class="large-3 large-pull-9 medium-2 medium-pull-10 small-2 small-pull-10 columns">
						<div id="logo-box" data-equalizer-watch>
							<a href="http://www.emich.edu"><img class="full-logo show-for-large" alt="Eastern Michigan University" src="/assets/imgs/home/logo.png"></a>
							<a href="http://www.emich.edu"><img class="emu show-for-medium-only" alt="Eastern Michigan University" src="/assets/imgs/home/emu.png"></a>
							<a href="http://www.emich.edu"><img class="block-e show-for-small-only" alt="Eastern Michigan University" src="/assets/imgs/home/blockewhiteplain.png"></a>

							{{-- <a href="http://www.emich.edu">
								<img data-interchange="[/assets/imgs/home/emu.png, small], [/assets/imgs/home/blockewhiteplain.png, medium], [/assets/imgs/home/logo.png, large]">
							</a> --}}
						</div><!-- logo-box -->
					</div><!-- large-3 -->
				</div><!-- row -->
			</div><!--tier1-nav -->
		</div><!-- white-bar -->

		<div id="transparent-bar">
			<div id="tier2-nav" class="row">
				<div class="large-10 large-push-2 medium-10 medium-push-2 columns">
					<div class="row">
						<div class="large-12 medium-12 show-for-medium columns">
							<!-- '/admin/php/top_nav.php'); -->
							<ul>
								<li><a class="{{ set_active('emu-today/hub', 'right-arrow')}}" href="/emu-today/hub">Today</a></li>
								<li ><a class="{{ set_active('emu-today/calendar', 'right-arrow')}}" href="/emu-today/calendar">Calendar</a></li>
								<li ><a class="{{ set_active('emu-today/announcement', 'right-arrow')}}" href="/emu-today/announcement">Announcements</a></li>
								<li ><a class="{{ set_active('emu-today/news', 'right-arrow')}}" href="/emu-today/news">News</a></li>
								<li ><a class="{{ set_active('emu-today/student', 'right-arrow', 1)}}" href="/emu-today/student">Student Profiles</a></li>
								<li><a href="#">Athletics</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="large-2 large-pull-10 medium-2 medium-pull-10 small-2 small-pull-10 columns">&nbsp;</div>
			</div> <!-- tier2-nav -->
		</div><!-- transparent-bar -->

		<div id="secondary-bar">
			<div id="tier3-nav" class="row">
				<div class="large-10 large-push-2 medium-10 medium-push-2 show-for-medium columns">
					<div class="row">
						<div class="large-12 show-for-medium columns">
						<ul>
							<!-- '/admin/php/secondary_nav.php'); -->
							<li><a href="#">For the Media</a></li>
							<li><a href="/emu-today/magazine">Eastern Magazine</a></li>
							<li><a href="#">Submit an Event</a></li>
							<li><a href="#">Submit an Announcement</a></li>
						</ul>
					</div>
					</div>
				</div>
				<div class="large-2 large-pull-10 medium-2 medium-pull-10 show-for-medium columns">
				</div>
			</div>
		</div><!-- secondary-bar -->

	</div><!-- #all-connections -->
</div> <!-- #connection-bar -->
