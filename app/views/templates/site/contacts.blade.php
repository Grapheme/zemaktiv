<?
/**
 * TITLE: Контакты
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="half-page">
        <div class="wrapper">
            <div class="page-full">
                <div class="tabs-title">
                    <h1 class="us-title title-yellow"><span>{{ $page->seo->h1 }}</span></h1>
                    @include(Helper::layout('about-menu'),array('hidden'=>'contacts'))
                </div>
                <div class="right__contacts full-contacts">
                    <!-- <h2>Контакты</h2> -->
                    <?php
                    $contacts = array();
                    if (isset($page->blocks['contacts']['meta']['content']) && !empty($page->blocks['contacts']['meta']['content'])):
                        $contacts = json_decode($page->blocks['contacts']['meta']['content'], TRUE);
                    endif;
                    ?>
                    <div class="contacts__office">
                        {{ @$contacts['office'] }}
                    </div>
                    <div class="contacts__block">
                        <span class="block__left">Отдел продаж:</span>
                        <span class="block__right">{{ @$contacts['otdel'] }}</span>
                    </div>
                    <div class="contacts__block">
                        <span class="block__left">E-mail:</span>
                        <span class="block__right"><a
                                    href="mailto:{{ @$contacts['email'] }}">{{ @$contacts['email'] }}</a></span>
                    </div>
                    <div class="contacts__block">
                        <span class="block__left">Часы работы:</span>
                        <span class="block__right">{{ @$contacts['times'] }}</span>
                    </div>
                    <div class="contacts__block">
                        <span class="block__left">Адрес:</span>
                        <span class="block__right">{{ @$contacts['address'] }}</span>
                    </div>
                    <div id="contact-map"></div>
                    <div class="right__form full-form">
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
    </div>
@stop
@section('scripts')
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@stop