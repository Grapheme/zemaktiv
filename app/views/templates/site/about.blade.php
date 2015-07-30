<?
/**
 * TITLE: О проекте
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <main class="main js-main">
        <div class="half-page">
            <div class="wrapper">
                <div class="page__left">
                    <div class="tabs-title">
                        <h1 class="us-title title-yellow"><span>{{ $page->seo->h1 }}</span></h1>
                        <a href="{{ pageurl('about-company') }}" class="title__link">О компании</a>
                        <a href="{{ pageurl('documents') }}" class="title__link">Документы</a>
                        <a href="{{ pageurl('news') }}" class="title__link">Новости</a>
                    </div>
                    <div class="us-article">
                        {{ $page->block('content') }}
                    </div>
                    <div class="us-news">
                        <h2>Новости</h2>
                        <ul class="news__list">
                        @foreach(News::with('meta')->take(4)->orderBy('published_at','DESC')->get() as $news)
                            <li class="list__item">
                                <div class="item__date">{{ (new myDateTime())->setDateString($news->published_at)->format('d/m/y') }}</div>
                                <div class="item__link">
                                    {{ $news->meta->title }}
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="page__right">
                    <div class="right__contacts">
                        <h2>Контакты</h2>
                        <?php
                            $contacts = array();
                            if(isset($page->blocks['contacts']['meta']['content']) && !empty($page->blocks['contacts']['meta']['content'])):
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
                            <span class="block__right"><a href="mailto:{{ @$contacts['email'] }}">{{ @$contacts['email'] }}</a></span>
                        </div>
                        <div class="contacts__block">
                            <span class="block__left">Часы работы:</span>
                            <span class="block__right">{{ @$contacts['times'] }}</span>
                        </div>
                        <div class="contacts__block">
                            <span class="block__left">Адрес:</span>
                            <span class="block__right">{{ @$contacts['address'] }}</span>
                        </div>
                    </div>
                    <div id="contact-map"></div>
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
    </main>
@stop
@section('scripts')
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
@stop