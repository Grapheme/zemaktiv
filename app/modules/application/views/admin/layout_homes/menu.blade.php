<?
$menus = array();
$menus[] = array(
        'link' => URL::route('layouts_homes.create'),
        'title' => 'Добавить',
        'class' => 'btn btn-primary'
);
?>
<h1 class="top-module-menu">
    <a href="{{ Request::path() }}">Макеты домов</a>
</h1>

{{ Helper::drawmenu($menus) }}
