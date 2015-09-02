<?
/**
 * TITLE: Главная страница
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
 <?php
if ($sliders = Dictionary::valuesBySlug('main_baners',function($query){$query->orderBy('lft', 'ASC');}, 'all', TRUE)):
    foreach ($sliders as $index => $slider):
        if ($slider['photo']):
            $sliders[$index]['photo_name'] = Photo::where('id', $slider['photo'])->pluck('name');
        endif;
    endforeach;
endif;
if ($communications = Dictionary::valuesBySlug('communications_units', function($query){$query->orderBy('lft', 'ASC');}, 'all', TRUE)):
    foreach ($communications as $index => $communication):
        if ($communication['photo']):
            $communications[$index]['photo_name'] = Photo::where('id', $communication['photo'])->pluck('name');
        endif;
    endforeach;
endif;
$gallery = array();
if (Gallery::where('name', 'Галерея на главной')->exists()):
    $gallery = Gallery::where('name', 'Галерея на главной')->first()->photos;
endif;
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
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
                                            <a href="{{ $slider['link'] }}"
                                               class="us-btn btn-transparent"><span>{{ $slider['link_title'] }}</span></a>
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
            <div class="block__btn"><a href="{{ URL::to('location') }}" class="us-btn btn-white"><span>Карта</span></a>
            </div>
        </div>
    </div>
    <div class="index-filter">
        <a href="{{ pageurl('buildings') }}" class="filter__item">
            <div class="item__title">{{ $page->block('btn_buildings') }}</div>
        </a>
        <a href="{{ pageurl('choice-land') }}" class="filter__item">
            <div class="item__title">{{ $page->block('btn_land') }}</div>
        </a>
    </div>
    <div class="index-block mortgage-block">
        <div class="wrapper">
            <div class="block__title">Схемы покупки</div>
            <div class="block__text text-min">Воспользуйтесь ипотекой от Сбербанка или рассрочкой от застройщика.</div>
            <div class="mortgage">
                <div class="mortgage__item" style="background-image: url({{ Config::get('site.theme_path') }}/images/mortgage/sberbank.png)"></div>
                <div class="mortgage__item" style="background-image: url({{ Config::get('site.theme_path') }}/images/mortgage/zemaktiv.png)"></div>
            </div>
            <div class="block__btn">
                <a href="#" class="us-btn btn-blue js-open-overlay" data-open="mortgage"><span>Получить консультацию</span></a>
            </div>
        </div>
    </div>
    @if(FALSE)
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
    @endif
    @if(count($communications))
        <div class="index-benefits">
            <div class="benefits-container">
                @foreach($communications as $communication)
                    <div class="benefits__item">
                        <div class="item__image"
                             style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$communication['photo_name']) }});"></div>
                        <div class="item__title">{{ $communication['name'] }}</div>
                        <div class="item__desc">
                            {{ $communication['content'] }}
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
                    {{ $page->block('choice_land') }}
                </div>
                <div class="block__btn"><a href="{{ pageurl('choice-land') }}" class="us-btn btn-green"><span>Выбор участка</span></a>
                </div>
            </div>
        </div>
        <div class="block-line">
            <div class="wrapper">
                <div class="line__inside">
                    <b>Готовность:</b>
                    <?php
                        $readiness = NULL;
                        $readiness_string = $page->block('readiness');
                        if(!empty($readiness_string)):
                            $readiness = explode("\n",$readiness_string);
                        endif;
                    ?>
                    <span class="relative">
                    @foreach($readiness as $line)
                        @if(!empty($line))
                        <span class="js-inside-slide inside__slide">{{ $line }}</span>
                        @endif
                    @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
    @if(count($gallery))
        <div class="index-gallery js-line-gallery">
            <div class="gallery__line js-line">
                @foreach($gallery as $photo)
                    <a rel="gallery" href="{{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }}"
                       style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }});"
                       class="js-fancybox line__item"></a>
                @endforeach
            </div>
        </div>
    @endif
    <!--TEST67890-->
@stop
@section('scripts')
@stop