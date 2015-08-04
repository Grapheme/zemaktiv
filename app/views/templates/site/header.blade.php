<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>

<header class="header js-header">
    <div class="header__top">
        <div class="top__big">
        @if (Request::is('/'))
            <div class="big__logo"></div>
        @else
            <a class="big__logo" href="{{ pageurl('') }}"></a>
        @endif
            <a class="big__right"></a>
        </div>
        <div class="top__min">
        @if (Request::is('/'))
            <div class="min__item item-apple"></div>
        @else
            <a class="min__item item-apple" href="{{ pageurl('') }}"></a>
        @endif
            <a href="#" class="min__item item-title"></a>
            <a href="#" class="min__item item-name"></a>
            <a href="#" class="min__item item-text"></a>
        </div>
    </div>
    <div class="header__menu">
        <nav class="menu__nav">
            {{ Menu::placement('main_menu') }}
            <ul>
                <li class="nav__item item-call js-open-overlay" data-open="call">
                    <a href="#" class="item__link"><span>Заказать звонок</span></a>
                </li>
                <li class="nav__item item-phone">
                    <a href="tel:+74952234949" class="item__link"><span>+7 (495) 223-49-49</span></a>
                </li>
            </ul>
        </nav>
    </div>
</header>