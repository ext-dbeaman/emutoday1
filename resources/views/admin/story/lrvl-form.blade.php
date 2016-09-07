<!-- Story Form -->
@extends('admin.layouts.adminlte')
@section('title', $story->exists ? 'Editing '.$story->title : 'Create New Story')
    @section('style-plugin')
        @parent
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
<!-- Bootstrap Color Picker -->

<!-- Select2 -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

<link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

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
            @parent

        @endsection


        @section('content')
        <div id="vue-form-wrapper" class="row">
            <div class="col-md-7">
                <div class="box box-primary">
                      {!! Form::model($story, [
                        'method' => $story->exists ? 'put' : 'post',
                        'route' => $story->exists ? ['admin.story.update', $story->id] : ['admin.story.store']
                    ]) !!}
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$story->exists ?'Edit ' . $story->story_type : 'New' }}</h3>
                            <div id="vue-box-tools">
                                <box-tools v-ref:boxtools :rte="{{$stypes}}" form-view="create"
                                :current-user="{{$currentUser}}"
                                :record-id="{{$story->id}}"
                                :event
                                :isnotdirty="true"
                                ></box-tools>
                            </div>
                            @if($story->exists )
                                @include('admin.layouts.components.boxtools', ['rte' => $story->story_type, 'path' => 'admin/story/'.$story->story_type , 'cuser'=>$currentUser, 'id'=>$story->id ])
                            @else
                                @include('admin.layouts.components.boxtools', ['rte' => $stypes, 'path' => 'admin/story/'.$stypes , 'cuser'=>$currentUser, 'id'=>$story->id ])

                            @endif

                        </div> 	<!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                        <label for="title">Title</label>
                                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Title', 'id'=>'title']) !!}

                        {{-- <input type="text" id="title" class="form-control" name="title" placeholder="Title"> --}}
                        @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle') !!}
                        {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group teaser">
                        {!! Form::label('teaser') !!}
                        {!! Form::textarea('teaser', null, ['class' => 'form-control', 'rows'=>'4']) !!}
                    </div>
                        <div class="form-group">
                    @if($story->story_type == 'external')
                            {!! Form::label('external_link') !!}
                            {!! Form::text('external_link', null, ['class' => 'form-control']) !!}
                      @else
                          {!! Form::label('content') !!}
                          <textarea id="content" name="content" v-myrte="content">{!!$story->content!!}</textarea>
                          {{-- {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'story-content', 'v-myrte'=> 'content']) !!} --}}

                          {{-- {{ content }} --}}
                      @endif
                  </div><!-- /.form-group -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('start_date') !!}
                                {!! Form::text('start_date', null, ['class' => 'form-control', 'id'=>'start-date']) !!}
                            </div>
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6">
                            @if($story->exists)
                            <div class="form-group">
                                    {!! Form::label('is_approved','Approved', ['class'=>'text-center']) !!}
                                    <div class="row">
                                <div class="col-md-4">
                                    {!! Form::radio('is_approved', 1, $story->is_approved,['class' => 'form-control', 'id'=>'is-approved-yes']) !!}  {!! Form::label('is_approved', 'yes') !!}
                                        </div><!-- /.col-md-4 -->
                                        <div class="col-md-4">
                                    {{ Form::radio('is_approved', 0, $story->is_approved,['class' => 'form-control', 'id'=>'is-approved-no']) }}  {!! Form::label('is_approved', 'no') !!}
                                        </div><!-- /.col-md-4-->
                                </div><!-- /.row -->
                            </div><!-- /.form-group-->
                            @endif
                            {{-- <div class="form-group">
                                {!! Form::label('end_date') !!}
                                {!! Form::text('end_date', null, ['class' => 'form-control', 'id'=>'end-date']) !!}
                            </div> --}}
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                    {!! Form::label('story_type') !!}
                                        @if (is_string($stypes))
                                                {!! Form::text('story_type', $stypes, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        @else
                                        {!! Form::select('story_type', $stypes, null, ['class' => 'form-control']) !!}
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($story->exists)
                                {!! Form::label('Story Group') !!}
                                    {!! Form::text('story_group', $story->storyType->group, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
@endif

                            </div><!-- /.col-md-6 -->
                            {{-- <div class="form-group">
                        {!! Form::label('is_featured', 'Featured') !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::radio('is_featured', 1, $story->is_featured,['class' => 'form-control', 'id'=>'is-featured-yes']) !!}  {!! Form::label('is_featured', 'yes') !!}
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-4">
                                {!! Form::radio('is_featured', 0, $story->is_featured,['class' => 'form-control', 'id'=>'is-featured-no'] ) !!}  {!! Form::label('is_featured', 'no') !!}
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.form-group --> --}}
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->
                @can('admin', $currentUser)
                    @if($story->exists)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('tag_list', 'Tags:') !!}
                                {!! Form::select('tag_list[]',$tags, $story->tags->lists('id')->toArray() , ['class' => 'form-control select2', 'multiple']) !!}
                            </div>
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->
                @endif
                @endcan


                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit($story->exists ? 'UPDATE' : 'Create New', ['class' => 'btn btn-primary btn-block']) !!}

                                </div>
                                {!! Form::close() !!}
                            </div><!-- /.col-md-12 -->
                        </div><!-- /.row -->
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
    </div><!-- /.col-md-6-->

        <div class="col-md-5">
            @can('admin', $currentUser)
            @if($story->exists)
                    @if($story->story_type == 'news')
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <form action="promoteStory" method="POST">
                                        {{ csrf_field() }}
                                        {!! Form::select('new_story_type', $stypelist, 'story', ['class' => 'form-control']) !!}
                                        <button class="btn btn-primary" href="#">Promote Story</button>
                                    </form>
                                </div>
                            </div>
                    @else
                            @if ($story->storyImages()->count() > 0)
                                @foreach($story->storyImages as $storyImage)
                                    @if($storyImage->image_type == 'small')
                                        @include('admin.storyimages.subviews.smallimage',['storyImage' => $storyImage, 'story_id' => $story->id ])
                                    @elseif($storyImage->image_type == 'story')
                                        @include('admin.storyimages.subviews.storyimage',['storyImage' => $storyImage, 'story_id' => $story->id ])
                                    @elseif($storyImage->image_type == 'front')
                                        @include('admin.storyimages.subviews.frontimage',['storyImage' => $storyImage, 'story_id' => $story->id ])
                                    @else
                                        @include('admin.storyimages.subviews.otherimage',['storyImage' => $storyImage, 'story_id' => $story->id ])
                                    @endif
                                @endforeach
                            @endif
                            @if ($leftOverImages->count() > 0)
                                @foreach($leftOverImages as $leftOverImage)
                                        @include('admin.story.subviews.addstoryimage',['otherImage' => $leftOverImage, 'story_id' => $story->id ])
                                @endforeach

                            @endif
                    @endif

                @endif
            @endcan
        </div><!-- /.col-md-6 -->


    </div><!-- /.row -->
@endsection
@section('footer-plugin')
    @parent

<!-- Select2 -->
<script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script src="/themes/plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>

    @endsection
    @section('scriptsfooter')
        @parent

    @endsection
    @section('footer-script')
        @parent
        <script src="/js/vue-form-wrapper.js"></script>

<script>
$(function () {
    var itemrte = JSvars.stype;
    // var previewLabel = "#" + itemrte + "-preview";
    // var previewBtn = $(previewLabel);
    // console.log("previewBtn="+previewBtn.html);
    // previewBtn.on('click', '.fa-eye', function (ev) {
    //     ev.preventDefault();
    //     console.log("previewLabel="+previewLabel );
    // });



    // //   CKEDITOR.replace('story-content');
    // var storyEditor =    CKEDITOR.replace( 'story-content', {
    //         // Define changes to default configuration here. For example:
    //         filebrowserWindowFeatures: 'resizable=no',
    //         filebrowserBrowseUrl : '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
    //         filebrowserImageBrowseUrl: '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
    //         filebrowserUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
    //         filebrowserImageUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
    // } );
    // storyEditor.on('change', function(evt) {
    //     console.log( 'Total bytes: ' + evt.editor.getData().length );
    // })

        //bootstrap WYSIHTML5 - text editor
        // $("#story-content").wysihtml5();
    //Initialize Select2 Elements
    $(".select2").select2();


        $('input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        })

        if (JSvars.is_featured == 1) {
            $('#is-featured-yes').iCheck('check');

        } else {
            $('#is-featured-no').iCheck('check');
            $('#is-featured-yes').iCheck('disable');
        }


    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });


        //Start Date picker
        $('#start-date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });

        //End Date picker
        // $('#end-date').datetimepicker({
        //     format: 'YYYY-MM-DD HH:mm:ss',
        //     useCurrent: false //Important! See Issue #1075
        // });
        // $("#start-date").on("dp.change", function (e) {
        //             $('#end-date').data("DateTimePicker").minDate(e.date);
        //     });
        //     $("#end-date").on("dp.change", function (e) {
        //             $('#start-date').data("DateTimePicker").maxDate(e.date);
        //     });

        // document.getElementById("externalButton").onclick = function () {
        //
        // var vuedata = document.getElementById("vue-box-tools");
        // // vm.$refs.boxtools.setDirtyValue = 99;
        // console.log('vuedata===='+ vuedata.$data);
    // }
        // $('#vue-box-tools').$refs.boxtools.setDirtyValue = 99;
  });
$('input[name=title]').on('blur', function () {
        var slugElement = $('input[name=slug]');

        if (slugElement.val()) {
                return;
        }

        slugElement.val(this.value.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, ''));
});



</script>
@endsection
