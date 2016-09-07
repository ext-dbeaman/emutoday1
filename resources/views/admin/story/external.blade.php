<!-- inject('storytypes', 'emutoday\Http\Utilities\StoryTypes') -->
@extends('admin.layouts.master')
@section('title', $story->exists ? 'Editing '.$story->title : 'Create New External Story')
@section('content')
    {!! Form::model($story, [
        'method' => $story->exists ? 'put' : 'post',
        'route' => $story->exists ? ['admin.story.update',$story->id] : ['admin.story.store']
    ]) !!}

    <div class="input-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="input-group">
        {!! Form::label('teaser') !!}
        {!! Form::text('teaser', null, ['class' => 'form-control']) !!}
    </div>
    <div class="input-group">
        {!! Form::label('External Link') !!}
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    </div>
    <div class="input-group">
        {!! Form::label('story_type', 'Story Type:') !!}
        {!! Form::text('story_type', $stype, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
    </div>
    {!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'button']) !!}

    {!! Form::close() !!}
@endsection
