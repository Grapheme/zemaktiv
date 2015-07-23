<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>

<header class="header js-header">
    <div class="header__top">
        <div class="top__big">
            <a href="#" class="big__logo"></a>
            <a class="big__right"></a>
        </div>
        <div class="top__min">
            <a href="#" class="min__item item-apple"></a>
            <a href="#" class="min__item item-title">Коттеджный посёлок</a>
            <a href="#" class="min__item item-name"></a>
            <a href="#" class="min__item item-text"></a>
        </div>
    </div>
    <div class="header__menu">
        <nav class="menu__nav">
            <ul>
                <li class="nav__item item-us item-raspb">
                    <a href="{{ pageurl("choice-land") }}" {{ Helper::isRoute('page','choice-land') }} class="item__link"><span>Выбор участка</span></a>
                </li>
                <li class="nav__item item-us item-green">
                    <a href="{{ pageurl("buildings") }}" {{ Helper::isRoute('page','buildings') }} class="item__link"><span>Готовые дома</span></a>
                </li>
                <li class="nav__item item-us item-blue">
                    <a href="{{ pageurl("communications") }}" {{ Helper::isRoute('page','communications') }} class="item__link"><span>Коммуникации</span></a>
                </li>
                <li class="nav__item item-us item-red">
                    <a href="{{ pageurl("location") }}" {{ Helper::isRoute('page','location') }} class="item__link"><span>Расположение</span></a>
                </li>
                <li class="nav__item item-us item-yellow">
                    <a href="{{ pageurl("photos") }}" {{ Helper::isRoute('page','photos') }} class="item__link"><span>Фотографии</span></a>
                </li>
                <li class="nav__item item-us item-orange">
                    <a href="{{ pageurl("about") }}" {{ Helper::isRoute('page','about') }} class="item__link"><span>О проекте</span></a>
                </li>
                <li class="nav__item item-call">
                    <a href="#" class="item__link"><span>Заказать звонок</span></a>
                </li>
                <li class="nav__item item-phone">
                    <a href="tel:+74952495555" class="item__link"><span>+7 (495) 249-55-55</span></a>
                </li>
            </ul>
        </nav>
    </div>
</header>