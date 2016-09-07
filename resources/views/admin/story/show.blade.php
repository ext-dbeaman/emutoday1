@extends('layouts.masters')
@section('title', 'Story SHOWWWWW')

@section('head')
  @parent
  <script src="{{ '/js/ckeditor/ckeditor.js' }}"></script>
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
                   <div class="large-2 medium-4 small-6 columns noleftpadding"><p class="story-publish-date"><a href="">{{ $story->published_at }}</a></p></div>
                   <div class="large-5 medium-4 hide-for-small columns noleftpadding"><p class="small-return-news"><a href="#">News Home</a></p></div>
               </div>


<div id="story-content" class="row">
    <div class="large-9 medium-8 small-12 columns noleftpadding">
        <div class="addthis"></div>
               <h3>{{ $story->title }}</h3>
            <h5>{{ $story->subtitle }}</h5>
    <div id="big-feature-image">
      <img src="{{$story->grabStoryImageByType('imagemain')->mainImageURL() }}" alt="feature-image"></a>

        <div class="feature-image-caption">{{ $story->grabStoryImageByType('imagemain')->caption }}</div>
    </div>
    <div id="story-content-edit" contenteditable="true">
      {!! $story->content !!}
    </div>
    <div class="story-author">{{ $story->author->name }}</div>
        <p class="news-contacts">Contact {{ $story->author->email }}</p>
        </div>
                <div class="large-3 medium-4 small-12 columns featurepadding">
            <div class="featured-content-block">
                    <h6 class="headline-block lt-green">Featured stories</h6>
                    <a href=""><img src="{{ $story->grabStoryImageByType('imagesmall')->mainImageURL()}}" alt="story image"></a>
                <ul class="feature-list">
                       <li><a href="">{{ $story->grabStoryImageByType('imagesmall')->teaser }}</a></li>
                       <li><a href="">An Ounce of Prevention is Worth a Great Career</a></li>
                       <li><a href="">Eating Healthy at EMU</a></li>

                    </ul>

               </div>


               </div>


            </div>
       </div>

       </div>
       </div>
       {!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'button']) !!}

       {!! Form::close() !!}
@endsection

@section('footer')
  @parent

  <script>
  // The inline editor should be enabled on an element with "contenteditable" attribute set to "true".
  // Otherwise CKEditor will start in read-only mode.
  var introduction = document.getElementById( 'introduction' );
  introduction.setAttribute( 'contenteditable', true );

  CKEDITOR.inline( 'introduction', {
    // Allow some non-standard markup that we used in the introduction.
    extraAllowedContent: 'a(documentation);abbr[title];code',
    removePlugins: 'stylescombo',
    extraPlugins: 'sourcedialog',
    // Show toolbar on startup (optional).
    startupFocus: true
  } );
  	// Sample: Massive Inline Editing

  	// This code is generally not necessary, but it is here to demonstrate
  	// how to customize specific editor instances on the fly. This fits this
  	// demo well because some editable elements (like headers) may
  	// require a smaller number of features.

  	// The "instanceCreated" event is fired for every editor instance created.
  	CKEDITOR.on( 'instanceCreated', function ( event ) {
  		var editor = event.editor,
  				element = editor.element;

  		// Customize editors for headers and tag list.
  		// These editors do not need features like smileys, templates, iframes etc.
  		if ( element.is( 'h1', 'h2', 'h3' ) || element.getAttribute( 'id' ) == 'taglist' ) {
  			// Customize the editor configuration on "configLoaded" event,
  			// which is fired after the configuration file loading and
  			// execution. This makes it possible to change the
  			// configuration before the editor initialization takes place.
  			editor.on( 'configLoaded', function () {

  				// Remove redundant plugins to make the editor simpler.
  				editor.config.removePlugins = 'colorbutton,find,flash,' +
  						'forms,newpage,removeformat,' +
  						'smiley,specialchar,stylescombo,templates';

  				// Rearrange the toolbar layout.
  				editor.config.toolbarGroups = [
  					{ name: 'editing', groups: [ 'basicstyles', 'links' ] },
  					{ name: 'undo' },
  					{ name: 'clipboard', groups: [ 'selection', 'clipboard' ] },
  					{ name: 'about' }
  				];
  			} );


  		}
      editor.on('change', function (evt) {
        //getData() returns CKEditor's html content
        console.log('Total Bytes ' + evt.editor.getData().length );
      });
  	} );
  	</script>
  @endsection
