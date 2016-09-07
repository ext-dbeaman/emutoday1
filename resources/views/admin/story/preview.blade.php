@extends('public.layouts.global')
@section('title', 'Preview Story')
@section('styles')
  @parent
    <!-- <link rel="stylesheet" href="{{'/assets/vendor/ckeditor/sdk-inline.css'}}" /> -->
    @endsection
@section('scriptshead')
      @parent
			<script src="/themes/plugins/ckeditor/ckeditor.js"></script>

    {{-- <script src="{{ '/assets/vendor/ckeditor/ckeditor.js'}}"></script> --}}
@endsection
@section('content')
  {!! Form::model($story, [
      'method' => 'put',
      'route' => ['admin.story.update', $story->id]
  ]) !!}
  <div id="news-story-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <div id="title-grouping" class="row">
          <div class="large-5 medium-4 small-6 columns noleftpadding"><h3 class="news-caps">News</h3></div>
          <div class="large-2 medium-4 small-6 columns noleftpadding"><p class="story-publish-date"><a href="">{{ $story->present()->publishedDate }}</a></p></div>
          <div class="large-5 medium-4 hide-for-small columns noleftpadding"><p class="small-return-news"><a href="#">News Home</a></p></div>
        </div>


        <div id="story-content" class="row">
          <div class="large-9 medium-8 small-12 columns noleftpadding">
            <div class="addthis"></div>
            <h3>{{ $story->title }}</h3>
            <h5>{{ $story->subtitle }}</h5>
            @if(isset($mainStoryImg))
              <div id="big-feature-image">
                <img src="{{$mainStoryImg->present()->mainImageURL }}" alt="feature-image"></a>

                <div class="feature-image-caption">{{ $mainStoryImg->caption }}</div>
              </div>
            @endif
            <div id="story-content-edit" contenteditable="true">
              {!! $story->content !!}
            </div>
            <div class="story-author">{{ $story->author->name }}</div>
            <p class="news-contacts">Contact {{ $story->author->email }}</p>
          </div>
          <div class="large-3 medium-4 small-12 columns featurepadding">
            <div class="featured-content-block">
              <h6 class="headline-block lt-green">Featured stories</h6>
              @if(isset($smallStoryImg))
                <a href=""><img src="{{$smallStoryImg->present()->mainImageURL }}" alt="story image"></a>
              @endif
              <ul class="feature-list">
                @if(isset($smallStoryImg))
                  <li><a href="">{{ $smallStoryImg->teaser }}</a></li>
                @endif

                <li><a href="">An Ounce of Prevention is Worth a Great Career</a></li>
                <li><a href="">Eating Healthy at EMU</a></li>

              </ul>

            </div>


          </div>


        </div>
				<div class="row">
					<div class="medium-6 columns">
						<div class="button-group">
								{!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'button']) !!}
								<a class="secondary button" href="{{URL::previous()}}">Cancel</a>

						</div><!-- /.button-group -->


						{!! Form::close() !!}
					</div><!-- /.medium-6 columns -->
					<div class="medium-6 columns">


					</div><!-- /.medium-6 columns -->
				</div><!-- /.row -->

      </div>

    </div>

  </div>

@endsection

@section('scriptsfooter')
  @parent
  <script>
  var introduction = document.getElementById( 'story-content-edit' );
		introduction.setAttribute( 'contenteditable', true );
		CKEDITOR.inline( 'story-content-edit', {
			// Define changes to default configuration here. For example:
	filebrowserBrowseUrl : '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
		filebrowserImageBrowseUrl: '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
		filebrowserUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
		filebrowserImageUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images'


					} );
		// CKEDITOR.inline( 'story-content-edit', {
		// 	// Allow some non-standard markup that we used in the introduction.
		// 	extraAllowedContent: 'a(documentation);abbr[title];code',
		// 	removePlugins: 'stylescombo',
		// 	// Show toolbar on startup (optional).
		// 	startupFocus: true
		// } );

  	</script>
  @endsection
