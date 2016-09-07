@extends('layouts.backend')

@section('title', $storyImage->exists ? 'Editing Story Image' : 'Create New Story Image')
@section('styles')
   	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
   @stop

@section('content')
    {!! Form::model($storyImage,[
      'id' => 'addPhotosForm',
      'class' => 'dropzone',
        'method' => $storyImage->exists ? 'put' : 'post',
         'route' => $storyImage->exists ? ['backend.storyimages.update', $storyImage->id] : ['backend.storyimages.store'],
        'files' => true

    ]) !!}

    <!-- image name Form Input -->
    <div class="form-group">
     {!! Form::label('image name', 'Image name:') !!}
     {!! Form::text('image_name', null, ['class' => 'form-control']) !!}
    </div>


    <!-- is_something Form Input -->
    <div class="form-group">
     {!! Form::label('is_active', 'Is Active:') !!}
     {!! Form::checkbox('is_active') !!}
    </div>

    <!-- is_featured Form Input -->
    <div class="form-group">
     {!! Form::label('is_featured', 'Is Featured:') !!}
     {!! Form::checkbox('is_featured') !!}
    </div>

    @if ($storyImage->exists)
      <div>{{ $storyImage->filename }} <br>
         {{ $storyImage->image_name }} - thumbnail :  <br>
         <img src="/imgs/story/thumbnails/{{ 'thumb-' . $storyImage->image_name . '.' .
       $storyImage->image_extension . '?'. 'time='. time() }}">
     </div>
      <div>
         {{ $storyImage->image_name }} :  <br>
         <img src="/imgs/story/{{ $storyImage->image_name . '.' .
             $storyImage->image_extension . '?'. 'time='. time() }}">
      </div>
@else
   <!-- form field for file -->
 <div class="form-group">
 {!! Form::label('image', 'Primary Image') !!}
 {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
 </div>
@endif

    <!-- form field for caption -->
    <div class="form-group caption">
     {!! Form::label('caption') !!}
     {!! Form::textarea('caption', null, ['class' => 'form-control']) !!}
    </div>

    <!-- form field for caption -->
    <div class="form-group teaser">
     {!! Form::label('teaser') !!}
     {!! Form::textarea('teaser', null, ['class' => 'form-control']) !!}
    </div>
    <!-- form field for moretext -->
    <div class="form-group moretext">
     {!! Form::label('moretext') !!}
     {!! Form::textarea('moretext', null, ['class' => 'form-control']) !!}
    </div>

  
    {!! Form::submit('Upload Photo', array('class'=>'btn btn-primary', 'type'=>'submit')) !!}


   {!! Form::close() !!}

@endsection
@section('footscripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
	<script>
		Dropzone.options.addPhotosForm = {
         // The configuration we've talked about above
  autoProcessQueue: false,
  uploadMultiple: true,
  parallelUploads: 100,
  maxFiles: 100,

  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;

    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
      // Make sure that the form isn't actually being sent.
      e.preventDefault();
      e.stopPropagation();
      myDropzone.processQueue();
    });
    this.on("addedfile", function() {
      if(this.files[1]!= null){
         this.removeFile(this.files[0]);
      }
   });



    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
    // of the sending event because uploadMultiple is set to true.
    this.on("sendingmultiple", function() {
      // Gets triggered when the form is actually being sent.
      // Hide the success button or the complete form.
    });
    this.on("successmultiple", function(files, response) {
      // Gets triggered when the files have successfully been sent.
      // Redirect user or notify of success.
    });
    this.on("errormultiple", function(files, response) {
      // Gets triggered when there was an error sending the files.
      // Maybe show form again, and notify user of error
    });
  }

		};
	</script>
@stop
