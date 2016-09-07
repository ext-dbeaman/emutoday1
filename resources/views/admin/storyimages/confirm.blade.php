@extends('admin.layouts.master')

@section('title', 'Delete '.$storyImage->image_name)

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.storyimages.destroy', $storyImage->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete the Story Image Record. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this record!', ['class' => 'button alert']) !!}

        <a href="{{ route('admin.storyimages.index') }}" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
