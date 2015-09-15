<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<footer class="footer">
    <div class="wrapper">
        <div class="footer__left">
            <!-- <div class="left__block">
                <div class="block__link"></div>
                <div class="block__link"><a href="{{ pageurl('about-company') }}">О компании</a></div>
            </div>
            <div class="left__block">
                <div class="block__link"><a href="{{ pageurl('about') }}">О проекте</a></div>
                <div class="block__link"><a href="{{ pageurl('contacts') }}">Контакты</a></div>
            </div> -->
            <div class="left__desc"><span>&copy; Управляющая компания Земактив 2015<? if (date('Y') > 2015) { echo '-' . date('Y'); } ?></span></div>
            <div class="left__block">
                <div class="block__link"><a href="{{ pageurl('choice-land') }}">Выбрать участок</a></div>
                <div class="block__link"><a href="{{ pageurl('buildings') }}">Построить дом</a></div>
            </div>
            <div class="left__block">
                <div class="block__link"><a href="{{ pageurl('about') }}">О проекте</a></div>
                <div class="block__link"><a href="{{ pageurl('readiness') }}">Готовность</a></div>
                <div class="block__link"><a href="{{ pageurl('location') }}">Расположение</a></div>
                <div class="block__link"><a href="{{ pageurl('putevoditel') }}">Путеводитель</a></div>
                <div class="block__link"><a href="{{ pageurl('photos') }}">Фотографии</a></div>
                <div class="block__link"><a href="{{ pageurl('communications') }}">Коммуникации</a></div>
            </div>
            <div class="left__block">
                <div class="block__link"><a href="{{ pageurl('about-company') }}">О компании</a></div>
                <div class="block__link"><a href="{{ pageurl('documents') }}">Документы</a></div>
                <div class="block__link"><a href="{{ pageurl('news') }}">Новости</a></div>
                <div class="block__link"><a href="{{ pageurl('contacts') }}">Контакты</a></div>
            </div>
        </div>
        <div class="footer__right">
            <span>+7 (495) 407-78-87</span>
            <br>
            <a style="text-decoration: none; border: 0 none; margin-top: 20px; display: inline-block;" href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_blue.png" alt="Mobile Analytics" /></a>
            <!-- <br>
            <a href="http://grapheme.ru" target="_blank">Разработано в ГРАФЕМА</a> -->
        </div>
    </div>
</footer>
