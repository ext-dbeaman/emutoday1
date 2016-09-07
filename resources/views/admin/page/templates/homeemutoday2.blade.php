<div id="redips-drag">
    <!-- tables inside this DIV could have drag-able content -->
    <!-- left container -->
    <div id="left">
        <table id="table1">
            <colgroup>
                <col width="100"/>
                <col width="300"/>
            </colgroup>
            @foreach ($storys as $story)
                <tr>
                    <td class="redips-single">
                        {{-- <img src="{{$story->grabStoryImageByType('imagemain')->mainImageURL() }}" id="{{$story->id}}" class="redips-drag orange" alt="feature-image"></a> --}}
                        
                        <div id="{{$story->id}}" class="redips-drag orange">{{$story->grabStoryImageByType('imagemain')->mainImageURL()}} </div>
                    </td>
                    <td>
                        Title = {{$story->title}} Type = {{$story->story_type}}
                    </td>
                </tr>
                @endforeach
            <tr>
                <td class="redips-trash">Trash</td>
            </tr>
        </table>
    </div>

    <!-- right container -->
    <div id="right">
        <table id="table2">
        <colgroup>
            <col width="400" />
        </colgroup>
        <tr>
            <td id="emuhome0"></td>
        </tr>
        <tr>
            <td>


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


</div> <!-- END redips-drag -->
