@foreach($tweets as $tweet)
    <div class="tweet">
        @include('public.tweets.tweet')
    </div>
@endforeach
