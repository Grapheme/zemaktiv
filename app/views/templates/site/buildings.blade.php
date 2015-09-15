<?
/**
 * TITLE: Готовые дома
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
$lands = Land::orderByRaw('number + 0')->get();
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="us-page">
        <div class="wrapper">
            <h1 class="us-title title-green"><span>{{ $page->seo->h1 }}</span></h1>
            <div class="us-desc">
                Закажите постройку дома или заселяйтесь в готовый
            </div>
            <div class="us-desc">
                Воспользуйтесь фильтрами для поиска подходящего варианта. На этой странице – готовые дома и некоторые
                типовые проекты наших партнеров. <span class="info-tooltip" data-tooltip="Типовые проекты —  популярные варианты домов. Это не означает, что вы ими ограничены — вносите корректировки или закажите индивидуальный проект."></span>
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
        Dictionary.buildings = {@if($lands->count()) @foreach($lands as $land){{ View::make(Helper::layout('assets.buildings-js'),compact('land'))->render() }}@endforeach @endif};
    </script>
@stop