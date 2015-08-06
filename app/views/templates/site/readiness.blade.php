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
            <div class="page__left">
                <div class="tabs-title many-tabs">
                    <h1 class="us-title title-yellow"><span>{{ $page->seo->h1 }}</span></h1>
                    @include(Helper::layout('about-menu'),array('hidden'=>'readiness'))
                </div>
                <div class="us-article">
                    {{ $page->block('content') }}
                </div>
            </div>
            <div class="page__right">

            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop