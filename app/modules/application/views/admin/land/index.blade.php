@extends(Helper::acclayout())
@section('content')
    @include($module['tpl'].'land.menu')
    @if($lands->count())
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-striped table-bordered min-table white-bg">
                    <thead>
                    <tr>
                        <th class="text-center" style="width:40px">#</th>
                        <th style="width:50%;" class="text-center">Название</th>
                        <th style="width:20%;" class="text-center">Цена участка</th>
                        <th style="width:20%;" class="text-center">Цена участка с домом</th>
                        <th style="width:10%;" class="text-center">Статус</th>
                        <th class="width-250 text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lands as $index => $land)
                        <tr>
                            <?php $sub_index = Input::has('page') ? (int)Input::get('page')-1 : 0;?>
                            <td>{{ ($index+1)+($sub_index*25) }}</td>
                            <td>Участок №{{ $land->number }}.</td>
                            <td>{{ number_format($land->price, 2, '.', ' ') }} руб.</td>
                            <td>{{ number_format($land->price_house, 2, '.', ' ') }} руб.</td>
                            <td>{{ $land->sold ? 'Продан' : '' }}</td>
                            <td class="text-center" style="white-space:nowrap;">
                                @if(Allow::action('application','edit'))
                                    <a class="btn btn-success margin-right-5"
                                       href="{{ URL::route('land.edit', $land->id) }}" title="Изменить">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endif
                                @if(Allow::action('application','delete'))
                                    {{ Form::open(array('route' => array('land.destroy', $land->id),'method'=>'delete','style'=>'display:inline-block')) }}
                                    <button type="button" class="btn btn-danger remove-land"><i
                                                class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $lands->links() }}
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="ajax-notifications custom">
                    <div class="alert alert-transparent">
                        <h4>Список пуст</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
@section('scripts')
    <script>
        var essence = 'land';
        var essence_name = 'участок';
    </script>
    {{ HTML::script('private/js/modules/standard.js') }}
@stop
