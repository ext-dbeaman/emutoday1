@extends('admin.layouts.master')

@section('title', $event->exists ? 'Editing '.$event->title : 'Create New Event')
  @section('scripthead')
  @endsection
@section('content')



    <div id="vueapp">


    {!! Form::model($event, [
        'method' => $event->exists ? 'put' : 'post',
        'route' => $event->exists ? ['admin.event.update', $event->id] : ['admin.event.store']
    ]) !!}

      <div class="form-group row">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group row">
        {!! Form::label('short_title') !!}
        {!! Form::text('short_title', null, ['class' => 'form-control']) !!}
      </div>
       <event-form></event-form>
      <div class="form-group row">
        {!! Form::label('location') !!}
        {!! Form::text('location', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group row">
        {!! Form::label('description') !!}
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
      </div>
      <div class="input-group">
          {!! Form::label('category_list', 'Tags:') !!}
          {!! Form::select('category_list[]',$categories, $event->categories->lists('id')->toArray() , ['class' => 'form-control', 'multiple']) !!}
      </div>
    <div class="row">
      <div class="small-12 medium-3 columns">
        {!! Form::label('start_date') !!}
        {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
      </div>
      <div class="small-12 medium-3 columns">
        {!! Form::label('end_date') !!}
        {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
      </div>
      <fieldset class="small-12 medium-3 columns">
          <legend>{!! Form::label('all_day') !!}</legend>
            {{ Form::radio('all_day', 1) }}{!! Form::label('all_day', 'yes') !!}
            {{ Form::radio('all_day', 0) }}{!! Form::label('all_day', 'no') !!}
          </fieldset>
        <fieldset class="small-12 medium-3 columns">
        <legend>  {!! Form::label('no_end_time') !!}</legend>
          {!! Form::radio('no_end_time', 1) !!}{!! Form::label('no_end_time', 'yes') !!}
          {!! Form::radio('no_end_time', 0) !!}{!! Form::label('no_end_time', 'no') !!}
      </fieldset>
    </div>
    <div class="row">

        {!! Form::submit($event->exists ? 'Save Event' : 'Create New Event', ['class' => 'button']) !!}
    </div>



    {!! Form::close() !!}

    </div>
@endsection
@section('footer')
  @parent

  <script>



  $(function(){
    $('#start_date').fdatepicker({
      format: 'yyyy-mm-dd hh:ii',
      disableDblClickSelection: true,
      language: 'en',
      pickTime: true
    });
    $('#end_date').fdatepicker({
      format: 'yyyy-mm-dd hh:ii',
      disableDblClickSelection: true,
      language: 'en',
      pickTime: true
    });


  });
  </script>
                <!-- add additional script to bottom of body like js/main.js
                or add Jquery or similiar calls from inside script tags
                //$('#flash-overlay-modal').foundation('open'); //will open a Reveal modal with id `reveal`.
@endsection
