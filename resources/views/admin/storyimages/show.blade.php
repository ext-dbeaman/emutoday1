@extends('admin.layouts.master')
@section('title', $storyImage->exists ? 'Editing '.$storyImage->image_name : 'No Image')
  @section('style')
    @parent
     	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
     @stop

@section('content')

    <div>{{ $storyImage->image_name }} :  <br>

        <img src="/imgs/story/{{ $storyImage->image_name . '.' .
         $storyImage->image_extension . '?'. 'time='. time() }}">

    </div>

    <div>

       {{ $storyImage->image_name }} - thumbnail :  <br>

        <img src="/imgs/story/thumbnails/{{ 'thumb-' . $storyImage->image_name . '.' .
    $storyImage->image_extension . '?'. 'time='. time() }}">

    </div>
    {!! Form::model($storyImage,[
    'id' => 'addPhotosForm',
    'class' => 'dropzone',
    'method' => $storyImage->exists ? 'put' : 'post',
     'route' => $storyImage->exists ? ['admin.storyimages.update', $storyImage->id] : ['admin.storyimages.store'],
    'files' => true

    ]) !!}

   {!! Form::close() !!}
@endsection
  @section('footer')
    @parent
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
@endsection
