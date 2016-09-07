@extends('admin.layouts.adminlte')
@section('title', 'Edit Page')
    @section('style-vendor')
        @parent
    @endsection

    @section('style-plugin')
        @parent
    @endsection


    @section('style-plugin')
        @parent
        <!-- daterange picker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

    <link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        @endsection
        @section('style-app')
            @parent
            <link rel="stylesheet" href="{{'/css/my-redips.css' }}" type="text/css" media="screen" />

        @endsection

            @section('scripts-vendor')
                <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
                @parent
            @endsection
            @section('scripts-plugin')
                <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
                    <script src="/themes/plugins/ckeditor/ckeditor.js"></script>
                @parent
            @endsection
            @section('scripts-app')
                <!-- App related Scripts  that need to be loaded in the header -->
                <script src="/js/redips-drag-min.js"></script>

                @parent
            @endsection
@section('content')
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Page Info</h3>
                    {{-- <div class="box-tools">
                        <div class="btn-toolbar btn-group-sm">
                            <a href="/preview/page/{{$page->id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>

                        </div><!-- /.btn-toolbar -->
                    </div><!-- /.box-tools --> --}}
            </div><!-- /.box-header -->
                <div class="box-body">
<div class="row">


            {!! Form::model($page, [
                'method' =>  'put',
                'route' => ['admin.page.update', $page->id]
            ]) !!}
          {{ csrf_field() }}
            <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('template') !!}
                {!! Form::text('template', $page->template, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('uri') !!}
                {!! Form::text('uri', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('start_date') !!}
                {!! Form::text('start_date', null, ['class' => 'form-control datetimepicker']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
                {!! Form::label('end_date') !!}
                {!! Form::text('end_date', null, ['class' => 'form-control datetimepicker']) !!}
        </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                    {!! Form::label('is_active', 'active') !!}
                    <div class="radio">

                        <label>
                            {!! Form::radio('is_active', true ,null) !!}
                            yes
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                    {!! Form::radio('is_active', false ,null) !!}
                    no
                        </label>
                    </div>
            </div>

            </div>

                <div class="col-md-2">
                    <div class="form-group">
                 {!! Form::label('story_ids') !!}
                {!! Form::text('story_ids', null, ['id'=> 'story_ids',  'class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
        </div>
    </div>
    </div><!-- ./row -->
</div><!-- /.box-body -->
</div><!-- /.box -->

    <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Page Builder</h3>
                <div class="box-tools">
                    <div class="btn-toolbar btn-group-sm">
                        <a href="/preview/page/{{$page->id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
                    </div><!-- /.btn-toolbar -->
                </div><!-- /.box-tools -->
            </div>
            <div class="box-body">
        @include('admin.page.templates.homeemutodayimg')
    </div><!-- /.box-body -->
    </div><!-- /.box -->

@endsection
@section('footer-vendor')

    @parent
@endsection

@section('footer-plugin')
    @parent
    <script src="/themes/plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

@endsection

@section('footer-app')
    @parent
      <script src="/js/pagebuild-redips.js"></script>
@endsection

@section('footer-script')
    @parent

    <script>

    $(function(){
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        // $('#start_date').fdatepicker({
        // 	format: 'yyyy-mm-dd hh:ii',
        // 	disableDblClickSelection: true,
        // 	language: 'en',
        // 	pickTime: true
        // });
        // $('#end_date').fdatepicker({
        // 	format: 'yyyy-mm-dd hh:ii',
        // 	disableDblClickSelection: true,
        // 	language: 'en',
        // 	pickTime: true
        // });


    });
    </script>
@endsection
