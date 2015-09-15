<?
/**
 * TITLE: Выбор участка
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
$lands = Land::orderByRaw('number + 0')->with('recommended.recommended_land')->get();
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="wrapper-choise js-choise-wrapper">
        <div class="js-choise-map choise-map">
            <div class="wrapper relative">
                <div class="wrapper-photos js-map-title">
                    <h1 class="us-title title-choise page-full"><span>{{ $page->seo->h1 }}</span></h1>

                    <div class="lines-choice">
                        <a href="#" data-number="1" class="choice__left js-choice-left"></a>
                        <a data-number="2" class="choice__center js-choice-center"></a>
                        <a href="#" data-number="3" class="choice__right js-choice-right"></a>
                    </div>
                </div>
                <div class="wrapper-params">
                    <a href="#" class="us-btn btn-black-white js-show-filter" style="display: none;">
                        <span>Участки списком</span>
                    </a>
                    <a href="{{ URL::to('/buildings') }}" class="us-btn btn-black-white js-back-to-buildings"
                       style="display: none;">
                        <span>Вернуться в список</span>
                    </a>
                    <!-- <a href="#" class="choise__toparams js-show-filter">
                        <span class="toparams__title">Подбор по параметрам</span>
                        <span class="toparams__desc">Цена и площадь</span>
                    </a> -->
                </div>
            </div>
            <div class="choise__map js-map-container">
                <div class="map__control">
                    <div class="control__link">
                        <a href="#" class="link__plus js-map-zoom"></a>
                    </div>
                    <div class="control__line"></div>
                    <div class="control__nav js-zoom-nav"></div>
                    <div class="control__line"></div>
                    <div class="control__nav js-zoom-nav active"></div>
                    <div class="control__line"></div>
                    <div class="control__nav js-zoom-nav"></div>
                    <div class="control__line"></div>
                    <div class="control__link">
                        <a href="#" class="link__minus js-map-zoomout"></a>
                    </div>
                </div>
                <div class="map__image js-map">
                    <div class="image__hint hint-1 js-hint-item"></div>
                    <div class="image__hint hint-2 js-hint-item"></div>
                    <div class="image__hint hint-3 js-hint-item"></div>
                    <div class="image__hint hint-4 js-hint-item"></div>
                    <div class="image__hint hint-5 js-hint-item"></div>
                    <div class="image__hint hint-6 js-hint-item"></div>
                    <div class="image__hint hint-7 js-hint-item"></div>
                    <div class="image__hint hint-8 js-hint-item"></div>
                    <div class="image__hint hint-9 js-hint-item"></div>
                    <div class="image__line line-1 js-line-1 js-line-item"></div>
                    <div class="image__line line-2 js-line-2 js-line-item"></div>
                    <div class="image__line line-3 js-line-3 js-line-item"></div>
                    <div class="image__tooltip js-tooltip">
                        <a href="#" class="tooltip__close js-close"></a>

                        <div class="tooltip__title"><a href="#" class="favorite-link js-favorite"></a>Участок №<span
                                    class="js-bnum"></span></div>
                        <div class="js-not-sold-block">
                            <div class="tooltip__subtitle">Очередь: <span class="js-bturn"></span></div>
                            <ul class="tooltip__list">
                                <li class="list__item"><span class="js-barea"></span> соток</li>
                                <li class="list__item"><span class="js-bcont"></span></li>
                                <li class="list__item"><span class="js-bprice"></span> руб.</li>
                            </ul>
                            <div class="tooltip__btn js-bbtn">
                                <a href="#" data-id class="js-book us-btn btn-white"
                                   onclick="carrotquest.track('TELLMEMORE');"><span>Забронировать</span></a>
                            </div>
                        </div>
                        <div class="js-sold-block tooltip-sold">
                            <div class="sold__status"><span class="status__icon"></span><span class="status__text">Продан</span>
                            </div>
                            <p>Этот участок уже нашел своего владельца</p>
                        </div>
                        <div class="js-recommend tooltip-recommend">
                            <p>Похожие участки</p>
                            <div class="js-recommend-list"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-choise-filter choise-filter">
                <div class="wrapper">
                    <div class="page-full relative">
                        <h1 class="us-title title-choise"><span>{{ $page->seo->h1 }}</span></h1>
                        <a href="#" class="choise__tomap us-btn btn-white js-show-map"><span>Выбрать на генплане</span></a>

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
                                        <label for="withhouse">С готовым домом</label>
                                    </div>
                                </div>
                                <div class="form__right">
                                    <div class="right__block">
                                        <div class="form__title">Цена участка, руб.</div>
                                        <div class="form__desc">
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="price1" name="priceto"
                                                       value="1000000">
                                                <label for="price1">До 1 млн</label>
                                            </div>
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="price2" name="priceto"
                                                       value="2000000">
                                                <label for="price2">До 2 млн</label>
                                            </div>
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="price3" name="priceto"
                                                       value="10000000" checked="checked">
                                                <label for="price3">Любая цена</label>
                                            </div>
                                            <!-- от <span class="js-price-from"></span>
                                            до <span class="js-price-to"></span> -->
                                        </div>
                                        <div class="form__slider">
                                            <!-- <div id="range-price"></div> -->
                                            <input name="pricefrom" type="hidden" value="0">
                                            <!-- <input name="priceto" type="hidden"> -->
                                        </div>
                                    </div>
                                    <div class="right__block">
                                        <div class="form__title">Площадь участка, соток</div>
                                        <div class="form__desc">
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="area1" name="range"
                                                       value="6-7.99">
                                                <label for="area1">От 6 до 7</label>
                                            </div>
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="area2" name="range"
                                                       value="8-9.99">
                                                <label for="area2">От 8 до 9</label>
                                            </div>
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="area3" name="range"
                                                       value="10-12.99">
                                                <label for="area3">От 10 до 12</label>
                                            </div>
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="area4" name="range"
                                                       value="13-17.99">
                                                <label for="area4">От 13 до 17</label>
                                            </div>
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="area5" name="range"
                                                       value="18-999">
                                                <label for="area5">От 18</label>
                                            </div>
                                            <div class="left__check">
                                                <input type="radio" class="js-radio" id="area6" name="range"
                                                       value="0-999" checked="checked">
                                                <label for="area6">Любая площадь</label>
                                            </div>
                                            <!-- от <span class="js-area-from"></span>
                                            до <span class="js-area-to"></span> -->
                                        </div>
                                        <div class="form__slider">
                                            <!-- <div id="range-area"></div> -->
                                            <!-- <input name="areafrom" type="hidden" value="0"> -->
                                            <!-- <input name="areato" type="hidden"> -->
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- <div class="right__btn">
                                        <button type="submit" class="us-btn btn-green"><span>Подбор</span></button>
                                    </div> -->
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="filter__list js-filter-list">
                    <div class="list__table js-favorite-cont favorite-cont">
                        <div class="wrapper">
                            <div class="table__title">Избранное</div>
                        </div>
                        <ul class="table__head">
                            <li class="body__item">
                                <div class="wrapper">
                                    <span>Участок</span><span>Очередь</span><span>Площадь, сот.</span><span>Статус</span><span>Цена участка, руб.</span><span>Цена участка с домом, руб.</span><span>На генплане</span>
                                </div>
                            </li>
                        </ul>
                        <ul class="table__body js-favorite-items"></ul>
                    </div>
                    <div class="list__table">
                        <div class="wrapper">
                            <div class="table__title">Участки</div>
                        </div>
                        <ul class="table__head js-static-head">
                            <li class="body__item">
                                <div class="wrapper">
                                    <span
                                        data-sort-name="number">Участок</span><span
                                        data-sort-name="turn">Очередь</span><span
                                        data-sort-name="land_area">Площадь, сот.</span><span
                                        data-sort-name="status">Статус</span><span
                                        data-sort="ASC" data-sort-name="price">Цена участка, руб.</span><span
                                        data-sort-name="price_total">Цена участка с домом, руб.</span><span
                                        >На генплане</span>
                                </div>
                            </li>
                        </ul>
                        <ul class="table__body js-filter-items"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="table__head head-fixed js-table-head">
        <li class="body__item">
            <div class="wrapper">
                <span
                    data-sort-name="number">Участок</span><span
                    data-sort-name="turn">Очередь</span><span
                    data-sort-name="land_area">Площадь, сот.</span><span
                    data-sort-name="status">Статус</span><span
                    data-sort="ASC" data-sort-name="price">Цена участка, руб.</span><span
                    data-sort-name="price_total">Цена участка с домом, руб.</span><span
                    >На генплане</span>
            </div>
        </li>
    </ul>
    <div style="position: fixed; top: -9999px; left: -9999px; visibility: hidden;">
        <img src="{{ Config::get('site.theme_path') }}/images/ui/line1block.svg" alt="">
        <img src="{{ Config::get('site.theme_path') }}/images/ui/line1left.svg" alt="">
        <img src="{{ Config::get('site.theme_path') }}/images/ui/line2block.svg" alt="">
        <img src="{{ Config::get('site.theme_path') }}/images/ui/line2left.svg" alt="">
        <img src="{{ Config::get('site.theme_path') }}/images/ui/line2right.svg" alt="">
        <img src="{{ Config::get('site.theme_path') }}/images/ui/line3block.svg" alt="">
        <img src="{{ Config::get('site.theme_path') }}/images/ui/line3right.svg" alt="">
    </div>
@stop
@section('scripts')
    <script>
        Dictionary = window.Dictionary || {};
        Dictionary.click_tracker_url = '{{ URL::route('click.tracker') }}';
        Dictionary.buildingsAll = {@if($lands->count()) @foreach($lands as $land){{ View::make(Helper::layout('assets.lands-js'),compact('land'))->render() }}@endforeach @endif};
        Dictionary.buildings = {@if($lands->count()) @foreach($lands as $land) @if($land->sold == 0){{ View::make(Helper::layout('assets.lands-js'),compact('land'))->render() }}@endif @endforeach @endif}
    </script>
@stop