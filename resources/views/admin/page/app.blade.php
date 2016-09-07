@extends('admin.layouts.adminlte')

@section('title', 'View Pages')
    @section('style-plugin')
        @parent
            <!-- daterange picker -->
    <!-- bootstrap datepicker -->
    <!-- iCheck for checkboxes and radio inputs -->
    <!-- Bootstrap Color Picker -->
    <!-- Bootstrap time Picker -->
    <!-- Select2 -->
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">

            @endsection
            @section('scripthead')
                        {{-- @include('admin.layouts.scriptshead') --}}
            {{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> --}}
            @show
            @include('include.js')
    @section('content')
    @include('admin.layouts.modal')
        <!-- Main content -->
        <div class="row">
            <div id="vue-chart-app">
                <page-chart-app gcols="{{json_encode($strys)}}">
                </page-chart-app>
            </div>
        </div><!-- /.row -->

@endsection


@section('footer-plugin')
    @parent
    <script src="/js/vue-chart-app.js"></script>

@endsection

@section('footer-script')
    @parent
    <script>



    $(function () {

    });
</script>

@endsection
