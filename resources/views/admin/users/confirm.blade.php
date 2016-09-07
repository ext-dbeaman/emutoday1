@extends('admin.layouts.master')

@section('title', 'Delete '.$user->name)

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.users.destroy', $user->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete a user. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this user!', ['class' => 'button alert']) !!}

        <a href="{{ route('admin.users.index') }}" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
