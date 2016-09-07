<div id="redips-drag">
    <!-- tables inside this DIV could have drag-able content -->
    <!-- left container -->
    <div class="row">
    <div id="left" class="col-md-6">
        <table id="table1">
            <colgroup>
                <col width="50"/>
                <col width="50"/>
                <col width="100"/>
                <col width="300"/>
            </colgroup>
        @foreach ($storys as $story)
        <tr>
            <td class="{{$story->is_featured?'bg-orange':'bg-navy'}}">
                {{$story->id}}
            </td>
            <td class="redips-single">
                @if($story->is_featured)
                        <div id="drag-{{$story->id}}x" class="redips-drag bg-orange" data-imgtype="front" data-imgname="{{$story->images()->ofType('front')->first()->filename}}"></a>{{$story->id}}</div>
                @else
                        <div id="drag-{{$story->id}}" class="redips-drag bg-navy" data-imgtype="small" data-imgname="{{$story->images()->ofType('small')->first()->filename}}"></a>{{$story->id}}</div>
                @endif
            </td>
            <td class="redips-mark story-type">
                    {{$story->story_type}}
            </td>
            <td class="redips-mark story-title">
                    {{$story->title}}
            </td>
    </tr>
                                @endforeach
        </table>
    </div>

    <!-- right container -->
    <div id="right" class="col-md-6">
        <table id="table2">
        <colgroup>
            <col width="400" />
        </colgroup>
        <tr>
            <td id="emuhome0" class="redips-mark redips-single hero"></td>
        </tr>
        <tr>
            <td class="redips-mark">
            <table class="four-stories-bar">
                <colgroup>
                    <col width="100"/> <!--  first activity column -->
                    <col width="100"/> <!--  first activity column -->
                    <col width="100"/> <!--  first activity column -->
                    <col width="100"/> <!--  first activity column -->
                </colgroup>
                <tr>
                    <td class="redips-single" id="emuhome1"></td>
                    <td class="redips-single" id="emuhome2"></td>
                    <td class="redips-single" id="emuhome3"></td>
                    <td class="redips-single" id="emuhome4"></td>
                </tr>
            </table>
                </td>
        </tr>

    </table>
    <!-- display block content -->
    <div id="message"/>
        </div>
        <!-- buttons -->
    <div id="buttons">
        <input type="button" value="Reset" class="btn btn-warning" onclick="javascript:reset()"/>
        <input type="button" value="Relocate" class="btn btn-success" onclick="javascript:reloc()"/>
    </div>

</div><!-- row -->
</div> <!-- END redips-drag -->
