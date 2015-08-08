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
                <div class="right__contacts">
                    <h2>Контакты</h2>
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
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop