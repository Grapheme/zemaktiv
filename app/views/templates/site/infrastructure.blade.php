<?
/**
 * TITLE: Инфраструктура
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
if ($infrastructures = Dictionary::valuesBySlug('infrastructures', NULL, 'all', TRUE)):
    foreach ($infrastructures as $index => $infrastructure):
        if ($infrastructure['photo']):
            $infrastructures[$index]['photo_name'] = Photo::where('id', $infrastructure['photo'])->pluck('name');
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
                    <h1 class="us-title title-red"><span>Инфраструктура</span></h1>
                    <a href="{{ pageurl('location') }}" class="title__link">Расположение</a>
                </div>
                {{ $page->block('title') }}
                <div class="places-list">
                @foreach($infrastructures as $infrastructure)
                    <div class="list__item" data-title="{{ $infrastructure['name'] }}" data-image="{{ asset(Config::get('site.galleries_photo_public_dir').'/'.$infrastructure['photo_name']) }}" data-desc="{{ $infrastructure['content'] }} data-longitude="{{ $infrastructure['longitude'] }}" data-latitude="{{ $infrastructure['latitude'] }}">
                        <div class="item__image">
                            <div class="item__back {{ $infrastructure['item_back_class'] }}"></div>
                            <div class="item__icon" style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$infrastructure['photo_name']) }})"></div>
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