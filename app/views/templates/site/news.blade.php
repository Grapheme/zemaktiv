<?
/**
 * TITLE: Новости
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
$news_list = News::with('meta.seo', 'meta.photo', 'meta.gallery.photos')->orderBy('published_at', 'DESC')->paginate(10);
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="half-page">
        <div class="wrapper">
            <div class="page-full">
                <div class="tabs-title many-tabs">
                    <h1 class="us-title title-yellow"><span>{{ $page->seo->h1 }}</span></h1>
                    <div class="tabs-right">
                        <div class="right-cont">
                            <a href="{{ pageurl('about-company') }}" class="title__link">О компании</a>
                            <a href="{{ pageurl('documents') }}" class="title__link">Документы</a>
                            <a href="{{ pageurl('about') }}" class="title__link">О проекте</a>
                        </div>
                    </div>
                </div>
                <div class="us-news">
                    <ul class="news__list martop40">
                        @foreach($news_list as $news)
                            <li class="list__item">
                                <div class="item__date">{{ (new myDateTime())->setDateString($news->published_at)->format('d/m/y') }}</div>
                                <div class="item__link">
                                    {{ $news->meta->title }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{ $news_list->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop