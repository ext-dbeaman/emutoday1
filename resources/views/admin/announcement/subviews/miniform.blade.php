<div class="panel panel-default">
  <div class="panel-body row">
		<div class="col-md-6">

			<a href="#" class="accordion-title">{{$item->title}}</a>
			<div class="accordion-content">
				{!! $item->announcement !!}
				<p>posted {{$item->present()->prettyDate}}</p>
			</div>
		</div><!-- /.col-md-6 -->
  <div class="col-md-2">
  <p>from :{{$item->start_date}} - {{$item->end_date}}</p>
  </div><!-- /.col-md-3 -->
	<div class="col-md-3">
		<form method="POST"
      action="/admin/annocement/{{$item->id}}"
      v-ajax complete="Okay, the post has been deleted."
  >
    {{ csrf_field() }}
		{!! Form::checkbox('is_approved', 1, true , ['']) !!}
		var checkicon = (data == 1)?'check-square-o' :'square-o';
		return "<i class='fa fa-"+checkicon+"'></i>"
    <button type="submit">Delete Post</button>
</form>
	</div><!-- /.col-md-3 -->
  </div>
</div>
