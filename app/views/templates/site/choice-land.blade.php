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
	    $lands = Land::all();
	?>

	<script>
		Dictionary = window.Dictionary || {};
		Dictionary.buildings = {
		@if($lands->count())
	        @foreach($lands as $land)
	        	"{{ $land->id }}": {
	        		id: {{ $land->id }},
	        		number: {{ $land->number }},
	        		land_area: {{ $land->area }},
	        		price: {{ $land->price }},
	        		coordinate_x: {{ $land->coordinate_x }},
	        		coordinate_y: {{ $land->coordinate_y }},
	        		sold: {{ $land->sold }},
	        		status: {{ $land->status }},
	        		turn: {{ $land->turn }}
	        	},
	        @endforeach
		@endif
		};
	</script>
    {{ $page->draw_blocks() }}
@stop
@section('scripts')
@stop