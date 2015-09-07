<?
$menus = array();
$menus[] = array(
        'link' => URL::route('layouts_homes.create'),
        'title' => 'Добавить',
        'class' => 'btn btn-primary'
);
?>
{{ Form::open(array('route'=>'layouts_homes.index', 'class'=>'header-search pull-right', 'method'=>'get')) }}
<input name="search" type="text" id="search-fld" placeholder="Поиск по названию">
<button type="submit"><i class="fa fa-search"></i></button>
{{ Form::close() }}
<h1 class="top-module-menu">
    <a href="{{ Request::path() }}">Проекты домов</a>
</h1>

{{ Helper::drawmenu($menus) }}
