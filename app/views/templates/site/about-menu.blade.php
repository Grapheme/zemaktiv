<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<div class="tabs-right">
    <div class="right-cont">
        <a href="{{ pageurl('about') }}" class="title__link" @if ($hidden == 'about')style="display: none;"@endif>О проекте</a>
        <a href="{{ pageurl('about-company') }}" class="title__link" @if ($hidden == 'about-company')style="display: none;"@endif>О компании</a>
        <a href="{{ pageurl('documents') }}" class="title__link" @if ($hidden == 'documents')style="display: none;"@endif>Документы</a>
        <a href="{{ pageurl('news') }}" class="title__link" @if ($hidden == 'news')style="display: none;"@endif>Новости</a>
        <a href="{{ pageurl('readiness') }}" class="title__link" @if ($hidden == 'readiness')style="display: none;"@endif>Готовность</a>
        <a href="{{ pageurl('contacts') }}" class="title__link" @if ($hidden == 'contacts')style="display: none;"@endif>Контакты</a>
    </div>
</div>