<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Ready</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-left">Start Date</th>
                        <th class="text-left">End Date</th>
                        <th class="text-left">Live In</th>
                        <th class="text-center"><span class="fa fa-eye" aria-hidden="true"></span></th>
                        <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                        <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>

                    </tr>
                </thead>
                <tbody>
                    @if(isset($pages_ready_current))
                        @foreach($pages_ready_current as $page)
                            <tr class="{{ $page->present()->pageScheduleStatus }}">
                                <td class="text-center">{{ $page->id }}</td>
                                <td>{{ $page->present()->prettyStartDate }}</td>
                                <td>{{ $page->present()->prettyEndDate }}</td>
                                <td>{{ $page->present()->pageLiveIn }}</td>
                                <td class="text-center">
                                    <a href="{{ route('preview_hub', $page->id) }}">
                                        <span class="fa fa-eye" aria-hidden="true"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.page.edit', $page->id) }}">
                                        <span class="fa fa-pencil" aria-hidden="true"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin_page_delete', $page->id) }}">
                                        <span class="fa fa-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div><!-- /.box -->
