<?
/**
 * TITLE: Выбор участка
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
$lands = Land::all();
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <main class="main js-main">
        <div class="wrapper-choise js-choise-wrapper">
            <div class="js-choise-map">
                <div class="wrapper relative">
                    <div class="wrapper-photos">
                        <h1 class="us-title title-choise page-full"><span>{{ $page->seo->h1 }}</span></h1>
                    </div>
                    <div class="wrapper-params">
                        <a href="#" style="display: none" class="choise__toparams js-show-filter">
                            <span class="toparams__title">Подбор по параметрам</span>
                            <span class="toparams__desc">Цена и площадь</span>
                        </a>
                    </div>
                </div>
                <div class="choise__map js-map-container">
                    <div class="map__image js-map">
                        <div class="image__tooltip js-tooltip">
                            <a href="#" class="tooltip__close js-close"></a>

                            <div class="tooltip__title">Участок №<span class="js-bnum"></span></div>
                            <div class="tooltip__subtitle">Очередь: <span class="js-bturn"></span></div>
                            <ul class="tooltip__list">
                                <li class="list__item"><span class="js-barea"></span> соток</li>
                                <li class="list__item"><span class="js-bcont"></span></li>
                                <li class="list__item"><span class="js-bprice"></span> руб.</li>
                            </ul>
                            <div class="tooltip__btn"><a href="#" data-id class="js-book us-btn btn-white"><span>Забронировать</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="js-choise-filter choise-filter">
                    <div class="wrapper">
                        <div class="page__full">
                            <h1 class="us-title title-choise"><span>{{ $page->seo->h1 }}</span></h1>
                            <a href="#"
                               class="choise__tomap us-btn btn-white js-show-map"><span>Выбрать на генплане</span></a>

                            <div class="filter__form">
                                <form class="js-filter-form">
                                    <div class="form__left">
                                        <div class="form__title">Участки</div>
                                        <div class="left__check">
                                            <input value="0" name="withoutpod" id="withoutpod" type="checkbox"
                                                   checked="checked"
                                                   class="js-checkbox">
                                            <label for="withoutpod">Без подряда</label>
                                        </div>
                                        <div class="left__check">
                                            <input value="1" name="withpod" id="withpod" type="checkbox"
                                                   checked="checked"
                                                   class="js-checkbox">
                                            <label for="withpod">С подрядом</label>
                                        </div>
                                        <div class="left__check">
                                            <input value="2" name="withhouse" id="withhouse" type="checkbox"
                                                   checked="checked"
                                                   class="js-checkbox">
                                            <label for="withhouse">Участок с домом</label>
                                        </div>
                                    </div>
                                    <div class="form__right">
                                        <div class="right__block">
                                            <div class="form__title">Цена, руб.</div>
                                            <div class="form__desc">
                                                от <span class="js-price-from"></span>
                                                до <span class="js-price-to"></span>
                                            </div>
                                            <div class="form__slider">
                                                <div id="range-price"></div>
                                                <input name="pricefrom" type="hidden">
                                                <input name="priceto" type="hidden">
                                            </div>
                                        </div>
                                        <div class="right__block">
                                            <div class="form__title">Площадь, сот.</div>
                                            <div class="form__desc">
                                                от <span class="js-area-from"></span>
                                                до <span class="js-area-to"></span></div>
                                            <div class="form__slider">
                                                <div id="range-area"></div>
                                                <input name="areafrom" type="hidden">
                                                <input name="areato" type="hidden">
                                            </div>
                                        </div>
                                        <div class="right__btn">
                                            <button type="submit" class="us-btn btn-green"><span>Подбор</span></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="filter__list js-filter-list">
                        <div class="list__table">
                            <ul class="table__head">
                                <li class="body__item">
                                    <div class="wrapper">
                                        <span>Участок</span><span>Очередь</span><span>Площадь, сот.</span><span>Статус</span><span>Цена, руб.</span>
                                    </div>
                                </li>
                            </ul>
                            <ul class="table__body">
                                <li class="body__item">
                                    <div class="wrapper"><span>243</span><span>2</span><span>29,6</span><span>Без подряда</span><span>2 944 000</span>
                                    </div>
                                </li>
                                <li class="body__item">
                                    <div class="wrapper"><span>243</span><span>2</span><span>29,6</span><span>Без подряда</span><span>2 944 000</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
@section('scripts')
    <script>
        Dictionary = window.Dictionary || {};
        Dictionary.buildings = {
            @if($lands->count())
                @foreach($lands as $land)
                    "{{ $land->id }}": {
                id: {{ $land->id }},
                number: {{ $land->number }},
                land_area: {{ $land->area }},
                price: {{ $land->price }},
                coordinate_x: {{ $land->coordinate_x }},
                coordinate_y: {{ $land->coordinate_y }},
                sold: {{ $land->sold }},
                status: {{ $land->status }},
                turn: {{ $land->turn }}


            },
            @endforeach
        @endif


        };
    </script>
@stop