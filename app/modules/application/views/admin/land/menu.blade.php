<?
$menus = array();
$menus[] = array(
        'link' => URL::route('land.create'),
        'title' => 'Добавить',
        'class' => 'btn btn-primary'
);
?>
{{ Form::open(array('route'=>'land.index', 'class'=>'header-search pull-right', 'method'=>'get')) }}
<input name="search" type="text" id="search-fld" placeholder="Поиск по номеру">
<button type="submit"><i class="fa fa-search"></i></button>
{{ Form::close() }}
<h1 class="top-module-menu">
    <a href="{{ Request::path() }}">Участки</a>
</h1>

{{ Helper::drawmenu($menus) }}
