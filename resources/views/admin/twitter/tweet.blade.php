
<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header">
              <div class="widget-user-image">
                <img class="img-circle" src="{{ $tweet->user_avatar_url }}" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{ '@' . $tweet->user_screen_name }}</h3>
              <h5 class="widget-user-desc">{{ $tweet->tweet_text }}</h5>
							<a  href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id }}" class="btn btn-block btn-social btn-twitter">
								<i class="fa fa-twitter"></i>View on Twitter
							</a>
            </div>
            <div class="box-footer no-padding">

  </div>
          </div>
