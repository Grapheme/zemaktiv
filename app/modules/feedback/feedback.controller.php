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
        Route::post("/request/poll", array('as' => 'request_poll', 'uses' => $class . "@requestPoll"));
        Route::post("/request/main-poll", array('as' => 'request_main_poll', 'uses' => $class . "@requestMainPoll"));
        Route::post("/request/pricelist", array('as' => 'request_pricelist', 'uses' => $class . "@requestPriceList"));
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
        $validation = Validator::make(Input::all(), array('phone' => 'required'/*, 'request'=>'required'*/));
        if ($validation->passes()):
            $feedback_mail = Config::get('mail.feedback.call_address');
            Config::set('mail.sendto_mail', $feedback_mail);
            Config::set('mail.sendto_mail_copy.first', 'smth.special@gmail.com');
            Config::set('mail.sendto_mail_copy.second', 'call@zemaktiv.ru');
            $this->postSendMessage(NULL, array('subject' => 'Заказ звонка',
                'phone' => Input::get('phone'), 'request' => Input::get('request')), 'call_request');
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
            'phone' => 'required'));
        if ($validation->passes()):
            $feedback_mail = Config::get('mail.feedback.bran_address');
            Config::set('mail.sendto_mail', $feedback_mail);
            Config::set('mail.sendto_mail_copy.first', 'smth.special@gmail.com');
            Config::set('mail.sendto_mail_copy.second', 'call@zemaktiv.ru');
            $this->postSendMessage(NULL, array('subject' => 'Бронирование участка',
                'land_id' => Input::get('id'),
                'name' => Input::get('name'),
                'phone' => Input::get('phone'),
                'livetype' => Input::get('livetype'),
                'technology' => Input::get('technology')
            ), 'bron_request');
            $json_request['responseText'] = 'Сообщение отправлено';
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validation->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function requestPoll() {

        if (!Request::ajax()) return App::abort(404);
        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        $validation = Validator::make(Input::all(), array('security' => '', 'communications' => '', 'rest' => '',
            'roads' => '', 'email' => 'required|email'));
        if ($validation->passes()):
            $feedback_mail = Config::get('mail.feedback.poll_address');
            Config::set('mail.sendto_mail', $feedback_mail);
            $this->postSendMessage(NULL, array('subject' => 'Опрос',
                'security' => Input::get('security'),
                'communications' => Input::get('communications'),
                'rest' => Input::get('rest'),
                'roads' => Input::get('roads'),
                'email' => Input::get('email')
            ), 'poll_request');
            $json_request['responseText'] = 'Сообщение отправлено';
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validation->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function requestMainPoll() {

        if (!Request::ajax()) return App::abort(404);
        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        $validation = Validator::make(Input::all(), array('area' => '', 'area-type' => '', 'env' => '',
            'land' => '', 'price' => '', 'technology' => ''));
        if ($validation->passes()):
            $feedback_mail = Config::get('mail.feedback.poll_address');
            Config::set('mail.sendto_mail', $feedback_mail);
            $this->postSendMessage(NULL, array('subject' => 'Статистика'), 'main_poll_request');
            $json_request['responseText'] = 'Сообщение отправлено';
            $json_request['status'] = TRUE;
        else:
            $json_request['responseText'] = 'Неверно заполнены поля';
            $json_request['responseErrorText'] = implode($validation->messages()->all(), '<br />');
        endif;
        return Response::json($json_request, 200);
    }

    public function requestPriceList() {

        if (!Request::ajax()) return App::abort(404);
        $json_request = array('status' => FALSE, 'responseText' => '', 'redirect' => FALSE);
        $validation = Validator::make(Input::all(), array('email' => 'required|email'));
        if ($validation->passes()):
            $feedback_mail = Input::get('email');
            Config::set('mail.sendto_mail', $feedback_mail);
            $this->postSendMessage(NULL, array('subject' => 'Прайс-лист'), 'pricelist_request');
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

            if (Config::has('mail.sendto_mail_copy.first')):
                $message->cc(Config::get('mail.sendto_mail_copy.first'));
            endif;
            if (Config::has('mail.sendto_mail_copy.second')):
                $message->cc(Config::get('mail.sendto_mail_copy.second'));
            endif;

            $message->to(Config::get('mail.sendto_mail'))->subject(@$data['subject']);
        });
    }
}


