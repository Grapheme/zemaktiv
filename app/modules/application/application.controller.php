<?php

class ApplicationController extends BaseController {

    public static $name = 'application';
    public static $group = 'application';

    /****************************************************************************/
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        Route::get('ya-feed', array('as' => 'yandex-feed', 'uses' => $class . '@yandexFeed'));
        Route::post('click-tracker', array('as' => 'click.tracker', 'uses' => $class . '@clickTracker'));
        Route::post('buildings/set-filter', array('as' => 'buildings.filter', 'uses' => $class . '@setBuildingFilter'));
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
            'title' => 'Проекты домов',
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

    public function setBuildingFilter() {

//        Event::listen('illuminate.query', function ($query) {
//            print_r($query);
//        });

        $json_request = array('status' => FALSE, 'html' => '', 'redirect' => FALSE);
        if (Request::ajax()):
            $buildings = $layouts = $materials = array();
            $materials[0] = '';
            foreach (LayoutHomesController::$materials as $material):
                $materials[] = $material;
            endforeach;
            if (Input::has('house_build')):
                $buildings = $this->builds_filter($materials);
            endif;
            if (Input::has('house_layout')):
                $layouts = $this->layaut_filter($materials);
            endif;
            if (Input::has('house_build')):
                $buildings = $buildings->where('sold', 0)->orderBy('price')->orderBy('area')->with('land', 'photo', 'gallery.photos')->get();
                $json_request['html'] .= View::make(Helper::layout('assets.builds'), array('buildings' => $buildings))->render();
                $json_request['status'] = TRUE;
            endif;
            if (Input::has('house_layout')):
                $layouts = $layouts->orderBy('price')->orderBy('area')->with('land', 'photo', 'gallery.photos')->get();
                $json_request['html'] .= View::make(Helper::layout('assets.builds'), array('buildings' => $layouts))->render();
                $json_request['status'] = TRUE;
            endif;
        else:
            return Redirect::back();
        endif;
        return Response::json($json_request, 200);
    }

    private function builds_filter($materials) {

        $buildings = new Buildings();
        if (Input::has('technology_1') || Input::has('technology_2') || Input::has('technology_3')):
            if (Input::has('house_build')):
                $buildings = $buildings->where(function ($query) use ($materials) {
                    if (Input::has('technology_1')):
                        $query->orWhere('material', $materials[1]);
                    endif;
                    if (Input::has('technology_2')):
                        $query->orWhere('material', $materials[2]);
                    endif;
                    if (Input::has('technology_3')):
                        $query->orWhere('material', $materials[3]);
                    endif;
                });
            endif;
        endif;
        if (Input::has('area_150') || Input::has('area_150_180') || Input::has('area_181')):
            if (Input::has('house_build')):
                $buildings = $buildings->where(function ($query) {
                    if (Input::has('area_150')):
                        $query->orWhere('area', '<', 150);
                    endif;
                    if (Input::has('area_150_180')):
                        $query->orWhere(function ($query_150_180) {
                            $query_150_180->where('area', '>=', 150);
                            $query_150_180->where('area', '<=', 180);
                        });
                    endif;
                    if (Input::has('area_181')):
                        $query->orWhere('area', '>=', 181);
                    endif;
                });
            endif;
        endif;
        if (Input::has('price_2') || Input::has('price_2_25') || Input::has('price_25_35') || Input::has('price_35')):
            if (Input::has('house_build')):
                $buildings = $buildings->where(function ($query) {
                    if (Input::has('price_2')):
                        $query->orWhere('price', '<', 2000000);
                    endif;
                    if (Input::has('price_2_25')):
                        $query->orWhere(function ($query_2_25) {
                            $query_2_25->where('price', '>=', 2000000);
                            $query_2_25->where('price', '<=', 2500000);
                        });
                    endif;
                    if (Input::has('price_25_35')):
                        $query->orWhere(function ($query_25_35) {
                            $query_25_35->where('price', '>', 2500000);
                            $query_25_35->where('price', '<=', 3500000);
                        });
                    endif;
                    if (Input::has('price_35')):
                        $query->orWhere('price', '>', 3500000);
                    endif;
                });
            endif;
        endif;
        return $buildings;
    }

    private function layaut_filter($materials) {

        $layouts = new Layout_homes();
        if (Input::has('technology_1') || Input::has('technology_2') || Input::has('technology_3')):
            if (Input::has('house_layout')):
                $layouts = $layouts->where(function ($query) use ($materials) {
                    if (Input::has('technology_1')):
                        $query->orWhere('material', $materials[1]);
                    endif;
                    if (Input::has('technology_2')):
                        $query->orWhere('material', $materials[2]);
                    endif;
                    if (Input::has('technology_3')):
                        $query->orWhere('material', $materials[3]);
                    endif;
                });
            endif;
        endif;
        if (Input::has('area_150') || Input::has('area_150_180') || Input::has('area_181')):
            if (Input::has('house_layout')):
                $layouts = $layouts->where(function ($query) {
                    if (Input::has('area_150')):
                        $query->orWhere('area', '<', 150);
                    endif;
                    if (Input::has('area_150_180')):
                        $query->orWhere(function ($query_150_180) {
                            $query_150_180->where('area', '>=', 150);
                            $query_150_180->where('area', '<=', 180);
                        });
                    endif;
                    if (Input::has('area_181')):
                        $query->orWhere('area', '>=', 181);
                    endif;
                });
            endif;
        endif;
        if (Input::has('price_2') || Input::has('price_2_25') || Input::has('price_25_35') || Input::has('price_35')):
            if (Input::has('house_layout')):
                $layouts = $layouts->where(function ($query) {
                    if (Input::has('price_2')):
                        $query->orWhere('price', '<', 2000000);
                    endif;
                    if (Input::has('price_2_25')):
                        $query->orWhere(function ($query_2_25) {
                            $query_2_25->where('price', '>=', 2000000);
                            $query_2_25->where('price', '<=', 2500000);
                        });
                    endif;
                    if (Input::has('price_25_35')):
                        $query->orWhere(function ($query_25_35) {
                            $query_25_35->where('price', '>', 2500000);
                            $query_25_35->where('price', '<=', 3500000);
                        });
                    endif;
                    if (Input::has('price_35')):
                        $query->orWhere('price', '>', 3500000);
                    endif;
                });
            endif;
        endif;
        return $layouts;
    }
}