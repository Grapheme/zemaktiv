<?
$menus = array();
$menus[] = array(
        'link' => URL::route('land.create'),
        'title' => 'Добавить',
        'class' => 'btn btn-primary'
);
?>
<h1 class="top-module-menu">
    <a href="{{ Request::path() }}">Участки</a>
</h1>

{{ Helper::drawmenu($menus) }}
