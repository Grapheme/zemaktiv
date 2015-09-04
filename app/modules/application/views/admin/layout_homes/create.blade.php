@extends(Helper::acclayout())
@section('style')
@stop
@section('content')
    @include($module['tpl'].'layout_homes.menu')
    {{ Form::open(array('route'=>'layouts_homes.store','class'=>'smart-form','id'=>'buildings-form','role'=>'form','method'=>'post')) }}
    {{ Form::hidden('description') }}
    <div class="row">
        <section class="col col-6">
            <div class="well">
                <header>Добавление макета дома:</header>
                <fieldset>
                    <section>
                        <label class="label">Название</label>
                        <label class="input">
                            {{ Form::text('title') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Подрядчик</label>
                        <label class="input">
                            {{ Form::text('contractor_title') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Подрядчик (ссылка)</label>
                        <label class="input">
                            {{ Form::text('contractor_link') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Срок строительства</label>
                        <label class="input">
                            {{ Form::text('construction_period') }}
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
                        <label class="label">Цена с участком (руб.)</label>
                        <label class="input">
                            {{ Form::text('price') }}
                        </label>
                    </section>
                    <section>
                        <label class="label">Номер участка</label>
                        <label class="select">
                            <?php
                                $lands = array('Без участка');
                                foreach(Land::lists('number','id') as $land_id => $land_number):
                                    $lands[$land_id] = 'Участок №'.$land_number;
                                endforeach;
                            ?>
                            {{ Form::select('land_id', $lands) }}
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
            price: {required: true, maxlength: 100},
        };
        var validation_messages = {
            title: {required: "Укажите название"},
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