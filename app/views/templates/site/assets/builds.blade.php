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
        <div class="house__title">{{ $build->title }},<br>участок №{{ !empty($build->land)? $build->land->number : '' }}
        </div>
        <div class="house__left">
            <div class="left__main-image">
                <a style="{{ $hasImage ? 'background-image: url('.asset(Config::get('site.galleries_photo_public_dir').'/'.$build->photo->name).')' : '' }};"
                   {{ $hasImage ? 'href="'.asset(Config::get('site.galleries_photo_public_dir').'/'.$build->photo->name).'"' : '' }} class="js-fancybox js-gallery-track"
                   data-number="{{ $build->number }}" rel="gallery-{{ $build->id }}"></a>
            </div>
            @if($hasGallery)
                <div class="left__images">
                    @foreach($build->gallery->photos as $photo)
                        @if(File::exists(Config::get('site.galleries_photo_dir').'/'.$photo->name))
                            <a href="{{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }}"
                               class="images__item js-fancybox js-gallery-track"
                               data-number="{{ $build->number }}"
                               rel="gallery-{{ $build->id }}">
                                <span style="background-image: url({{ asset(Config::get('site.galleries_photo_public_dir').'/'.$photo->name) }});"
                                      class="item__image"></span>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="house__right">
            <div class="right__info">
                @if(isset($build->contractor_title))
                    <div class="info__block">
                        <div class="block__left">Подрядчик:</div>
                        <div class="block__right">
                            <a href="{{ $build->contractor_link }}"
                               class="right__link">{{ $build->contractor_title }}</a>
                        </div>
                    </div>
                @endif
                <div class="info__block">
                    <div class="block__left">Площадь:</div>
                    <div class="block__right">
                        <span>{{ number_format($build->area, 2, '.', ' ') }} кв.м</span>
                    </div>
                </div>
                <div class="info__block">
                    <div class="block__left">Материал:</div>
                    <div class="block__right"><span>{{ $build->material }}</span></div>
                </div>
                @if(!empty($build->land))
                <div class="info__block">
                    <div class="block__left">Площадь участка:</div>
                    <div class="block__right">
                        <span>{{ $build->land->area }} {{ Lang::choice('сотка|сотки|соток', $build->land->area) }}</span>
                    </div>
                </div>
                <div class="info__block">
                    <div class="block__left">Номер участка:</div>
                    <div class="block__right">
                        <span>{{ $build->land->number }}</span>
                        <a href="{{ pageurl('choice-land').'#id='.$build->land->id }}"
                           class="js-gen-link">Смотреть на генплане</a>
                    </div>
                </div>
                @endif
                @if(isset($build->communication))
                <div class="info__block">
                    <div class="block__left">Коммуникации:</div>
                    <div class="block__right"><span>{{ $build->communication }}</span></div>
                </div>
                @endif
                <div class="info__block">
                    <div class="block__left">Цена с участком:</div>
                    <div class="block__right">
                        <span>{{ number_format($build->price, 2, '.', ' ') }} руб</span>
                    </div>
                </div>
            </div>
            @if(!empty($build->land))
                <div class="right__btns">
                    <a href="#" data-id="{{ $build->land->id }}" class="js-book us-btn btn-green"><span>Узнать больше</span></a>
                </div>
            @else
                <div class="right__btns">
                    <a href="#" data-id="0" class="js-book us-btn btn-green"><span>Узнать больше</span></a>
                </div>
            @endif
        </div>
        <div class="clearfix"></div>
    </div>
@endforeach