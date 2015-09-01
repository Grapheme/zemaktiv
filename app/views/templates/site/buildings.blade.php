<?
/**
 * TITLE: Готовые дома
 * AVAILABLE_ONLY_IN_ADVANCED_MODE
 */
?>
<?php
$buildings = Buildings::orderBy('number', 'ASC')->with('land', 'photo', 'gallery.photos')->paginate(5);
$lands = Land::all();
?>
@extends(Helper::layout())
@section('style')
@stop
@section('content')
    <div class="us-page">
        <div class="wrapper">
            <h1 class="us-title title-green"><span>{{ $page->seo->h1 }}</span></h1>
            <div class="us-desc">
                Воспользуйтесь фильтрами для поиска подходящего варианта. На этой странице – готовые дома и некоторые типовые проекты наших партнеров.
            </div>
            <div class="build-filter">
                <div class="filter__block">
                    <div class="block__title">Я хочу</div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Уже готовый дом</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Построить дом</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Все варианты</label>
                    </div>
                </div>
                <div class="filter__block">
                    <div class="block__title">Технология</div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Каркасные дома</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Газобетонные блоки</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Оцилиндрованное дерево</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Все технологии</label>
                    </div>
                </div>
                <div class="filter__block">
                    <div class="block__title">Площадь дома, кв. м</div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">до 150</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">151-180</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">от 181</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">Любая площадь</label>
                    </div>
                </div>
                <div class="filter__block">
                    <div class="block__title">Цена, руб.</div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">до 2 млн</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">от 2 до 2,5 млн</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">от 2,5 до 3,5 млн</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">от 3,5 млн</label>
                    </div>
                    <div class="block__check">
                        <input value="0" name="" type="checkbox" class="js-checkbox js-set-for">
                        <label class="js-set-for">не имеет значения</label>
                    </div>
                </div>
                <div class="clearfix"></div>
                <a href="#" class="filter__update"></a>
            </div>
        </div>
        @if($buildings->count())
            <div class="done">
                <div class="wrapper">
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
                            <div class="house__left">
                                <div style="{{ $hasImage ? 'background-image: url('.asset(Config::get('site.galleries_photo_public_dir').'/'.$build->photo->name).')' : '' }};"
                                     class="left__main-image">
                                     <a {{ $hasImage ? 'href="'.asset(Config::get('site.galleries_photo_public_dir').'/'.$build->photo->name).'"' : '' }} class="js-fancybox js-gallery-track" data-number="{{ $build->number }}" rel="gallery-{{ $build->id }}"></a>
                                </div>
                                @if($hasGallery)
                                    <div class="left__images">
                                        @foreach($build->gallery->photos as $photo)
                                            @if(File::exists(Config::get('site.galleries_photo_dir').'/'.$photo->name))
                                                <a href="{{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }}" class="images__item js-fancybox js-gallery-track" data-number="{{ $build->number }}" rel="gallery-{{ $build->id }}">
                                                    <span style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }});"
                                                          class="item__image"></span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="house__right">
                                <div class="right__title">{{ $build->title }},<br>участок №{{ $build->land->number }}</div>
                                <div class="right__info">
                                    <div class="info__block">
                                        <div class="block__left">Площадь:</div>
                                        <div class="block__right"><span>{{ number_format($build->area, 2, '.', ' ') }}
                                                кв.м</span></div>
                                    </div>
                                    <div class="info__block">
                                        <div class="block__left">Материал:</div>
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
                                        <div class="block__right"><span>{{ $build->land->number }}</span></div>
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
                                    <?php
                                        if(isset($_GET['page'])) {
                                            $backPage = $_GET['page'];
                                        } else {
                                            $backPage = 1;
                                        }
                                    ?>
                                    <a href="{{ pageurl('choice-land').'#id='.$build->land->id.'&backpage='.$backPage }}"
                                       class="us-btn btn-white"><span>Посмотреть на генплане</span></a>
                                    <a href="#" data-id="{{ $build->land->id }}" class="js-book us-btn btn-green"><span>Забронировать</span></a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="wrapper">
                {{ $buildings->links() }}
            </div>
        @endif
    </div>
@stop
@section('scripts')
    <script>
        Dictionary = window.Dictionary || {};
        Dictionary.buildings = {
            @if($lands->count())
                @foreach($lands as $land)
                    "{{ $land->id }}": {
                        id: {{ $land->id }},
                        number: "{{ $land->number }}",
                        land_area: {{ $land->area }},
                        price: {{ $land->price }},
                        price_total: {{ $land->price_house }},
                        coordinate_x: {{ $land->coordinate_x }},
                        coordinate_y: {{ $land->coordinate_y }},
                        sold: {{ $land->sold }},
                        status: {{ $land->status }},
                        turn: {{ $land->turn }}
                    },
                @endforeach
            @endif
        };
    </script>
@stop