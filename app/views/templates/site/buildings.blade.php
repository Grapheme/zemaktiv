<?
/**
 * TITLE: Готовые дома
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
$buildings = Buildings::orderBy('number', 'ASC')->with('land', 'photo', 'gallery.photos')->paginate(5);
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="us-page">
        <div class="wrapper">
            <h1 class="us-title title-green"><span>{{ $page->seo->h1 }}</span></h1>
        </div>
        @if($buildings->count())
            <div class="done">
                @foreach($buildings as $build)
                    <?php
                    $hasImage = $hasGallery = FALSE;
                    if (!empty($build->photo) && File::exists(Config::get('site.galleries_photo_dir') . '/' . $build->photo->name)):
                        $hasImage = TRUE;
                    endif;
                    if (isset($build->gallery->photos) && !empty($build->gallery->photos)):
                        $hasGallery = TRUE;
                    endif;
                    ?>
                    <div class="done__house">
                        <div class="wrapper">
                            <div class="house__left">
                                <div style="{{ $hasImage ? 'background-image: url('.asset(Config::get('site.galleries_photo_public_dir').'/'.$build->photo->name).')' : '' }};"
                                     class="left__main-image"></div>
                                @if($hasGallery)
                                    <div class="left__images">
                                        @foreach($build->gallery->photos as $photo)
                                            @if(File::exists(Config::get('site.galleries_photo_dir').'/'.$photo->name))
                                                <a href="#" class="images__item">
                                                    <span style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }});"
                                                          class="item__image"></span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="house__right">
                                <div class="right__title">{{ $build->title }},<br>участок №{{ $build->number }}</div>
                                <div class="right__info">
                                    <div class="info__block">
                                        <div class="block__left">Площадь:</div>
                                        <div class="block__right"><span>{{ number_format($build->area, 2, '.', ' ') }}
                                                кв.м</span></div>
                                    </div>
                                    <div class="info__block">
                                        <div class="block__left">Метериал:</div>
                                        <div class="block__right"><span>{{ $build->material }}</span></div>
                                    </div>
                                    <div class="info__block">
                                        <div class="block__left">Площадь участка:</div>
                                        <div class="block__right">
                                            <span>{{ $build->land_area }} {{ Lang::choice('сотка|сотки|соток', $build->land_area) }}</span>
                                        </div>
                                    </div>
                                    <div class="info__block">
                                        <div class="block__left">Номер участка:</div>
                                        <div class="block__right"><span>{{ $build->number }}</span></div>
                                    </div>
                                    <div class="info__block">
                                        <div class="block__left">Коммуникации:</div>
                                        <div class="block__right"><span>{{ $build->communication }}</span></div>
                                    </div>
                                    <div class="info__block">
                                        <div class="block__left">Цена с участком:</div>
                                        <div class="block__right"><span>{{ number_format($build->price, 2, '.', ' ') }}
                                                руб</span></div>
                                    </div>
                                </div>
                                <div class="right__btns">
                                    <a href="{{ pageurl('gen-plan').'#'.$build->land->id }}"
                                       class="us-btn btn-white"><span>Посмотреть на генплане</span></a>
                                    <a href="#" class="us-btn btn-green"><span>Забронировать</span></a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="wrapper">
                {{ $buildings->links() }}
            </div>
        @endif
    </div>
@stop
@section('scripts')
@stop