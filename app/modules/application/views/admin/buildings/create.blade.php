@extends(Helper::acclayout())
@section('style')
@stop
@section('content')
    @include($module['tpl'].'buildings.menu')
    {{ Form::open(array('route'=>'buildings.store','class'=>'smart-form','id'=>'buildings-form','role'=>'form','method'=>'post')) }}
    {{ Form::hidden('number', (int) Buildings::orderBy('number','DESC')->pluck('number') + 1) }}
    {{ Form::hidden('description') }}
    {{ Form::hidden('land_area') }}
    <div class="row">
        <section class="col col-6">
            <div class="well">
                <header>Добавление дома:</header>
                <fieldset>
                    <section>
                        <label class="label">Название</label>
                        <label class="input">
                            {{ Form::text('title') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Площадь (кв.м)</label>
                        <label class="input">
                            {{ Form::text('area') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Материалы</label>
                        <label class="select">
                            {{ Form::select('material', LayoutHomesController::$materials) }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Коммуникации</label>
                        <label class="input">
                            {{ Form::text('communication') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Цена с участком (руб.)</label>
                        <label class="input">
                            {{ Form::text('price') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Номер участка</label>
                        <label class="select">
                            {{ Form::select('land_id', Land::orderByRaw('number + 0')->lists('number','id')) }}
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
        var essence = 'buildings';
        var essence_name = 'дом';
        var validation_rules = {
            title: {required: true, maxlength: 100},
            number: {required: true, maxlength: 100},
            price: {required: true, maxlength: 100},
        };
        var validation_messages = {
            title: {required: "Укажите название"},
            number: {required: "Укажите номер"},
            price: {required: "Укажите цену"},
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