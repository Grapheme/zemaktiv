<?
/**
 * TITLE: Коммуникации
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
if ($communications = Dictionary::valuesBySlug('communications_units', NULL, 'all', TRUE)):
    foreach ($communications as $index => $communication):
        if ($communication['photo']):
            $communications[$index]['photo_name'] = Photo::where('id', $communication['photo'])->pluck('name');
        endif;
    endforeach;
endif;
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
                    @include(Helper::layout('about-menu'),array('hidden'=>'communications'))
                </div>
            </div>
            <div class="page__left no-border">
                <div class="us-article">
                    {{ $page->block('content') }}
                </div>
                <div class="download-block">
                    <div class="block__item">
                        {{ $page->block('get_plan') }}
                    </div>
                    <div class="block__item">
                        {{ $page->block('show_certificate') }}
                    </div>
                </div>
            </div>
            <div class="page__right no-border">
                @if(count($communications))
                    @foreach($communications as $communication)
                        <div class="benefits__item">
                            <div class="item__image"
                                 style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$communication['photo_name']) }});"></div>
                            <div class="item__title">{{ $communication['name'] }}</div>
                            <div class="item__desc">
                                {{ $communication['anonce'] }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop