<div class="panel box box-primary">
	<div class="box-header with-border row">
		<div class="col-md-5">
				{{$item->title}}
			</div><!-- /.col-md-3 -->
			<div class="col-md-2">
				{{$item->submission_date}}
			</div><!-- /.col-md-3 -->
			<div class="col-md-2">
				{{$item->start_date}}
			</div><!-- /.col-md-3 -->
			<div class="col-md-1">
				{{$item->is_approved}}
			</div><!-- /.col-md-3 -->
			<div class="col-md-1">
				{{$item->priority}}
			</div><!-- /.col-md-3 -->
			<div class="col-md-1">
				<a data-toggle="collapse"  data-parent="#accordion" class="btn btn-box-tool" href="#collapse{{$item->id}}"><i class="fa fa-plus"></i>
				</a>

			</div><!-- /.col-md-2 -->
		</div><!-- /.row -->
	<div id="collapse{{$item->id}}" class="panel-collapse collapse">
		<div class="box-body row">

				<div class="col-md-5">
					{{$item->announcement}}
				</div><!-- /.col-md-3 -->
				<div class="col-md-2">

				</div><!-- /.col-md-3 -->
				<div class="col-md-2">
					{{$item->end_date}}
				</div><!-- /.col-md-3 -->
				<div class="col-md-1">

				</div><!-- /.col-md-3 -->
				<div class="col-md-1">

				</div><!-- /.col-md-3 -->
		</div>
</div>
</div>
