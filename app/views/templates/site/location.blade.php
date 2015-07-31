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
    <main class="main js-main">
        <div class="half-page infra-page">
            <div id="infra-map" class="infra-map"></div>
            <div class="wrapper">
                <div class="page__left">
                    <div class="tabs-title">
                        <h1 class="us-title title-red"><span>{{ $page->seo->h1 }}</span></h1>
                        <a href="{{ pageurl('') }}" class="title__link">Инфраструктура</a>
                    </div>
                    <h2>Симферопольское шоссе, 70 км от МКАД</h2>

                    <div class="way-container">
                        <div class="way-list">
                            <div class="list__item">
                                <div class="item__image image-bus"></div>
                                <div class="item__desc">На транспорте</div>
                            </div>
                            <div class="list__item">
                                <div class="item__image image-car"></div>
                                <div class="item__desc">На авто</div>
                            </div>
                        </div>
                        <div class="us-article">
                            <p>Ехать прямо по Симферопольскому шоссе, на 70-м километребудет соответствующий указатель
                                и баннер «Вяземских садов», свернутьна указателе и ехать 3 км</p>
                        </div>
                        <div class="way-btns"><a href="#"
                                                 class="us-btn btn-white"><span>Через Вяземское шоссе</span></a><a
                                    href="#" class="us-btn btn-white"><span>Через Дмитровское шоссе</span></a></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="overlay js-overlay">
            <div data-name="book" class="overlay__block block-book js-overlay-block">
                <div class="wrapper"><a href="#" class="block__close js-close-overlay"></a>

                    <div class="block-cont">
                        <div class="book__title"><span>Участок №250, вторая очередь, 13,95 соток</span></div>
                        <div class="overlay__form">
                            <input type="hidden" name="id">

                            <div class="form__block block-phone">
                                <div class="block__title">Ваш номер телефона</div>
                                <div class="block__input">
                                    <div class="phone__number">+7</div>
                                    <input type="text" name="phone" class="input__item">
                                </div>
                            </div>
                            <div class="form__block">
                                <div class="block__title">Имя</div>
                                <div class="block__input">
                                    <input type="text" name="name" class="input__item">
                                </div>
                            </div>
                            <div class="form__block">
                                <div class="block__title">Почта</div>
                                <div class="block__input">
                                    <input type="text" name="email" class="input__item">
                                </div>
                            </div>
                            <div class="form__btn">
                                <button type="submit" class="us-btn btn-transparent"><span>Забронировать</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-name="call" class="overlay__block block-call js-overlay-block">
                <div class="wrapper"><a href="#" class="block__close js-close-overlay"></a>

                    <div class="block-cont">
                        <div class="overlay__form">
                            <div class="form__block block-phone">
                                <div class="block__title">Ваш номер телефона</div>
                                <div class="block__input">
                                    <div class="phone__number">+7</div>
                                    <input type="text" name="phone" class="input__item">
                                </div>
                            </div>
                            <div class="form__btn">
                                <button type="submit" class="us-btn btn-transparent"><span>Обратный звонок</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
@section('scripts')
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@stop