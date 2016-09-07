@extends('admin.layouts.master')

@section('title', 'Delete Magazine')

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.magazine.destroy', $magazine->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete the Magazine. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this Magazine!', ['class' => 'button alert']) !!}

        <a href="{{ route('admin.magazine.index') }}" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
