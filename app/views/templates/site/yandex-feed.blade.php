<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<?= '<?xml version="1.0" encoding="utf-8"?>'; ?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
    <generation-date>{{ date('c') }}</generation-date>
    @foreach($lands as $land)
        <offer internal-id="{{ $land->number }}">
            <type>продажа</type>
            <property-type>жилая</property-type>
            <category>участок</category>
            <url>{{ Request::getHttpHost() }}</url>
            <creation-date>{{ date('c') }}</creation-date>
            <manually-added>1</manually-added>
            <location>
                <country>Россия</country>
                <region>Московская область</region>
                <district>Серпуховский район</district>
                <locality-name>деревня Нижние Велеми</locality-name>
                <direction>Симферопольское шоссе</direction>
                <distance>69</distance>
                <railway-station>Шарапова Охота</railway-station>
            </location>
            <sales-agent>
                <name>Екатерина</name>
                <phone>+7 495 407-78-87</phone>
                <category>застройщик</category>
                <organization>Коттеджный посёлок Вяземские сады, УК Земактив</organization>
                <url>{{ URL::to('/?utm_source=yarealty_db') }}/</url>
                <email>call@zemaktiv.ru</email>
                <photo>
                    {{ asset(Config::get('site.theme_path').'/images/header/logo_big.png') }}
                </photo>
            </sales-agent>
            <price>
                <value>{{ number_format($land->price, 2, '.', ' ') }}</value>
                <currency>RUR</currency>
            </price>
            <mortgage>1</mortgage>
            <image>@if(!empty($land->photo)) {{ $land->photo->name }} @else {{ asset('uploads/galleries/1438850036_1591.jpg') }} @endif</image>
            <image>@if(!empty($land->photo)) {{ $land->photo->name }} @else {{ asset('uploads/galleries/1438098174_1481.jpg') }} @endif</image>
            <image>@if(!empty($land->photo)) {{ $land->photo->name }} @else {{ asset('uploads/galleries/1438850036_1666.jpg') }} @endif</image>
            <image>@if(!empty($land->photo)) {{ $land->photo->name }} @else {{ asset('uploads/galleries/1438687337_1237.jpg') }} @endif</image>
            <description>
                Симферопольское шоссе, 69 км от МКАД. Участки без подряда и готовые дома в окружении леса с действующими
                коммуникациями от 699 000 рублей. Охраняемый коттеджный посёлок с детскими площадками и зонами отдыха.
                Выходы в лес прямо из посёлка. Река Нара. Прекрасный густой смешанный лесной массив 23 кв. км
                Прогулочная зона, ландшафтный парк, беседки для отдыха, зона бербекю, гостевая парковка, спортивная и детская площадки, оборудованный родник.
                Липовая аллея шириной 22 метра с местами для отдыха, качелями и лавочками.
                Газ, электричество, водопровод входят в стоимость земельного участка.
                Полностью асфальтированный подъезд.
                Поселок застроен и заселен.
                От застройщика.
                Посредников просим не беспокоить.
                Подробная информация — на сайте УК Земактив.
                Участок №"{{ $land->number }}"
            </description>
            <lot-area>
                <value>{{ number_format($land->area, 2, '.', '') }}</value>
                <unit>сот</unit>
            </lot-area>
            <gas-supply>1</gas-supply>
            <electricity-supply>1</electricity-supply>
            <water-supply>1</water-supply>
            <lot-type>ИЖС</lot-type>
            <is-elite>0</is-elite>
            <alarm>1</alarm>
        </offer>
    @endforeach
</realty-feed>