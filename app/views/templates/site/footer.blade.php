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
                <div class="block__link"><a href="">О компании</a></div>
            </div>
            <div class="left__block">
                <div class="block__link"><a href="{{ pageurl('about') }}">О проекте</a></div>
                <div class="block__link"><a href="">Контакты</a></div>
            </div>
        </div>
        <div class="footer__right"><span>Симферопольское шоссе, 70 км от МКАД, +7 (495) 249-55-55</span></div>
    </div>
</footer>
