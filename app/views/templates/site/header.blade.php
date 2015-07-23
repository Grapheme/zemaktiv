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
            {{ Menu::placement('main_menu') }}
            <ul>
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