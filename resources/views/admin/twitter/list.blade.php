@foreach($tweets as $tweet)
    <div class="tweet">
        @include('admin.twitter.tweet')
    </div>
@endforeach
