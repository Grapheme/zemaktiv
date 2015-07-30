<?
/**
 * TITLE: Фотографии
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
$gallery = array();
if(Gallery::where('name', 'Основная галерея')->exists()):
    $gallery = Gallery::where('name', 'Основная галерея')->first()->photos;
endif;
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
        <div class="wrapper relative">
            <div class="wrapper-photos">
                <h1 class="us-title title-photos page-full"><span>{{ $page->seo->h1 }}</span></h1>
            </div>
        </div>
        @if(count($gallery))
        <div class="block-photos">
            @foreach($gallery as $photo)
            <div class="photos__item">
                <a rel="photos" href="{{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }}" class="item__link js-fancybox">
                    <span style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }});" class="link__back"></span>
                    <span class="link__hover"></span>
                </a>
            </div>
            @endforeach
        </div>
        @endif
@stop
@section('scripts')
@stop