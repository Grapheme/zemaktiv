<?php

class LandController extends BaseController {

    public static $name = 'land';
    public static $group = 'application';

    /****************************************************************************/
    public static function returnRoutes($prefix = null) {

        $class = __CLASS__;
        Route::group(array('before' => 'auth', 'prefix' => 'admin'), function () use ($class) {
            Route::resource('land', $class,
                array(
                    'except' => array('show'),
                    'names' => array(
                        'index' => 'land.index',
                        'create' => 'land.create',
                        'store' => 'land.store',
                        'edit' => 'land.edit',
                        'update' => 'land.update',
                        'destroy' => 'land.destroy'
                    )
                )
            );
        });
    }

    /****************************************************************************/
    public function __construct() {

        $this->module = array(
            'tpl' => static::returnTpl('admin'),
        );
        View::share('module', $this->module);
    }

    /****************************************************************************/
    public static function returnInfo() {
    }

    public static function returnMenu() {
    }

    public static function returnActions() {
    }

    /****************************************************************************/
    public function index() {

        if(Input::has('search')):
            $lands = Land::where('number', Input::get('search'))->paginate(1);
        else:
            $lands = Land::orderBy('click','DESC')->orderBy('number')->paginate(25);
        endif;
        return View::make($this->module['tpl'] . 'land.index', compact('lands'));
    }

    public function create() {

        return View::make($this->module['tpl'] . 'land.create');
    }

    public function store() {

        $validator = Validator::make(Input::all(), Land::$rules);
        if ($validator->passes()):

            $land = new Land();
            $land->turn = Input::get('turn');
            $land->status = Input::get('status');
            $land->description = Input::get('description');
            $land->number = Input::get('number');
            $land->area = Input::get('area');
            $land->price = Input::get('price');
            $land->price_house = Input::get('price_house');
            $land->coordinate_x = (int)Input::get('coordinate_x');
            $land->coordinate_y = (int)Input::get('coordinate_y');
            $land->photo_id = (int)Input::get('photo_id');
            $land->sold = Input::has('sold') ? 1 : 0;
            $land->save();

            $land->gallery_id = ExtForm::process('gallery', array('module' => 'Участок', 'unit_id' => $land->id,
                'gallery' => Input::get('gallery'), 'single' => TRUE));
            $land->save();

            $json_request['responseText'] = "Участок добавлен";
            $json_request['redirect'] = URL::route('land.index');
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validator->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function edit($land_id) {

        if ($land = Land::where('id', $land_id)->with('gallery')->first()):
            return View::make($this->module['tpl'] . 'land.edit', compact('land'));
        else:
            App::abort(404);
        endif;
    }

    public function update($land_id) {

        $validator = Validator::make(Input::all(), Land::$rules);
        if ($validator->passes()):

            $land = Land::where('id', $land_id)->first();
            $land->turn = Input::get('turn');
            $land->status = Input::get('status');
            $land->description = Input::get('description');
            $land->number = Input::get('number');
            $land->area = Input::get('area');
            $land->price = Input::get('price');
            $land->price_house = Input::get('price_house');
            $land->coordinate_x = (int)Input::get('coordinate_x');
            $land->coordinate_y = (int)Input::get('coordinate_y');
            $land->photo_id = (int)Input::get('photo_id');
            $land->sold = Input::has('sold') ? 1 : 0;
            $land->save();

            $land->gallery_id = ExtForm::process('gallery', array('module' => 'Участок', 'unit_id' => $land->id,
                'gallery' => Input::get('gallery'), 'single' => TRUE));
            $land->save();

            $json_request['responseText'] = "Участок сохранен";
            $json_request['redirect'] = URL::route('land.index');
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validator->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function destroy($land_id) {

        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        if (Request::ajax()):
            if ($gallery = Land::where('id', $land_id)->first()->gallery):
                $photos = $gallery->photos;
                foreach ($gallery->photos as $photo):
                    if (!empty($photo->name) && File::exists(Config::get('site.galleries_photo_dir') . '/' . $photo->name)):
                        File::delete(Config::get('site.galleries_photo_dir') . '/' . $photo->name);
                    endif;
                    if (!empty($photo->name) && File::exists(Config::get('site.galleries_thumb_dir') . '/' . $photo->name)):
                        File::delete(Config::get('site.galleries_thumb_dir') . '/' . $photo->name);
                    endif;
                    $photo->delete();
                endforeach;
                $gallery->delete();
            endif;
            if ($photo = Land::where('id', $land_id)->first()->photo):
                if (!empty($photo->name) && File::exists(Config::get('site.galleries_photo_dir') . '/' . $photo->name)):
                    File::delete(Config::get('site.galleries_photo_dir') . '/' . $photo->name);
                endif;
                if (!empty($photo->name) && File::exists(Config::get('site.galleries_thumb_dir') . '/' . $photo->name)):
                    File::delete(Config::get('site.galleries_thumb_dir') . '/' . $photo->name);
                endif;
                $photo->delete();
            endif;
            Land::where('id', $land_id)->delete();

            $json_request['responseText'] = "Участок удален.";
            $json_request['status'] = TRUE;
        else:
            return Redirect::back();
        endif;
        return Response::json($json_request, 200);
    }
    /****************************************************************************/
}