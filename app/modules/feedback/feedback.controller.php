<?php

class FeedbackController extends BaseController {

    public static $name = 'feedback';
    public static $group = 'feedback';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        Route::post("/contacts/feedback", array('as' => 'contact_feedback', 'uses' => $class . "@postContactFeedback"));
        Route::post("/request/call", array('as' => 'request_call', 'uses' => $class . "@requestCall"));
        Route::post("/request/bron", array('as' => 'request_bron', 'uses' => $class . "@requestBron"));

    }

    /****************************************************************************/
    public function __construct() {

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'gtpl' => 'emails/',
        );
        View::share('module', $this->module);
    }

    /****************************************************************************/
    public function requestCall() {

        if (!Request::ajax()) return App::abort(404);
        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        $validation = Validator::make(Input::all(), array('phone' => 'required'));
        if ($validation->passes()):
            $feedback_mail = Config::get('mail.feedback.call_address');
            Config::set('mail.sendto_mail', $feedback_mail);
            $this->postSendMessage(NULL, array('subject' => 'Заказ звонка',
                'phone' => Input::get('phone')), 'call_request');
            $json_request['responseText'] = 'Сообщение отправлено';
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validation->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function requestBron() {

        if (!Request::ajax()) return App::abort(404);
        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        $validation = Validator::make(Input::all(), array('id' => 'required', 'name' => 'required',
            'email' => 'required|email', 'phone' => 'required'));
        if ($validation->passes()):
            $feedback_mail = Config::get('mail.feedback.bran_address');
            Config::set('mail.sendto_mail', $feedback_mail);
            $this->postSendMessage(NULL, array('subject' => 'Бронирование участка',
                'land_id' => Input::get('id'),
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'phone' => Input::get('phone')
            ), 'bron_request');
            $json_request['responseText'] = 'Сообщение отправлено';
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validation->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function postContactFeedback() {

        if (!Request::ajax()) return App::abort(404);
        $json_request = array('status' => FALSE, 'responseText' => '', 'responseErrorText' => '', 'redirect' => FALSE);
        $validation = Validator::make(Input::all(), array('name' => 'required', 'email' => 'required|email',
            'message' => 'required'));
        if ($validation->passes()):
            $feedback_mail = Config::get('mail.feedback.address');
            Config::set('mail.sendto_mail', $feedback_mail);
            $this->postSendmessage(NULL, array('subject' => 'Форма обратной связи', 'email' => Input::get('email'),
                'name' => Input::get('name'), 'content' => Input::get('message')));
            $json_request['responseText'] = 'Сообщение отправлено';
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validation->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    private function postSendMessage($email = null, $data = null, $template = 'feedback') {

        return Mail::send($this->module['gtpl'] . $template, $data, function ($message) use ($email, $data) {
            $message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
            $message->to(Config::get('mail.sendto_mail'))->subject(@$data['subject']);
        });
    }
}


