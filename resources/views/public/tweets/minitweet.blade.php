{{-- tweet.blade.php --}}
<div class="media-object">
    <div class="media-object-section">
        <h5>{{ '@' . $tweet->user_screen_name }}</h5>
        <p>{{ $tweet->tweet_text }}</p>
        <a target="_blank" href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id }}">
            View on Twitter
        </a>
    </div>
</div>
