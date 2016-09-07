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
                        {{-- <img src="{{$story->grabStoryImageByType('imagemain')->mainImageURL() }}" id="{{$story->id}}" class="redips-drag orange" alt="feature-image"></a> --}}

                        @if($story->is_featured)
                            <div id="drag-{{$story->id}}x" class="redips-drag  bg-orange" data-imgfilename="{{$story->storyImages()->filename}}"></a>{{$story->id}}</div>
                        @else
                            <div id="drag-{{$story->id}}" class="redips-drag  bg-navy" data-imgfilename="{{$story->storyImages->filename}}"></a>{{$story->id}}</div>
                        @endif


                        {{-- <div id="{{$storyImage->id}}" class="redips-drag orange"><img src="{{$storyImage->thumbnailImageURL() }}" id="{{$storyImage->id}}" class="redips-drag orange" alt="feature-image"></a></div> --}}
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
            <td id="emuhome0" class="redips-mark hero"></td>
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
                    <td id="emuhome1"></td>
                    <td id="emuhome2"></td>
                    <td id="emuhome3"></td>
                    <td id="emuhome4"></td>
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
