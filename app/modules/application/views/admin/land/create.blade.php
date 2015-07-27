@extends(Helper::acclayout())
@section('style')
    <style type="text/css">
        .map-container {
            overflow: auto;
            z-index: 1;
        }

        .map-container .container_12 {
            position: relative;
            height: 663px;
        }

        .map-container .map-block {
            position: relative;
            margin: 0 auto;
            top: 2.5rem;
            /*width: 75rem;*/
            width: 4200px;
            /*height: 36.4375rem;*/
            height: 2625px;
            background: url('{{ Config::get('site.theme_path') }}/images/map.jpg') no-repeat center center;
            background-size: 4200px 2625px;
            -webkit-transition: all 1s ease;
            transition: all 1s ease;

            background-color: #fff;
        }

        .map-container .map-dot {
            position: absolute;
            display: inline-block;
            width: 10px;
            height: 10px;
            margin-left: -0.34375rem;
            margin-top: -0.34375rem;
            border-radius: 0.6875rem;
            background: #1dcba4;
        }

        .map-container .map-dot .map-rad {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            background: #b1b1b1;
            opacity: .2;
        }

        .map-container .map-dot:hover .map-rad,
        .map-container .map-dot.active .map-rad {
            background: #1dcba4;
        }

        .map-container .map-dot:hover .map-rad {
            -webkit-transition: all .75s ease;
            transition: all .75s ease;
            -webkit-animation: mappulse .75s infinite;
            animation: mappulse .75s infinite;
        }

        .map-container .map-desc {
            position: absolute;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: #fff;
            padding: 2.5rem 1.875rem 2.5rem 3.75rem;
        }

        .map-container .map-desc .desc-icon {
            margin-right: 1.25rem;
        }

        .map-container .map-desc .desc-icon:last-child {
            margin: 0;
        }

        .map-container .map-desc .title {
            text-transform: uppercase;
            font-size: 1.25em;
            margin-top: 2.1875rem;
        }

        .map-container .map-desc .map-items {
            margin: 0;
            padding: 0;
            list-style: none;
            margin-top: 2.1875rem;
            height: 70%;
        }

        .map-container .map-desc .map-items li {
            margin-bottom: 0.625rem;
            padding-right: 3.125rem;
            color: #7f8281;
        }

        .map-container .map-desc .sol-dots {
            position: absolute;
            bottom: 2.5rem;
        }

    </style>
@stop
@section('content')
    @include($module['tpl'].'.land.menu')
    {{ Form::open(array('route'=>'land.store','class'=>'smart-form','id'=>'land-form','role'=>'form','method'=>'post')) }}
    <div class="row">
        <section class="col col-6">
            <div class="well">
                <header>Добавление участка:</header>
                <fieldset>
                    <section>
                        <label class="label">Номер</label>
                        <label class="input">
                            {{ Form::text('number') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Очередь</label>
                        <label class="input">
                            {{ Form::text('turn') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Площадь (кв.км)</label>
                        <label class="input">
                            {{ Form::text('area') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Статус</label>
                        <label class="select">
                            {{ Form::select('status', Config::get('site.land_statuses')) }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Цена (руб.)</label>
                        <label class="input">
                            {{ Form::text('price') }}
                        </label>
                    </section>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <section class="map-container js-admin-map">
                            <div class="container_12">
                                <div class="map-block js-map-block">
                                </div>
                                <button type="button" class="btn btn-default" data-dismiss="modal" style="position:fixed; top:10px; left:10px;">
                                    Закрыть
                                </button>
                            </div>
                        </section>
                    </div>
                    <section>
                        <label class="label">Координата X</label>
                        <label class="input">
                            {{ Form::text('coordinate_x', NULL, array('class'=>'js-admin-map-x')) }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Координата Y</label>
                        <label class="input">
                            {{ Form::text('coordinate_y', NULL, array('class'=>'js-admin-map-y')) }}
                        </label>
                    </section>
                    <section>
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                            Показать карту
                        </button>
                    </section>
                    <section>
                        <label class="label">Главное изображение</label>
                        <label class="input">
                            {{ ExtForm::image('photo_id') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Галерея</label>
                        <label class="input">
                            {{ ExtForm::gallery('gallery') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Описание</label>
                        <label class="input">
                            {{ Form::text('description') }}
                        </label>
                    </section>
                </fieldset>
                <footer>
                    <a class="btn btn-default no-margin regular-10 uppercase pull-left btn-spinner"
                       href="{{URL::previous()}}">
                        <i class="fa fa-arrow-left hidden"></i> <span class="btn-response-text">Назад</span>
                    </a>
                    <button autocomplete="off" class="btn btn-success no-margin regular-10 uppercase btn-form-submit">
                        <i class="fa fa-spinner fa-spin hidden"></i> <span class="btn-response-text">Сохранить</span>
                    </button>
                </footer>
            </div>
        </section>
    </div>
    {{ Form::close() }}
@stop
@section('scripts')
    <script>
        var essence = 'land';
        var essence_name = 'участок';
        var validation_rules = {
            turn: {required: true, maxlength: 100},
            number: {required: true, maxlength: 100},
            price: {required: true, maxlength: 100},
            coordinate_x: { required: true, min: 0, max: 4200 },
            coordinate_y: { required: true, min: 0, max: 2625 }
        };
        var validation_messages = {
            turn: {required: "Укажите очередь"},
            number: {required: "Укажите номер"},
            price: {required: "Укажите цену"},
            coordinate_x: {required: "Укажите координату X"},
            coordinate_y: {required: "Укажите координату Y"}
        };
    </script>

    {{ HTML::script('private/js/modules/standard.js') }}

    {{ HTML::script('private/js/vendor/redactor.min.js') }}
    {{ HTML::script('private/js/system/redactor-config.js') }}
    <script type="text/javascript">
        $.fn.smart_map = function (map_array) {
            $(this).each(function () {
                var parent = $(this),
                        map_block = parent.find('.js-map-block'),
                        map_desc = parent.find('.js-map-desc'),
                        active_id = false;

                if (parent.hasClass('js-admin-map')) {
                    $(document).on('click', '.js-map-dot', function () {
                        return false;
                    });

                    $(document).on('click', '.js-map-block', function (e) {
                        admin_click(e);
                    });

                    $(document).on('input', '.js-admin-map-x, .js-admin-map-y', function () {
                        admin_pos();
                    });

                    $(document).on('change', '.js-admin-map-radius', function () {
                        admin_rad();
                    });

                } else {
                    $(document).on('click', '.js-map-dot', function () {
                        var id = $(this).attr('data-id');
                        openDesc(id);

                        return false;
                    });

                    $(document).on('click', '.js-desc-close', function () {
                        closeDesc();
                        return false;
                    });

                    $(document).on('click', '.js-map-control', function () {
                        goDesc($(this).attr('data-direction'));
                        return false;
                    });
                }

                function admin_click(e) {
                    var x = e.pageX - map_block.offset().left;
                    var y = e.pageY - map_block.offset().top;
                    if (parent.find('.js-admin-dot').length) {
                        parent.find('.js-admin-dot').css({
                            'left': x,
                            'top': y
                        });
                    } else {
                        var dot_default = {
                            radius: $('.js-admin-map-radius').val(),
                            posY: y,
                            posX: x
                        };

                        var str = dotStr(0, dot_default, true);
                        parent.find('.js-map-block').append(str);
                    }

                    $('.js-admin-map-x').val(Math.round(x));
                    $('.js-admin-map-y').val(Math.round(y));
                }

                function admin_pos() {
                    var x = parseInt($('.js-admin-map-x').val());
                    var y = parseInt($('.js-admin-map-y').val());

                    parent.find('.js-admin-dot').css({
                        'left': x,
                        'top': y
                    });
                }

                function admin_rad() {
                    var x = parseInt($('.js-admin-map-x').val());
                    var y = parseInt($('.js-admin-map-y').val());
                    var radius = parseInt($('.js-admin-map-radius').val());

                    parent.find('.js-admin-dot').remove();
                    var dot_settings = {
                        radius: parseInt($('.js-admin-map-radius').val()),
                        posY: y,
                        posX: x
                    };

                    var str = dotStr(0, dot_settings, true);
                    parent.find('.js-map-block').append(str);
                }

                function goDesc(d) {
                    var dir;
                    if (d == '<') {
                        dir = -1;
                    } else {
                        dir = 1;
                    }

                    var new_id = active_id + dir;

                    if (new_id == -1) {
                        new_id = map_array.length - 1;
                    }
                    if (new_id == map_array.length) {
                        new_id = 0;
                    }

                    openDesc(new_id);
                }

                function openDesc(id) {
                    var id_array = map_array[id];
                    var items = id_array.items;
                    var city = id_array.name;
                    var posX = id_array.posX;
                    var posY = id_array.posY;

                    var items_str = '';
                    $.each(items, function (index, value) {
                        items_str += '<li>' + value;
                    });
                    map_desc.find('.js-desc-title').text(city);
                    map_desc.find('.js-desc-items').html(items_str);
                    setTimeout(function () {
                        map_desc.find('.js-desc-items').customScrollbar();
                    }, 1);

                    var map_block_x = map_block.width() / 4 - posX;
                    var map_block_y = map_block.height() / 2 - posY;
                    var transform_str = transform('translateX(' + map_block_x + 'px) translateY(' + map_block_y + 'px)');

                    map_block.attr('style', transform_str);

                    $('.js-map-dot[data-id=' + id + ']').addClass('active')
                            .siblings().removeClass('active');

                    map_desc.show();
                    active_id = parseInt(id);
                }

                function closeDesc() {
                    map_block.attr('style', transform('translateX(0px) translateY(0px)'));
                    $('.js-map-dot').removeClass('active');
                    map_desc.hide();
                }

                function dotStr(index, value, admin_dot) {
                    var rad_width = value.radius * 11;
                    var style_str = 'margin-top: -' + rad_width / 2 + 'px; ' +
                            'margin-left: -' + rad_width / 2 + 'px; ' +
                            'width: ' + rad_width + 'px; ' +
                            'height: ' + rad_width + 'px; ' +
                            'border-radius: ' + rad_width + 'px; ';
                    if (admin_dot) {
                        var admin_class = ' js-admin-dot';
                    } else {
                        var admin_class = '';
                    }

                    var str = '<a href="#" class="map-dot js-map-dot' + admin_class + '" style="top: ' + value.posY + 'px; left: ' + value.posX + 'px;" data-id="' + index + '">' +
                            '<i class="map-rad" style="' + style_str + '"></i>' +
                            '</a>';

                    return str;
                }

                function init(x, y, r) {
                    var map_html = '';

                    //if (typeof map_array != 'undefined' && map_array.length)
                    //    mar_array = [{posX: x, posY: y, radius: r}]

                    $.each(map_array, function (index, value) {
                        var str = dotStr(index, value, true);
                        map_html += str;
                    });

                    map_block.html(map_html);
                    map_desc.hide();

                    if ($(window).width() <= 768) {
                        openDesc(0);
                    }
                }

                init();
            });
        }
        $('.js-admin-map').smart_map([{
            posX: 200, posY: 200, radius: 8
        }]);
    </script>
    <script type="text/javascript">
        if (typeof pageSetUp === 'function') {
            pageSetUp();
        }
        if (typeof runFormValidation === 'function') {
            loadScript("{{ asset('private/js/vendor/jquery-form.min.js'); }}", runFormValidation);
        } else {
            loadScript("{{ asset('private/js/vendor/jquery-form.min.js'); }}");
        }
    </script>
@stop