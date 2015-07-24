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
    if ($sliders = Dictionary::valuesBySlug('main_baners', NULL, 'all', TRUE)):
        foreach ($sliders as $index => $slider):
            if ($slider['photo']):
                $sliders[$index]['photo_name'] = Photo::where('id', $slider['photo'])->pluck('name');
            endif;
        endforeach;
    endif;
    if ($communications = Dictionary::valuesBySlug('communications_units', NULL, 'all', TRUE)):
        foreach ($communications as $index => $communication):
            if ($communication['photo']):
                $communications[$index]['photo_name'] = Photo::where('id', $communication['photo'])->pluck('name');
            endif;
        endforeach;
    endif;
    $gallery = array();
    if ($buildings_photos = Buildings::where('photo_id', '>', 0)->orderByRaw("RAND()")->take(25)->lists('photo_id')):
        $gallery = Photo::whereIn('id', $buildings_photos)->lists('name');
    endif;
    ?>

    <main class="main js-main">
        @if(count($sliders))
            <div class="index-slider js-index-slider">
                <div class="slider__list">
                    @foreach($sliders as $slider)
                        @if(isset($slider['photo_name']) && File::exists(Config::get('site.galleries_photo_dir').'/'.$slider['photo_name']))
                            <div style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$slider['photo_name']) }});"
                                 class="list__item js-slide">
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
                <ul class="slider__dots js-dots"></ul>
            </div>
        @endif
        <div class="index-block">
            <div class="wrapper">
                <div class="block__map-icon"></div>
                <div class="block__text">{{ $page->block('card') }}</div>
                <div class="block__btn"><a href="{{ pageurl('about') }}" class="us-btn btn-white"><span>Карта</span></a>
                </div>
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
                    {{ $page->block('communication') }}
                </div>
                <div class="block__btn"><a href="{{ pageurl('communications') }}" class="us-btn btn-blue"><span>Узнать подробнее</span></a>
                </div>
            </div>
        </div>
        @if(count($communications))
            <div class="index-benefits">
                <div class="benefits-container">
                    @foreach($communications as $communication)
                        <div class="benefits__item">
                            <div class="item__image"
                                 style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$communication['photo_name']) }});"></div>
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
                    <div class="block__text text-min">

                    </div>
                    <div class="block__btn"><a href="#" class="us-btn btn-green"><span>Подбор участка</span></a></div>
                </div>
            </div>
            <div class="block-line">
                <div class="wrapper">
                    <div class="line__inside"><b>Готовность:</b><span>{{ $page->block('readiness') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @if(count($gallery))
            <div class="index-gallery">
                <div class="gallery__line">
                    @foreach($gallery as $photo)
                        <a href="javascript:void(0);"
                           style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo) }});"
                           class="line__item"></a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>
@stop
@section('scripts')
@stop