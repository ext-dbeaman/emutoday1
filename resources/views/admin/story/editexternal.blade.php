@extends('admin.layouts.master')

@section('title', 'Editing '.$story->title)
@section('content')
    <div class="row">
        <div class="medium-6 columns">
            <div class="row column">
                {{ csrf_field() }}
                {!! Form::model($story, [
                'method' => $story->exists ? 'put' : 'post',
                'route' => $story->exists ? ['admin.story.update', $story->id] : ['admin.story.store']
                    ])
                    !!}
                <div class="input-group">
                    {!! Form::label('title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="input-group">
                    {!! Form::label('teaser') !!}
                    {!! Form::text('teaser', null, ['class' => 'form-control']) !!}
                </div>
                <div class="input-group">
                    {!! Form::label('slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="input-group row">
                <div class="small-2 columns">
                    {!! Form::label('published_at') !!}
                </div>
                <div class="small-10 columns">
                    {!! Form::text('published_at', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row column">
            {!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'button']) !!}

            {!! Form::close() !!}
                </div>
        </div>


        <div class="medium-6 columns">

            <!--     add image asset -->
            @each('admin.story.subviews.storyimage', $story->storyImages, 'storyImage')
            <!-- list all image assets -->


            </div>
    </div>
@endsection
