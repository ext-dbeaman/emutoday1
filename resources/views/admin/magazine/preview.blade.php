@extends('layouts.masters')
@section('content')
  <div id="content-area">
    <div id="homepage-hero" class="row">
      <img src="{{$heroImg->present()->mainImageURL}}" alt="main image">
      <div id="magazine-text-over-image-box" class="row collapse">
        <div class="centered-main-title">
          <h2><a href="article.html">{{$heroImg->caption}}</a></h2>
          <p>{{$heroImg->teaser}}</p>
        </div>
      </div>
    </div>
    <div id="profiles-list" >
      <div class="row managehorizontalpadding" >
        <div class="row small-up-2 medium-up-2 large-up-5">
          @foreach ($barImgs as $barImg)
            <div class="column">
              <a href="/admin/story/{{$barImg->story->id}}/edit">
                <img class="topic-image" src="{{$barImg->present()->mainImageURL}}"  alt="topic image"/>
                <div class="profile-content">
                  <div class="profile-text-content magazine" data-equalizer-watch>
                    <h3>{{$barImg->caption}}</h3>
                    <p>{{$barImg->teaser}}</p>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <div id="magazine-feature">
        <div class="row collapse">
          <div class="large-7 large-push-5 medium-12 small-12 columns">
            <div class="row collapse photo-feature-section">
              <div class="large-6 medium-6 small-12 columns">
								<img class="topic-image contributor" src="../images/magazine-images/back-page-image.jpg"  alt="back page image"/>
              </div>
              <div class="large-6 medium-6 small-12 columns photo-feature-text ">
                <h5>“Grand But Questionable Haven” </h5>
                <p>This photo, to me, is a perfect representation of the beauty and the harshness of winter. I love the isolation of it and the capacity it has for explaining the conflicting emotions I felt that day.</p>
                <p>Images I saw of Grand Haven in the winter from various Michigan photographers inspired me so much that I drove two and a half hours just to photograph the same location. This was the picture I set out to take in the first place and, somewhat uncharacteristically, it turned out almost exactly how I wanted or expected.  </p>
                <p class="author">Photograph by Dana Kilroy, undergraduate student in Studio Art</p>
              </div>

            </div>

          </div>


          <div class="large-5 large-pull-7 medium-12 small-12 columns">
            <div class="row collapse">
              <div class="large-6 medium-4 small-12 columns cover-box"><img class="topic-image magazine-cover" src="../images/magazine-images/covers/magazine-cover-winter2016.jpg"  alt="magazine image"/>
              </div>
              <div class="large-6 medium-8 small-12 columns magazine-details">
                <h4>{{$magazineCover->headline}}</h4>
                <p>{{$magazineCover->teaser}}</p>
								<p><a href="{{$magazineCover->link}}">{{$magazineCover->link_text}}</a></p>
                {{-- <p><a href="">Read the Digital Issue</a></p> --}}
                <p class="button-container"><a class="button expand magazine-button">Subscribe</a></p>
                <p class="button-container"><a class="button expand magazine-button">Submit a story idea</a></p>
              </div>

            </div>
          </div>

        </div>
      </div><!--end of profiles-list-->

    </div>   <!--end content area-->
@endsection
@section('footer')
  @parent
  <script>
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
          editor.config.removePlugins = 'colorbutton,font,' +
              'forms,newpage,removeformat,' +
              'smiley,templates';

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
