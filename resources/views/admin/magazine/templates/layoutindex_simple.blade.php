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
                    <td class="redips-mark {{$story->is_featured?'bg-orange':'bg-navy'}}">
                            {{$story->id}}
                    </td>

                    @if($story->is_featured)
                        <td class="redips-mark drag-{{$story->id}}x">
                                <div id="drag-{{$story->id}}x" class="redips-drag bg-orange" data-imgtype="front" data-imgname="{{$story->images()->ofType('front')->first()->filename}}"></a>{{$story->id}}</div>
                        </td>
                            @else
                            <td class="redips-mark drag-{{$story->id}}">
                                <div id="drag-{{$story->id}}" class="redips-drag bg-navy" data-imgtype="small" data-imgname="{{$story->images()->ofType('small')->first()->filename}}"></a>{{$story->id}}</div>
                            </td>
                            @endif

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
            <col width="550" />
        </colgroup>
        <tr>
            <td id="magstory0" class="redips-mark redips-single hero">
            </td>
        </tr>
        <tr>
            <td class="redips-mark">


                <table class="five-stories-bar">
                    <colgroup>
                        <col width="110"/> <!--  first activity column -->
                        <col width="110"/> <!--  first activity column -->
                        <col width="110"/> <!--  first activity column -->
                        <col width="110"/> <!--  first activity column -->
                        <col width="110"/> <!--  first activity column -->
                    </colgroup>
                    <tr>
                        <td class="redips-single"  id="magstory1">
                        </td>
                        <td class="redips-single"  id="magstory2">
                        </td>
                        <td  class="redips-single"  id="magstory3">
                        </td>
                        <td class="redips-single"  id="magstory4">
                        </td>
                        <td  class="redips-single"  id="magstory5">
                        </td>
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
    <input type="button" value="Reset" class="button" onclick="javascript:reset()"/>
    <input type="button" value="Relocate" class="button" onclick="javascript:reloc()"/>
</div>

</div>
</div> <!-- END redips-drag -->
