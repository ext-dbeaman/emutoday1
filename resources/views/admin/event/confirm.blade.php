@extends('admin.layouts.master')

@section('title', 'Delete '.$event->title)

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.event.destroy', $event->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete an event. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this event!', ['class' => 'button alert']) !!}

        <a href="{{ route('admin.event.index') }}" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
