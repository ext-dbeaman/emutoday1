@extends('admin.layouts.global')

@section('title', 'Story')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="form-inline">
			<button class="btn custom-btn" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseExample">
				<span class="glyphicon glyphicon-filter"></span>

				<span class="glyphicon glyphicon-chevron-down"></span>
			</button>
			<div class="form-group">
    <label for="currentTypeFilter">Filters:</label>
    <input type="text" class="form-control" id="currentTypeFilter" placeholder="{{$stype}}" readonly>
  </div>
		</div>

		<div class="collapse" id="collapseFilter">
		  <div class="well">
				<form class="form-inline">
			<div class="form-group">
				<label for="stype">Type</label>
				{!! Form::select('stype', $stypes, $stype, ['id'=> 'stype', 'class' => 'form-control input-sm']) !!}
			</div>
			<div class="form-group">
				<label for="isfeatured">Featured</label>
				{!! Form::select('stype', $stypes, $stype, ['id'=> 'isfeatured', 'class' => 'form-control input-sm']) !!}
			</div>
			<button type="submit" class="btn btn-default">Send invitation</button>
		</form>
		  </div>
		</div>


	</div>
	<div class="col-md-6 text-right">
		<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseNew" aria-expanded="false" aria-controls="collapseExample">
			<span class="glyphicon glyphicon-plus-sign"></span>
			<span class="glyphicon glyphicon-chevron-down"></span>
		</button>
		<div class="collapse" id="collapseNew">
		  <div class="well">
		<a href="{{ route('admin_story_setup', ['stype' => 'storybasic']) }}" class="btn btn-primary btn-sm">Create News Story</a>
		<a href="{{ route('admin_story_setup', ['stype' => 'story']) }}" class="btn btn-primary btn-sm">Create Promoted Story</a>
		<a href="{{ route('admin_story_setup', ['stype' => 'storyexternal']) }}" class="btn btn-primary btn-sm">Create External Story</a>
</div>
</div>

</div>
</div>


	<div class="row">
	<div class="col-md-12">


		<table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">id</th>
								<th class="text-left">Type</th>
                <th class="text-left">Title</th>
                <th class="text-left">Author</th>
                <th class="text-left">Start Date</th>
								<th class="text-left">End Date</th>
                <th class="text-center">Featured</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($storys as $story)
                <tr class="{{ $story->present()->publishedHighlight }}">
                    <td class="text-center">{{ $story->id }}</td>
                    <td>{{ $story->story_folder }}</td>
                    <td>
                        <a href="{{ route('admin.story.show', $story->id) }}">{{ $story->title }}</a>
                    </td>
                    <td>{{ $story->author->last_name }}</td>
                    <td>{{ $story->present()->publishedStartDate }}</td>
										  <td>{{ $story->present()->publishedEndDate }}</td>
                    <td class="text-center">{{ $story->is_featured }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.story.edit', $story->id) }}">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.story.confirm', $story->id) }}">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {!! $storys->render() !!} --}}
		{{ $storys->links() }}
	</div>

	</div>
@endsection
@section('footer')
    @parent
		<script>
		$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-chevron-down").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-chevron-up").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
});
		var cpage = '{{ $storys->currentPage() }}';


			$("#stype").change(function (e) {
					var stype = e.target.value;
					var url = '/admin/story?page=' + cpage + '&stype=' + stype;
			    console.log(url);
					document.location = url;

			});
</script>
	@endsection
