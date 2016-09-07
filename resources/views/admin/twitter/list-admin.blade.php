{{-- list-admin.blade.php --}}
<form action="/admin/approve-tweets" method="post">
{{ csrf_field() }}

@foreach($tweets as $tweet)
    <div class="tweet row">
        <div class="col-sm-8">
            @include('admin.twitter.tweet')
        </div>
        <div class="col-sm-4 approval">
            <label class="form-group">
                <input
                    type="radio"
                    name="approval-status-{{ $tweet->id }}"
                    value="1"
                    @if($tweet->approved)
                    checked="checked"
                    @endif
                    >
                Approved
            </label>
            <label class="form-group">
                <input
                    type="radio"
                    name="approval-status-{{ $tweet->id }}"
                    value="0"
                    @unless($tweet->approved)
                    checked="checked"
                    @endif
                    >
                Unapproved
            </label>
        </div>
    </div>
@endforeach

<div class="row">
    <div class="col-sm-12">
        <input type="submit" class="btn btn-primary pull-right" value="Approve Tweets">
    </div>
</div>

</form>

{!! $tweets->links() !!}
