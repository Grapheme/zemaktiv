<?
$menus = array();
$menus[] = array(
        'link' => URL::route('buildings.create'),
        'title' => 'Добавить',
        'class' => 'btn btn-primary'
);
?>
{{ Form::open(array('route'=>'buildings.index', 'class'=>'header-search pull-right', 'method'=>'get')) }}
<input name="search" type="text" id="search-fld" placeholder="Поиск по названию">
<button type="submit"><i class="fa fa-search"></i></button>
{{ Form::close() }}
<h1 class="top-module-menu">
    <a href="{{ Request::path() }}">Готовые дома</a>
</h1>

{{ Helper::drawmenu($menus) }}
