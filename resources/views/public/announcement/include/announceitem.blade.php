<li class="{{$announcement->id == $id ? 'accordion-item is-active':'accordion-item' }}" id="accitem-{{$announcement->id}}" data-accordion-item>
{{-- <li class="accordion-item" data-accordion-item> --}}
	<a href="#" class="accordion-title">{{$announcement->title}}</a>
	<div class="accordion-content" data-tab-content>
		{!! $announcement->announcement !!}
		<p>posted {{$announcement->present()->prettyDate}}</p>
	</div>
</li>
