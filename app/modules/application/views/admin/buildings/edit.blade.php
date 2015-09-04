@extends(Helper::acclayout())
@section('style')
@stop
@section('content')
    @include($module['tpl'].'buildings.menu')
    {{ Form::model($build, array('route'=>array('buildings.update', $build->id),'class'=>'smart-form','id'=>'buildings-form','role'=>'form','method'=>'put')) }}
    {{ Form::hidden('number') }}
    {{ Form::hidden('sold') }}
    {{ Form::hidden('description') }}
    {{ Form::hidden('land_area') }}
    <div class="row">
        <section class="col col-6">
            <div class="well">
                <header>Редактирование дома:</header>
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
                            {{ Form::select('land_id', Land::lists('number','id')) }}
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
                            {{ ExtForm::gallery('gallery', is_object($build->gallery) ? $build->gallery->id : NULL) }}
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