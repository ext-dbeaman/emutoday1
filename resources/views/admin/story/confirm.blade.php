@extends('admin.layouts.master')

@section('title', 'Delete '.$story->title)

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.story.destroy', $story->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete a story. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this story!', ['class' => 'button alert']) !!}

        <a href="{{ route('admin.story.index') }}" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
