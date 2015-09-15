<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>

<header class="header js-header">
    <div class="header__top">
        <div class="top__big">
        @if (Request::is('/'))
            <a class="big__logo" href="#"></a>
        @else
            <a class="big__logo" href="{{ pageurl('') }}"></a>
        @endif
            <a class="big__right"></a>
        </div>
        <div class="top__min">
        @if (Request::is('/'))
            <a class="min__item item-apple" href="#"></a>
            <a href="#" class="min__item item-title"></a>
            <a href="#" class="min__item item-name"></a>
            <a href="#" class="min__item item-text"></a>
        @else
            <a class="min__item item-apple" href="{{ pageurl('') }}"></a>
            <a href="{{ pageurl('') }}" class="min__item item-title"></a>
            <a href="{{ pageurl('') }}" class="min__item item-name"></a>
            <a href="{{ pageurl('') }}" class="min__item item-text"></a>
        @endif
        </div>
    </div>
    <div class="header__menu">
        <nav class="menu__nav">
            {{ Menu::placement('main_menu') }}
            <ul>
                <li class="nav__item item-call js-open-overlay" data-open="call">
                    <a href="#" class="item__link"><span>Визит в посёлок</span></a>
                </li>
                <li class="nav__item item-phone">
                    <a href="tel:+74954077887" class="item__link"><span>+7 (495) 407-78-87</span></a>
                </li>
            </ul>
        </nav>
    </div>
</header>