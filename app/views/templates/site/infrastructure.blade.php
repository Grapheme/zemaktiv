<?
/**
 * TITLE: Путеводитель
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
if ($infrastructures = Dictionary::valuesBySlug('infrastructures', NULL, 'all', TRUE)):
    foreach ($infrastructures as $index => $infrastructure):
        if ($infrastructure['photo']):
            $infrastructures[$index]['photo_path'] = Upload::where('id', $infrastructure['photo'])->pluck('path');
        endif;
    endforeach;
endif;
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="half-page infra-page">
        <div id="infra-map" class="infra-map"></div>
        <div class="wrapper">
            <div class="page__left">
                <div class="tabs-title">
                    <h1 class="us-title title-red"><span>{{ $page->seo->h1 }}</span></h1>
                    <div class="tabs-right">
                        <div class="right-cont">
                            <a href="{{ pageurl('location') }}" class="title__link">Расположение</a>
                        </div>
                    </div>
                </div>
                {{ $page->block('title') }}
                <div class="places-list">
                @foreach($infrastructures as $infrastructure)
                    <div class="list__item js-balloon-item" data-title="{{ $infrastructure['name'] }}" data-image="{{ asset($infrastructure['photo_path']) }}" data-desc="{{ $infrastructure['content'] }}" data-longitude="{{ $infrastructure['longitude'] }}" data-latitude="{{ $infrastructure['latitude'] }}">
                        <div class="item__image">
                            <div class="item__back"></div>
                            <div class="item__icon" style="background-image: url({{ asset($infrastructure['photo_path']) }})"></div>
                        </div>
                        <div class="item__desc">{{ $infrastructure['name'] }}</div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@stop