<?
/**
 * TITLE: Выбор участка
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
	<?php
	    $buildings = Buildings::orderBy('number','ASC')->with('photo', 'gallery.photos')->paginate(5);
	?>

	<script>
		Dictionary = window.Dictionary || {};
		var Dictionary.buildings = {
		@if($buildings->count())
	        @foreach($buildings as $build)
	        	"{{ $build->id }}": {
	        		id: {{ $build->id }},
	        		number: {{ $build->number }},
	        		land_area: {{ $build->land_area }},
	        		material: "{{ $build->material }}",
	        		communication: "{{ $build->communication }}",
	        		price: {{ $build->price }}
	        	},
	        @endforeach
		@endif
		};
		console.log(buildings);
	</script>
    {{ $page->draw_blocks() }}
@stop
@section('scripts')
@stop