<?
/**
 * TITLE: Документы
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
                <div class="tabs-title">
                    <h1 class="us-title title-yellow"><span>{{ $page->seo->h1 }}</span></h1>
                    <a href="{{ pageurl('about-company') }}" class="title__link">О компании</a>
                    <a href="{{ pageurl('about') }}" class="title__link">О проекте</a>
                    <a href="{{ pageurl('news') }}" class="title__link">Новости</a>
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
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@stop