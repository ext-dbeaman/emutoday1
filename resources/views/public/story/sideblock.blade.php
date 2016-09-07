<div class="featured-content-block">
    <h6 class="headline-block lt-green">{!! $sidetitle !!}</h6>
    {{-- {{  dd($sideitems->first()->present()->mainImageURL)}} --}}
    <a href="#"><img src="{{$sideitems->first()->present()->mainImageURL }}" /></a>
    <ul class="feature-list">
    @foreach($sideitems as $sideitem)
      <li><a href="/emu-today/{{$sideitem->story->id}}">{{ $sideitem->caption }}</a></li>
    @endforeach
    </ul>
</div>
