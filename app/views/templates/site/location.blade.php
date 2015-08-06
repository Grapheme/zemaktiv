<?
/**
 * TITLE: Расположение
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="half-page infra-page">
        <div id="location-map" class="infra-map"></div>
        <div class="wrapper">
            <div class="page__left">
                <div class="tabs-title">
                    <h1 class="us-title title-red"><span>{{ $page->seo->h1 }}</span></h1>
                    <div class="tabs-right">
                        <div class="right-cont">
                            <a href="{{ pageurl('infrastructure') }}" class="title__link">Путеводитель</a>
                        </div>
                    </div>
                </div>
                {{ $page->block('title') }}
                <div class="way-container">
                    <div class="way-list">
                        <div class="list__item active">
                            <div class="item__image image-bus"></div>
                            <div class="item__desc">На транспорте</div>
                        </div>
                    </div>
                    <div class="us-article">
                        {{ $page->block('description_bus') }}
                    </div>
                    <div class="way-list">
                        <div class="list__item active">
                            <div class="item__image image-car"></div>
                            <div class="item__desc">На авто</div>
                        </div>
                    </div>
                    <div class="us-article">
                        {{ $page->block('description_car') }}
                    </div>
                    <div class="way-btns">
                        <a href="#" class="us-btn btn-white js-way-btn"><span>Через «Чехов»</span></a><!--
                     --><a href="#" class="us-btn btn-white js-way-btn"><span>Через переезд</span></a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@stop