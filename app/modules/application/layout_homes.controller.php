<?php


class LayoutHomesController extends BaseController {

    public static $name = 'layout_homes';
    public static $group = 'application';
    public static $materials = array('Каркасные дома' => 'Каркасные дома', 'Газобетонный блок' => 'Газобетонный блок',
        'Оцилиндрованное дерево' => 'Оцилиндрованное дерево');
    public static $materials_desc = array(
        'Каркасные дома' => '',
        'Газобетонный блок' => '',
        'Оцилиндрованное дерево' => ''
        );

    /****************************************************************************/
    public static function returnRoutes() {
        $class = __CLASS__;
        Route::group(array('before' => 'auth', 'prefix' => 'admin'), function () use ($class) {
            Route::resource('layouts-homes', $class,
                array(
                    'except' => array('show'),
                    'names' => array(
                        'index' => 'layouts_homes.index',
                        'create' => 'layouts_homes.create',
                        'store' => 'layouts_homes.store',
                        'edit' => 'layouts_homes.edit',
                        'update' => 'layouts_homes.update',
                        'destroy' => 'layouts_homes.destroy'
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

        $buildings = Layout_homes::orderBy('created_at', 'DESC')->with('land')->paginate(25);
        return View::make($this->module['tpl'] . 'layout_homes.index', compact('buildings'));
    }

    public function create() {

        return View::make($this->module['tpl'] . 'layout_homes.create');
    }

    public function store() {

        $validator = Validator::make(Input::all(), Layout_homes::$rules);
        if ($validator->passes()):

            $build = new Layout_homes();
            $build->title = Input::get('title');
            $build->contractor_title = Input::get('contractor_title');
            $build->contractor_link = Input::get('contractor_link');
            $build->construction_period = Input::get('construction_period');
            $build->area = Input::get('area');
            $build->material = Input::get('material');
            $build->price = Input::get('price');
            $build->land_id = Input::get('land_id');
            $build->photo_id = (int)Input::get('photo_id');
            $build->save();

            $build->gallery_id = ExtForm::process('gallery', array('module' => 'Готовый макет дом',
                'unit_id' => $build->id,
                'gallery' => Input::get('gallery'), 'single' => TRUE));
            $build->save();

            $json_request['responseText'] = "Проект добавлен";
            $json_request['redirect'] = URL::route('layouts_homes.index');
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validator->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function edit($build_id) {

        if ($build = Layout_homes::where('id', $build_id)->with('gallery')->first()):
            return View::make($this->module['tpl'] . 'layout_homes.edit', compact('build'));
        else:
            App::abort(404);
        endif;
    }

    public function update($badge_id) {

        $validator = Validator::make(Input::all(), Layout_homes::$rules);
        if ($validator->passes()):

            $build = Layout_homes::where('id', $badge_id)->first();
            $build->title = Input::get('title');
            $build->contractor_title = Input::get('contractor_title');
            $build->contractor_link = Input::get('contractor_link');
            $build->construction_period = Input::get('construction_period');
            $build->area = Input::get('area');
            $build->material = Input::get('material');
            $build->price = Input::get('price');
            $build->land_id = Input::get('land_id');
            $build->photo_id = (int)Input::get('photo_id');
            $build->save();

            $build->gallery_id = ExtForm::process('gallery', array('module' => 'Готовый дом', 'unit_id' => $build->id,
                'gallery' => Input::get('gallery'), 'single' => TRUE));
            $build->save();

            $json_request['responseText'] = "Проект сохранен";
            $json_request['redirect'] = URL::route('layouts_homes.index');
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validator->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function destroy($badge_id) {

        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        if (Request::ajax()):
            if ($gallery = Layout_homes::where('id', $badge_id)->first()->gallery):
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
            if ($photo = Layout_homes::where('id', $badge_id)->first()->photo):
                if (!empty($photo->name) && File::exists(Config::get('site.galleries_photo_dir') . '/' . $photo->name)):
                    File::delete(Config::get('site.galleries_photo_dir') . '/' . $photo->name);
                endif;
                if (!empty($photo->name) && File::exists(Config::get('site.galleries_thumb_dir') . '/' . $photo->name)):
                    File::delete(Config::get('site.galleries_thumb_dir') . '/' . $photo->name);
                endif;
                $photo->delete();
            endif;
            Layout_homes::where('id', $badge_id)->delete();

            $json_request['responseText'] = "Проект удален.";
            $json_request['status'] = TRUE;
        else:
            return Redirect::back();
        endif;
        return Response::json($json_request, 200);
    }
    /****************************************************************************/
}