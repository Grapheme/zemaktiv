<?
/**
 * TITLE: Готовность
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="half-page">
        <div class="wrapper">
            <div class="page-full">
                <div class="tabs-title">
                    <h1 class="us-title title-blue"><span>{{ $page->seo->h1 }}</span></h1>
                </div>
                <div class="us-article">
                    {{ $page->block('content') }}
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop