<?
/**
 * TITLE: Готовые дома
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php $lands = Land::all(); ?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="us-page">
        <div class="wrapper">
            <h1 class="us-title title-green"><span>{{ $page->seo->h1 }}</span></h1>

            <div class="us-desc">
                Воспользуйтесь фильтрами для поиска подходящего варианта. На этой странице – готовые дома и некоторые
                типовые проекты наших партнеров.
            </div>
            <div class="build-filter">
                @include(Helper::layout('forms.buildings-filter'))
                <div class="clearfix"></div>
                <div class="filter__update js-filter-loading"></div>
            </div>
        </div>
        <div class="done">
            <div class="wrapper">
                <div class="done-wrapper js-done-wrapper">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        Dictionary = window.Dictionary || {};
        Dictionary.buildings = {
@if($lands->count())
    @foreach($lands as $land)
            "{{ $land->id }}": {
                id: {{ $land->id }}, number: "{{ $land->number }}", land_area: {{ $land->area }}, price: {{ $land->price }}, price_total: {{ $land->price_house }},
                coordinate_x: {{ $land->coordinate_x }}, coordinate_y: {{ $land->coordinate_y }}, sold: {{ $land->sold }}, status: {{ $land->status }}, turn: {{ $land->turn }}
            },
    @endforeach
@endif
        };
    </script>
@stop