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
        <div class="page-full">
            <div class="wrapper">
                <div class="tabs-title many-tabs">
                    <h1 class="us-title title-yellow"><span>{{ $page->seo->h1 }}</span></h1>
                    @include(Helper::layout('about-menu'),array('hidden'=>'news'))
                </div>
            </div>
            <div class="us-news">
                <ul class="news__list martop40">
                    @foreach($news_list as $news)
                        <li class="list__item">
                            <div class="wrapper">
                                <div class="page__left">
                                    <h2 class="item__link">
                                        {{ $news->meta->title }}
                                    </h2>
                                    <div class="item__date">
                                        <span>{{ (new myDateTime())->setDateString($news->published_at)->format('d/m/y') }}</span>
                                    </div>
                                    <div class="item__content">
                                        {{ $news->meta->content }}
                                    </div>
                                </div>
                                <div class="page__right">
                                    <div class="news-images">
                                        <a class="images__item js-fancybox" href="theme/build/images/tmp/index-slider1.jpg" rel="gallery{{ $news->id }}">
                                            <span style="background-image: url('theme/build/images/tmp/index-slider1.jpg');"></span>
                                        </a>
                                        <a class="images__item js-fancybox" href="theme/build/images/tmp/index-slider1.jpg" rel="gallery{{ $news->id }}">
                                            <span style="background-image: url('theme/build/images/tmp/index-slider1.jpg');"></span>
                                        </a>
                                        <a class="images__item js-fancybox" href="theme/build/images/tmp/index-slider1.jpg" rel="gallery{{ $news->id }}">
                                            <span style="background-image: url('theme/build/images/tmp/index-slider1.jpg');"></span>
                                        </a>
                                        <a class="images__item js-fancybox" href="theme/build/images/tmp/index-slider1.jpg" rel="gallery{{ $news->id }}">
                                            <span style="background-image: url('theme/build/images/tmp/index-slider1.jpg');"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{  $news_list->links() }}
            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop