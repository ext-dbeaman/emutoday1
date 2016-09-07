@extends('public.layouts.global')
@section('title', 'Preview Story')
@section('styles')
  @parent
    <!-- <link rel="stylesheet" href="{{'/assets/vendor/ckeditor/sdk-inline.css'}}" /> -->
    @endsection
@section('scriptshead')
      @parent
    <script src="{{ '/assets/vendor/ckeditor/ckeditor.js'}}"></script>
@endsection
@section('content')
  <div id="content-area">
    <div id="four-stories-bar">
      <div id="news-title-bar" class="row">
        <div class="large-12 medium-12 small-12 columns">
          <h5 class="subhead-title">Featured News Stories</h5>
        </div>
      </div>
      <div class="row row small-up-1 medium-up-2 large-up-4" data-equalizer="">
        <div class="column">
					<a href=""><img class="topic-image" src="{{$smallStoryImg->present()->mainImageURL }}" alt="story image"></a>
					<div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
							<p><a href="">{{ $smallStoryImg->teaser }}</p></li>
            </div>
            <p class="button-group"><a href="#" class="button">{{ $smallStoryImg->teaser }}<i class="fi-play"></i></a></p>
          </div>
        </div>
				<div class="column">
					<a href=""><img class="topic-image" src="{{$smallStoryImg->present()->mainImageURL }}" alt="story image"></a>
					<div class="stories-content">
						<div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
							<p><a href="">{{ $smallStoryImg->teaser }}</p></li>
						</div>
						<p class="button-group"><a href="#" class="button">{{ $smallStoryImg->teaser }}<i class="fi-play"></i></a></p>
					</div>
				</div>
				<div class="column">
					<a href=""><img class="topic-image" src="{{$smallStoryImg->present()->mainImageURL }}" alt="story image"></a>
					<div class="stories-content">
						<div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
							<p><a href="">{{ $smallStoryImg->teaser }}</p></li>
						</div>
						<p class="button-group"><a href="#" class="button">{{ $smallStoryImg->teaser }}<i class="fi-play"></i></a></p>
					</div>
				</div>
				<div class="column">
					<a href=""><img class="topic-image" src="{{$smallStoryImg->present()->mainImageURL }}" alt="story image"></a>
					<div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
							<p><a href="">{{ $smallStoryImg->teaser }}</p></li>
            </div>
            <p class="button-group"><a href="#" class="button">{{ $smallStoryImg->teaser }}<i class="fi-play"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
