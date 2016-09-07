@section('content')
@foreach($files as $file)
	dd($file["basename"]);
<a href='{{url("/imgs/uploads/story/".$file["basename"])}}'><img src='{{url("/imgs/uploads/story/".$file["basename"])}}'></a>
@endforeach
@endsection
@section('footer')
<script type="text/javascript">
$('a[href]').on('click', function(e){
window.opener.CKEDITOR.tools.callFunction(<?php echo $test; ?>,$(this).find('img').prop('src'))
});
</script>
@endsection
