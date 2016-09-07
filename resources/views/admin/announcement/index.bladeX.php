@extends('admin.layouts.adminlte')

@section('title', 'Announcements')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
	@endsection

	@section('style-app')
		@parent
	@endsection


	@section('scripthead')
		@parent
	@endsection


@section('content')
    <a href="{{ route('admin.announcement.create') }}" class="button">Create New Announcement</a>

    <table class="hover">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Is Approved</th>
                <th>Is Promoted</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($announcements as $announcement)
                <tr class="{{ $announcement->timelineHighlight }}">
                    <td>{{ $announcement->id }}</td>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ $announcement->start_date }}</td>
                    <td>{{ $announcement->end_date }}</td>
                    <td>{{ $announcement->is_approved }}</td>
                    <td>{{ $announcement->is_promoted}}</td>
                    <td>
                        <a href="{{ route('admin.announcement.edit', $announcement->id) }}">
                            <i class="fi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.announcement.confirm', $announcement->id) }}">
                            <i class="fi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


	@section('footer-vendor')
		@parent
	@endsection

	@section('footer-plugin')
		@parent
	@endsection

	@section('footer-app')
		@parent
	@endsection

	@section('footer-script')
		@parent
			<script></script>
	@endsection
