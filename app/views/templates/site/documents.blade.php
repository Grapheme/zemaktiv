<?
/**
 * TITLE: Документы
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="half-page">
        <div class="wrapper">
            <div class="page__left">
                <div class="tabs-title">
                    <h1 class="us-title title-yellow"><span>{{ $page->seo->h1 }}</span></h1>
                    <a href="{{ pageurl('about-company') }}" class="title__link">О компании</a>
                    <a href="{{ pageurl('about') }}" class="title__link">О проекте</a>
                    <a href="{{ pageurl('news') }}" class="title__link">Новости</a>
                </div>
                <div class="us-article">
                    {{ $page->block('content') }}
                </div>
            </div>
            <div class="page__right">
                <div class="right__form">
                    <h2>Обратная связь</h2>
                    {{ Form::open(array('route'=>'contact_feedback','class'=>'js-contact-form')) }}
                    <div class="form__input">
                        <input name="name" placeholder="Имя">
                    </div>
                    <div class="form__input">
                        <input name="email" placeholder="E-mail">
                    </div>
                    <div class="form__input">
                        <textarea name="message" placeholder="Вопрос" class="js-autosize"></textarea>
                    </div>
                    <div class="form__input">
                        <button type="submit" class="us-btn btn-green"><span>Отправить</span></button>
                    </div>
                    <div style="display: none;" class="form__input js-response-text"></div>
                    {{ Form::close() }}
                    <div style="display: none;" class="js-contact-success">
                        <div class="form__input">Ваше сообщение успешно отправлено!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@stop