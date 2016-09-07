@extends('admin.layouts.master')

@section('title', 'Delete '.$announcement->title)

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.announcement.destroy', $announcement->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete an Announcement. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this announcement!', ['class' => 'button alert']) !!}

        <a href="{{ route('admin.announcement.index') }}" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
