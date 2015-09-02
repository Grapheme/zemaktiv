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
                <name>Валерий</name>
                <phone>+7 495 407-78-87</phone>
                <category>застройщик</category>
                <organization>УК Земактив</organization>
                <url>{{ URL::to('/') }}/</url>
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
            <description>
                Симферопольское шоссе, 69 км от МКАД. Участки без подряда и готовые дома в окружении леса с действующими
                коммуникациями от 699 000 рублей. Охраняемый коттеджный посёлок с детскими площадками и зонами отдыха.
                От застройщика.
            </description>
            <lot-area>
                <value>{{ $land->area }}</value>
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