@extends(Helper::acclayout())
@section('style')
    {{ HTML::style(Config::get('site.theme_path').'/styles/map.css') }}
@stop
@section('content')
    @include($module['tpl'].'land.menu')
    {{ Form::open(array('route'=>'land.store','class'=>'smart-form','id'=>'land-form','role'=>'form','method'=>'post')) }}
    {{ Form::hidden('description') }}
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
                        <label class="label">Площадь (сотка)</label>
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
                        <label class="label">Цена участка (руб.)</label>
                        <label class="input">
                            {{ Form::text('price') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Цена участка c домом (руб.)</label>
                        <label class="input">
                            {{ Form::text('price_house') }}
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
                        <label class="">
                            {{ Form::checkbox('sold', 1) }} Участок продан
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
    {{ HTML::script(Config::get('site.theme_path').'/scripts/map.js') }}
    <script type="text/javascript">
        $('.js-admin-map').smart_map([{
            posX: 200, posY: 200, radius: 1
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