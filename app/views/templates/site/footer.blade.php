<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<footer class="footer">
    <div class="wrapper">
        <div class="footer__left">
            <div class="left__block">
                <div class="block__link"><span>&copy; Земактив 2015<? if (date('Y') > 2015) { echo '-' . date('Y'); } ?></span></div>
                <div class="block__link"><a href="{{ pageurl('about-company') }}">О компании</a></div>
            </div>
            <div class="left__block">
                <div class="block__link"><a href="{{ pageurl('about') }}">О проекте</a></div>
                <div class="block__link"><a href="{{ pageurl('contacts') }}">Контакты</a></div>
            </div>
        </div>
        <div class="footer__right">
            <span>Симферопольское шоссе, 70 км от МКАД, +7 (495) 407-78-87</span>
            <br>
            <a style="text-decoration: none; border: 0 none; margin-top: 10px;" href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_blue.png" alt="Mobile Analytics" /></a>
            <!-- <br>
            <a href="http://grapheme.ru" target="_blank">Разработано в ГРАФЕМА</a> -->
        </div>
    </div>
</footer>
