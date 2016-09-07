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
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Page Timeline</h3>
                        @include('admin.layouts.components.boxtools', ['rte' => 'page', 'path' => 'admin/page'])
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="vue-chart-app">
                                <page-chart-app gcols="{{$pgs}}">
                            {{-- <page-chart-app gcols="{{json_encode($pgs)}}"> --}}
                            </page-chart-app>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Page List Table</h3>
                    @include('admin.layouts.components.boxtools', ['rte' => 'page', 'path' => 'admin/page'])

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="main-page-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-left">Template</th>

                                    <th class="text-left">Start Date</th>
                                    <th class="text-left">End Date</th>

                                    <th class="text-center">Ready</th>
                                    <th class="text-center">Live</th>
                                    <th class="text-center">Preview</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
@endsection


@section('footer-plugin')
    @parent
    <script src="/js/vue-chart-app.js"></script>

    <script src="/themes/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
@endsection

@section('footer-script')
    @parent
    <script>


    // google.charts.load('current', {'packages':['timeline']});
    //  google.charts.setOnLoadCallback(drawChart);
    //  function drawChart() {
    //    var container = document.getElementById('timeline');
    //    var chart = new google.visualization.Timeline(container);
    //    var gdataTable = new google.visualization.DataTable();
    //
    //    dataTable.addColumn({ type: 'string', id: 'President' });
    //    dataTable.addColumn({ type: 'date', id: 'Start' });
    //    dataTable.addColumn({ type: 'date', id: 'End' });
    //    dataTable.addRows([
    //        JSvars.pagearray
    //     //  [ 'Washington', new Date(1789, 3, 30), new Date(1797, 2, 4) ],
    //     //  [ 'Adams',      new Date(1797, 2, 4),  new Date(1801, 2, 4) ],
    //     //  [ 'Jefferson',  new Date(1801, 2, 4),  new Date(1809, 2, 4) ]
    //  ]);
    //
    //    chart.draw(gdataTable);
    //  }
    $(function () {

        var table = $('#main-page-table').DataTable({
            "ajax": "/api/page",
            "columns": [
                {"data": "id"},
                {"data": "template"},

                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "ready"},
                {"data": "live"},

                {"date": null,
                    "defaultContent": "<a href='#'><i class='fa fa-eye'></i></a>"
                },
                {"date": null,
                    "defaultContent": "<a href='#'><i class='fa fa-pencil'></i></a>"
                },
                {"date": null,
                    "defaultContent": "<a href='#'><i class='fa fa-trash'></i></a>"
                }
            ]
        });
        //
        // function openroute(rte,id){
        // 	window.location.href =
        // }
        //
        $('#main-page-table tbody').on('click', '.fa-eye', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location.href = '/preview/page/'+ data["id"];
        });
        $('#main-page-table tbody').on('click', '.fa-pencil', function () {

            var data = table.row( $(this).parents('tr') ).data();
        //	var storyid = data["id"];
            window.location.href = '/admin/page/'+ data["id"] + '/edit';

            //openroute('edit',data["id"]);
            // var data = table.row( $(this).parents('tr') ).data();
            // 	alert( data["id"]);
        });
        $('#main-page-table tbody').on('click', '.fa-trash', function () {

            var data = table.row( $(this).parents('tr') ).data();
            var dataid = data["id"];
            var recordid = 'Record ID: '+ dataid;
            var datatitle = data["title"];
            var modal = $('#modal-confirm-delete').modal('show');
            modal.find('#modal-confirm-title').html('Delete Page');
            modal.find('#record-info').html(datatitle);
            modal.find('#record-id').html(recordid);
            modal.find('#hidden-id').val(dataid);

            document.getElementById("btn-confirm-delete").addEventListener("click", function(){
                form = document.getElementById('admin_destroy');
                form.id = 'page_id';
                form.action = '/admin/page/delete';
                form._method = 'POST';
                form.submit();
            });
            //alert('/admin/announcement/'+ data["id"] + '/confirm')
            // window.location.href = '/admin/story/'+ data["id"] + '/confirm';

        })
        // $('#main-magazine-table tbody').on('click', '.fa-trash', function () {
        //
        // 	var data = table.row( $(this).parents('tr') ).data();
        // //	var storyid = data["id"];
        // 	window.location.href = '/admin/magazine/'+ data["id"] + '/confirm';
        //
        // 	//openroute('edit',data["id"]);
        // 	// var data = table.row( $(this).parents('tr') ).data();
        // 	// 	alert( data["id"]);
        // })


    });
</script>

@endsection
