<?php

class ApplicationController extends BaseController {

    public static $name = 'application';
    public static $group = 'application';

    /****************************************************************************/
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        Route::get('ya-feed', array('as' => 'yandex-feed', 'uses' => $class . '@yandexFeed'));
        Route::post('click-tracker', array('as' => 'click.tracker', 'uses' => $class . '@clickTracker'));
    }

    /****************************************************************************/
    public function __construct() {
    }

    /****************************************************************************/
    public static function returnInfo() {

        return array(
            'name' => self::$name,
            'group' => self::$group,
            'title' => 'Вяземские сады',
            'visible' => 1,
        );
    }

    public static function returnMenu() {

        $menu_child[] = array(
            'title' => 'Макеты домов',
            'link' => 'layouts-homes',
            'class' => 'fa-circle',
        );
        $menu_child[] = array(
            'title' => 'Готовые дома',
            'link' => 'buildings',
            'class' => 'fa-circle',
        );
        $menu_child[] = array(
            'title' => 'Участки',
            'link' => 'land',
            'class' => 'fa-circle',
        );
        $menu[] = array(
            'title' => 'Каталог',
            'link' => '#',
            'class' => 'fa-book',
            'system' => 1,
            'menu_child' => $menu_child,
            'permit' => 'view'
        );
        return $menu;
    }

    public static function returnActions() {

        return array(
            'view' => 'Просмотр',
            'create' => 'Создание',
            'edit' => 'Редактирование',
            'delete' => 'Удаление',
        );
    }

    /****************************************************************************/

    private function create_xml($xml, array $vars = []) {

        if (is_null($xml)):
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?>');
        elseif (is_string($xml)):
            $xml = new SimpleXMLElement($xml);
        endif;
        foreach ($vars as $key => $value):
            $xml->addChild($key, $value);
        endforeach;
        return $xml;
    }

    private function make_xml() {

        Response::macro('xml', function (array $vars, $status = 200, array $headers = [], $xml = null) {
            $xml_out = self::create_xml($xml, $vars);
            if (empty($headers)):
                $headers = self::handle();
            endif;
            return Response::make($xml_out->asXML(), $status, $headers);
        });
    }

    private function handle() {

        return array(
            'Accept' => 'application/xml',
            'Content-Type' => 'application/xml; charset=utf-8',
            'User-Agent' => 'Fiddler',
        );
    }

    /****************************************************************************/
    public function yandexFeed() {

        $vars = array();
        $lands = Land::where('sold', 0)->where('price_house', 0)->with('photo')->get();
        $ya_feed = View::make(Helper::layout('yandex-feed'), compact('lands'))->render();
        $this->make_xml();
        return Response::xml($vars, 200, array(), $ya_feed);
    }

    public function clickTracker() {

        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        if (Request::ajax()):
            $validator = Validator::make(Input::all(), array('land_id' => 'required'));
            if ($validator->passes()):
                if ($land = Land::where('id', Input::get('land_id'))->first()):
                    $land->click = $land->click + 1;
                    $land->save();
                    $json_request['status'] = TRUE;
                endif;
            endif;
        else:
            return Redirect::back();
        endif;
        return Response::json($json_request, 200);
    }
}