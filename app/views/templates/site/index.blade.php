<?
/**
* TITLE: Главная страница
* AVAILABLE_ONLY_IN_ADVANCED_MODE
*/
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
<?php
    if($sliders = Dictionary::valuesBySlug('main_baners',NULL,'all',TRUE)):
        foreach($sliders as $index => $slider):
            if($slider['photo']):
                $sliders[$index]['photo_name'] = Photo::where('id', $slider['photo'])->pluck('name');
            endif;
        endforeach;
    endif;
    if($communications = Dictionary::valuesBySlug('communications_units',NULL,'all',TRUE)):
        foreach($communications as $index => $communication):
            if($communication['photo']):
                $communications[$index]['photo_name'] = Photo::where('id', $communication['photo'])->pluck('name');
            endif;
        endforeach;
    endif;
?>

<main class="main js-main">
@if(count($sliders))
    <div class="index-slider">
        <div class="slider__list">
        @foreach($sliders as $slider)
            @if(isset($slider['photo_name']) && File::exists(Config::get('site.galleries_photo_dir').'/'.$slider['photo_name']))
            <div style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$slider['photo_name']) }});" class="list__item">
                <div class="wrapper">
                    <div class="item-content">
                        <div class="item__title">
                            {{ $slider->content }}
                        </div>
                        @if(!empty($slider['link']))
                        <div class="item__btns">
                            <a href="{{ $slider['link'] }}" class="us-btn btn-transparent"><span>Выбрать участок</span></a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        </div>
        <ul class="slider__dots"></ul>
    </div>
@endif
    <div class="index-block">
        <div class="wrapper">
            <div class="block__map-icon"></div>
            <div class="block__text">Симферопольское шоссе, 70 км от МКАД</div>
            <div class="block__btn"><a href="{{ pageurl('about') }}" class="us-btn btn-white"><span>Карта</span></a></div>
        </div>
    </div>
    <div class="index-filter">
        <a href="{{ pageurl('choice-land') }}" class="filter__item">
            <div class="item__title">Готовые дома за 3.5 млн</div>
        </a>
        <a href="{{ pageurl('choice-land') }}" class="filter__item">
            <div class="item__title">Участки без подряда</div>
        </a>
    </div>
    <div class="index-block">
        <div class="wrapper">
            <div class="block__title">Коммуникации</div>
            <div class="block__text text-min">
                Газ, электричество, водопровод входят в стоимость земельного участка.<br>Забор с калиткой и воротами тоже.
            </div>
            <div class="block__btn"><a href="{{ pageurl('communications') }}" class="us-btn btn-blue"><span>Узнать подробнее</span></a></div>
        </div>
    </div>
@if(count($communications))
    <div class="index-benefits">
        <div class="benefits-container">
        @foreach($communications as $communication)
            <div class="benefits__item">
                <div class="item__image" style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$communication['photo_name']) }});"></div>
                <div class="item__title">{{ $communication['name'] }}</div>
                <div class="item__desc">
                    {{ $communication['anonce'] }}
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endif
    <div class="index-block block-choise">
        <div class="block-container">
            <div class="wrapper">
                <div class="block__title">Выбор участка</div>
                <div class="block__text text-min">Вы можете выбрать участок на карте либо подобрать подходящий лично
                    вам<br>по
                    параметрам и тех. особенностям. От 9 до 25 соток.
                </div>
                <div class="block__btn"><a href="#" class="us-btn btn-green"><span>Подбор участка</span></a></div>
            </div>
        </div>
        <div class="block-line">
            <div class="wrapper">
                <div class="line__inside"><b>Готовность:</b><span>высажено 16 декоративнолиственных кустарников, 14 фруктовых деревьев.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="index-gallery">
        <div class="gallery__line"><a href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                                      class="line__item"></a><a href="#"
                                                                style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                                                                class="line__item"></a><a href="#"
                                                                                          style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                                                                                          class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a><a
                    href="#" style="background-image: url(images/tmp/index-bottom-slider1.jpg);"
                    class="line__item"></a>
        </div>
    </div>
</main>
@stop
@section('scripts')
@stop