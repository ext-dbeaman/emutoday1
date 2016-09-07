@extends('admin.layouts.admin')

@section('title', $generalImage->exists ? 'Editing Image' : 'Add New Image')

@section('content')
    {!! Form::model($generalImage,[
        'method' => $generalImage->exists ? 'put' : 'post',
        'route' => $generalImage->exists ? ['admin.generalImages.update', $generalImage->id] : ['admin.generalImages.store'],
        'files' => true
    ]) !!}

    <!-- image name Form Input -->
    <div class="form-group">
     {!! Form::label('name', 'Image name:') !!}
     {!! Form::text('name', null, ['class' => 'form-control']) !!}
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

    @if ($generalImage->exists)
      <div>{{ $generalImage->filename }} <br>
         {{ $generalImage->image_name }} - thumbnail :  <br>
         <img src="/imgs/story/thumbnails/{{ 'thumb-' . $generalImage->image_name . '.' .
       $generalImage->image_extension . '?'. 'time='. time() }}">
     </div>
      <div>
         {{ $generalImage->image_name }} :  <br>
         <img src="/imgs/story/{{ $generalImage->image_name . '.' .
             $generalImage->image_extension . '?'. 'time='. time() }}">
      </div>
      <!-- form field for file -->
      <div class="form-group">
      {!! Form::label('image', 'Primary Image') !!}
      {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
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
    <!-- form field for moretext -->
    <div class="form-group">
      {!! Form::label('image_type', 'Image Type') !!}
      {!! Form::select('image_type', $generalImagetypes::all(), 0) !!}

    </div>

    <div class="form-group">
    {!! Form::submit('Upload Photo', array('class'=>'button')) !!}
    </div>

   {!! Form::close() !!}

@endsection
