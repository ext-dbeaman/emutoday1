<!-- inject('storytypes', 'emutoday\Http\Utilities\StoryTypes') -->
@extends('admin.layouts.master')
@section('title', $story->exists ? 'Editing '.$story->title : 'Create New Story')
@section('scripthead')
          @parent
        <script src="{{ '/js/ckeditor/ckeditor.js' }}"></script>
    @endsection
@section('content')
    {!! Form::model($story, [
        'method' => $story->exists ? 'put' : 'post',
        'route' => $story->exists ? ['admin.story.update', $story->id] : ['admin.story.store']
    ]) !!}

    <div class="input-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="input-group">
        {!! Form::label('slug') !!}
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    </div>
    <div class="input-group">
        {!! Form::label('subtitle') !!}
        {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
    </div>
    <div class="input-group teaser">
        {!! Form::label('teaser') !!}
        {!! Form::textarea('teaser', null, ['class' => 'form-control']) !!}
    </div>

    <div class="input-group">
        {!! Form::label('content') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
    <div class="input-group">
        <div class="small-2 columns">
            {!! Form::label('published_at') !!}
        </div>
        <div class="small-10 columns">
            {!! Form::text('published_at', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="input-group">
        {!! Form::label('storyTypes', 'StoryTypes:') !!}
        {!! Form::text('storyTypes', $storyType, ['class' => 'form-control']) !!}
    </div>




    {!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'button']) !!}

    {!! Form::close() !!}
@endsection
@section('footer')
    @parent
    <script>

        CKEDITOR.replace('teaser',
               {
                   toolbarGroups: [
                       { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                       { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                       { name: 'links', groups: [ 'links' ] },
                       { name: 'insert', groups: [ 'insert' ] },
                       { name: 'forms', groups: [ 'forms' ] },
                       { name: 'tools', groups: [ 'tools' ] },
                       { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                       { name: 'others', groups: [ 'others' ] },
                       { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                       { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                       { name: 'styles', groups: [ 'styles' ] },
                       { name: 'colors', groups: [ 'colors' ] },
                       { name: 'about', groups: [ 'about' ] }
                   ],
                   removeButtons: 'Underline,Subscript,Superscript,Cut,Undo,Redo,Copy,Paste,PasteText,PasteFromWord,Scayt,Link,Unlink,Anchor,Image,Table,SpecialChar,Maximize,Source,NumberedList,BulletedList,Indent,Outdent,Blockquote,About',
                   height : 50,
                   toolbar : 'simple'
                })
                CKEDITOR.replace('content');


        $('input[name=title]').on('blur', function () {
            var slugElement = $('input[name=slug]');

            if (slugElement.val()) {
                return;
            }

            slugElement.val(this.value.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, ''));
        });
    </script>
@endsection
