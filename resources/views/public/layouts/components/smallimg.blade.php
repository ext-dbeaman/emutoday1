<div class="column four-stories-block">
  <img class="topic-image" src="{{$barImg->present()->mainImageURL}}" alt="story image">
  <div class="stories-content">
    <div class="stories-text-content" data-equalizer-watch>
      <p>{{$barImg->caption}}</p>
    </div>
    <p class="button-group">
      <a href="/emu-today/{{$barImg->story->story_folder}}/{{$barImg->story->id}}" class="button">{{$barImg->moretext}}<i class="fi-play"></i></a>
    </p>
  </div>
</div>
