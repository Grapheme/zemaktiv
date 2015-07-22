@extends(Helper::acclayout())
@section('style')
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
                    <section>
                        <label class="label">Координаты на плане</label>
                        <label class="input">
                            {{ Form::text('coordinates') }}
                        </label>
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
            coordinates: {required: true, maxlength: 100}
        };
        var validation_messages = {
            turn: {required: "Укажите очередь"},
            number: {required: "Укажите номер"},
            price: {required: "Укажите цену"},
            coordinates: {required: "Укажите координаты"}
        };
    </script>

    {{ HTML::script('private/js/modules/standard.js') }}

    {{ HTML::script('private/js/vendor/redactor.min.js') }}
    {{ HTML::script('private/js/system/redactor-config.js') }}
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