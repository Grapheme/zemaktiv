<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
<a href="#" class="js-scroll-top scroll-top"></a>
<div class="info-overlay js-info-overlay"></div>
<div class="overlay js-overlay">
    <div data-name="book" class="overlay__block block-book js-overlay-block">
        <div class="wrapper">
            <a href="#" class="block__close js-close-overlay"></a>
            <div class="block-cont">
                <div>
                    <!-- <div class="book__title js-book-title-with-house">
                        <span>
                            Участок №<span class="js-book-number"></span> с домом, <span class="js-book-line"></span>-ая очередь,
                            <br>
                            <span class="js-book-area"></span> соток, <span class="js-book-price-total"></span> руб.</span>
                        </span>
                    </div>
                    <div class="book__title js-book-title">
                        <span>
                            Участок №<span class="js-book-number"></span>, <span class="js-book-line"></span>-ая очередь,
                            <br>
                            <span class="js-book-area"></span> соток, <span class="js-book-price"></span> руб.</span>
                        </span>
                    </div> -->
                    <!-- <div class="book__title js-book-title-with-house">
                        <span>
                            Получить больше информации
                        </span>
                    </div> -->
                </div>
                <div class="overlay__form">
                    {{ Form::open(array('route'=>'request_bron','id'=>'book-form','class'=>'js-overlay-form')) }}
                        {{ Form::hidden('id',NULL,array('class'=>'js-input-book-id')) }}
                        <div class="stages-form form-book js-stages-form">
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="stage__checks">
                                        <span>
                                            <input value="Хочу дом, где можно жить круглый год" name="livetype" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="wholeyear">Хочу дом, где можно жить круглый год</label>
                                        </span>
                                        <br>
                                        <span>
                                            <input value="Летний дом, дачу" name="livetype" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="summerhouse">Летний дом, дачу</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="stage__checks">
                                        <span>
                                            <input value="Мне нужна консультация – я не знаю какой дом выбрать" name="technology" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="needconsult">Мне нужна консультация – я не знаю какой дом выбрать</label>
                                        </span>
                                        <br>
                                        <span>
                                            <input value="Хочу знать подробности о комплектации представленных домов" name="technology" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="needinfo">Хочу знать подробности о комплектации представленных домов</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block">
                                    <div class="block__title">Имя</div>
                                    <div class="block__input">
                                        <input type="text" name="name" class="input__item">
                                    </div>
                                </div>
                                <div class="form__block block-phone">
                                    <div class="block__title">Ваш номер телефона</div>
                                    <div class="block__input">
                                        <div class="phone__number">+7</div>
                                        <input type="text" name="phone" class="input__item">
                                    </div>
                                </div>
                                <div class="form__btn">
                                    <button type="submit" class="us-btn btn-transparent"><span>Отправить</span></button>
                                </div>
                                <div class="form__block">
                                    <div class="block__response js-response-text"></div>
                                </div>
                            </div>
                            <div class="stages-status">
                                <a href="#" class="status__dot js-status-dot"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <div class="overlay__success js-book-success">Скоро с вами свяжутся наши специалисты<br>для уточнения информации</div>
                </div>
            </div>
        </div>
    </div>
    <div data-name="book-map" class="overlay__block block-book js-overlay-block">
        <div class="wrapper">
            <a href="#" class="block__close js-close-overlay"></a>
            <div class="block-cont">
                <div class="overlay__form">
                    {{ Form::open(array('route'=>'request_bron','id'=>'book-form-map','class'=>'js-overlay-form')) }}
                        {{ Form::hidden('id',NULL,array('class'=>'js-input-book-id')) }}
                        <div class="stages-form form-book js-stages-form">
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Меня интересует</div>
                                    <div class="stage__checks">
                                        <span>
                                            <input value="Участки под дачу – я хочу построить дом сам, у меня уже есть к кому обратиться" name="livetype" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="wholeyear">Участки под дачу – я хочу построить дом сам, у меня уже есть к кому обратиться</label>
                                        </span>
                                        <br>
                                        <span>
                                            <input value="Участки под дачу – я пока не знаю какой именно дом построить – мне было интересно посмотреть проекты ваших домов" name="livetype" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="summerhouse">Участки под дачу – я пока не знаю какой именно дом построить – мне было интересно посмотреть проекты ваших домов</label>
                                        </span>
                                        <br>
                                        <span>
                                            <input value="Участки с готовыми домами, я хочу максимально быстро заселиться" name="livetype" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="summerhouse">Участки с готовыми домами, я хочу максимально быстро заселиться</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="stage__checks">
                                        <span>
                                            <input value="Возможность рассрочки или ипотеки" name="technology" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="needconsult">Возможность рассрочки или ипотеки</label>
                                        </span>
                                        <br>
                                        <span>
                                            <input value="Наличие скидок при 100% оплате" name="technology" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label id="needinfo">Наличие скидок при 100% оплате</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block">
                                    <div class="block__title">Имя</div>
                                    <div class="block__input">
                                        <input type="text" name="name" class="input__item">
                                    </div>
                                </div>
                                <div class="form__block block-phone">
                                    <div class="block__title">Ваш номер телефона</div>
                                    <div class="block__input">
                                        <div class="phone__number">+7</div>
                                        <input type="text" name="phone" class="input__item">
                                    </div>
                                </div>
                                <div class="form__btn">
                                    <button type="submit" class="us-btn btn-transparent"><span>Отправить</span></button>
                                </div>
                                <div class="form__block">
                                    <div class="block__response js-response-text"></div>
                                </div>
                            </div>
                            <div class="stages-status">
                                <a href="#" class="status__dot js-status-dot"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <div class="overlay__success js-book-success">Скоро с вами свяжутся наши специалисты<br>для уточнения информации</div>
                </div>
            </div>
        </div>
    </div>
    <div data-name="poll" class="overlay__block block-book js-overlay-block">
        <div class="wrapper">
            <div class="block-cont">
                <div class="book__title js-book-title-with-house">
                    <span>
                        Сделайте поселок лучше
                    </span>
                </div>
                <div class="overlay__form">
                    {{ Form::open(array('id'=>'form-poll','class'=>'js-overlay-form')) }}
                        <div class="form__block">
                            <div class="block__title">Работа охраны</div>
                            <div class="block__input">
                                <textarea name="security" placeholder="Предложите идею, сообщите о проблеме или задайте вопрос"></textarea>
                            </div> 
                        </div>
                        <div class="form__block">
                            <div class="block__title">Работа коммуникаций</div>
                            <div class="block__input">
                                <textarea name="communications" placeholder="Предложите идею, сообщите о проблеме или задайте вопрос"></textarea>
                            </div> 
                        </div>
                        <div class="form__block">
                            <div class="block__title">Состояние детских площадок и общих зон</div>
                            <div class="block__input">
                                <textarea name="rest" placeholder="Предложите идею, сообщите о проблеме или задайте вопрос"></textarea>
                            </div> 
                        </div>
                        <div class="form__block">
                            <div class="block__title">Состояние дорого в послеке</div>
                            <div class="block__input">
                                <textarea name="roads" placeholder="Предложите идею, сообщите о проблеме или задайте вопрос"></textarea>
                            </div> 
                        </div>
                        <div class="form__block">
                            <div class="block__title">Ваш email</div>
                            <div class="block__input">
                                <input type="text" name="email" class="input__item">
                            </div>
                        </div>
                        <div class="form__btn">
                            <button type="submit" class="us-btn btn-transparent"><span>Отправить</span></button>
                        </div>
                    {{ Form::close() }}
                    <div class="overlay__success js-poll-success">Спасибо!<br>Перейти на <a href="{{ URL::to('/') }}">главную</a></div>
                </div>
            </div>
        </div>
    </div>
    <div data-name="call" class="overlay__block block-call js-overlay-block">
        <div class="wrapper"><a href="#" class="block__close js-close-overlay"></a>
            <div class="block-cont">
                <div class="overlay__form">
                    {{ Form::open(array('route'=>'request_call','id'=>'call-form','class'=>'js-overlay-form')) }}
                        <div class="form__block block-phone">
                            <div class="block__title">Ваш номер телефона</div>
                            <div class="block__input">
                                <div class="phone__number">+7</div>
                                {{ Form::text('phone', NULL, array('class'=>'input__item')) }}
                            </div>
                        </div>
                        <div class="form__btn">
                            <button type="submit" class="us-btn btn-transparent"><span>Обратный звонок</span></button>
                        </div>
                        <div class="form__block">
                            <div class="block__response js-response-text">Сообщение</div>
                        </div>
                    {{ Form::close() }}
                    <div class="overlay__success js-call-success">Скоро мы вам перезвоним!</div>
                </div>
            </div>
        </div>
    </div>
    <div data-name="mortgage" class="overlay__block block-call js-overlay-block">
        <div class="wrapper"><a href="#" class="block__close js-close-overlay"></a>
            <div class="block-cont">
                <div class="overlay__form">
                    {{ Form::open(array('route'=>'request_call','id'=>'mortgage-form','class'=>'js-overlay-form')) }}
                        <div class="stages-form form-mortgage js-stages-form">
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Вас интересует:</div>
                                    <div class="stage__checks">
                                        <input value="0" name="request" id="formstage1" type="radio"
                                               class="js-checkbox">
                                        <label for="formstage1">Ипотека Сбербанка</label>
                                        <br>
                                        <input value="1" name="request" id="formstage2" type="radio"
                                               class="js-checkbox">
                                        <label for="formstage2">Рассрочка от застройщика</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Ваш номер телефона</div>
                                    <div class="block__input">
                                        <div class="phone__number">+7</div>
                                        {{ Form::text('phone', NULL, array('class'=>'input__item')) }}
                                    </div>
                                </div>
                                <div class="form__btn">
                                    <button type="submit" class="us-btn btn-transparent"><span>Обратный звонок</span></button>
                                </div>
                                <div class="form__block">
                                    <div class="block__response js-response-text">Сообщение</div>
                                </div>
                            </div>
                            <div class="stages-status">
                                <a href="#" class="status__dot js-status-dot"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <div class="overlay__success js-mortgage-success">Скоро мы вам перезвоним!</div>
                </div>
            </div>
        </div>
    </div>
    @if(0)
    <div data-name="main-poll" class="overlay__block block-poll js-overlay-block">
        <div class="wrapper">
            <div class="block-cont">
                <div class="book__title">
                    <span>
                        Участки без подряда и готовые дома в окружении леса
                        <br>с действующими коммуникациями
                        <br>от 699 000 рублей
                    </span>
                </div>
                <div class="overlay__form">
                        <div class="stages-form form-mortgage js-stages-form">
                            {{ Form::open(array('id'=>'form-main-poll','class'=>'js-overlay-form')) }}
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Я ищу:</div>
                                    <div class="stage__checks">
                                        <input value="0" name="area-type" id="poll9" type="radio"
                                               class="js-checkbox">
                                        <label for="poll9">Участок без подряда в хорошем поселке с коммуникацией</label>
                                        <br>
                                        <input value="1" name="area-type" id="poll10" type="radio"
                                               class="js-checkbox">
                                        <label for="poll10">Участок в коттеджном поселке – построить дом по индивидуальному проекту<br>или выбрать понравившийся вариант проекта</label>
                                        <br>
                                        <input value="2" name="area-type" id="poll11" type="radio"
                                               class="js-checkbox">
                                        <label for="poll11">Уже готовый дом с участком, чтоб все было готово</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block-half">
                                        <div class="block__title">Цена участка, руб</div>
                                        <div class="stage__checks">
                                            <input value="0" name="price" id="poll12" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll12">до 700 000 рублей</label>
                                            <br>
                                            <input value="1" name="price" id="poll13" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll13">до 1 млн рублей</label>
                                            <br>
                                            <input value="2" name="price" id="poll14" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll14">до 1,5 млн рублей</label>
                                            <br>
                                            <input value="3" name="price" id="poll15" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll15">до 2 млн рублей</label>
                                            <br>
                                            <input value="4" name="price" id="poll16" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll16">любая цена</label>
                                        </div>
                                    </div>
                                    <div class="block-half">
                                        <div class="block__title">Площадь участка</div>
                                        <div class="stage__checks">
                                            <input value="0" name="land" id="poll17" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll17">6-7 соток</label>
                                            <br>
                                            <input value="1" name="land" id="poll18" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll18">8-10 соток</label>
                                            <br>
                                            <input value="2" name="land" id="poll19" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll19">11-15 соток</label>
                                            <br>
                                            <input value="3" name="land" id="poll20" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll20">15 соток</label>
                                            <br>
                                            <input value="4" name="land" id="poll21" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll21">любая плошадь</label>
                                        </div>
                                    </div>
                                    <div class="block-half">
                                        <div class="block__title">Окружение</div>
                                        <div class="stage__checks">
                                            <input value="0" name="env" id="poll22" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll22">в лесу</label>
                                            <br>
                                            <input value="1" name="env" id="poll23" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll23">не важно</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block-half">
                                        <div class="block__title">Площадь дома, кв. м:</div>
                                        <div class="stage__checks">
                                            <input value="0" name="area" id="poll1" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll1">До 150 кв. м</label>
                                            <br>
                                            <input value="1" name="area" id="poll2" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll2">50-180 кв. м</label>
                                            <br>
                                            <input value="2" name="area" id="poll3" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll3">180 кв. м</label>
                                            <br>
                                            <input value="3" name="area" id="poll4" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll4">Любая площадь</label>
                                        </div>
                                    </div>
                                    <div class="block-half">
                                        <div class="block__title">Технология строительства</div>
                                        <div class="stage__checks">
                                            <input value="0" name="technology" id="poll5" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll5">Каркасный дом</label>
                                            <br>
                                            <input value="1" name="technology" id="poll6" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll6">Дом из газобетонных блоков</label>
                                            <br>
                                            <input value="2" name="technology" id="poll7" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll7">Оцилиндрованное бревно</label>
                                            <br>
                                            <input value="3" name="technology" id="poll8" type="radio"
                                                   class="js-checkbox">
                                            <label for="poll8">Все технологии, я еще не определился</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                            <form action="/theme/build/json/form.json" class="js-overlay-form" id="form-price">
                            <div class="form__stage js-stage">
                                <div class="form__block">
                                    <div class="block__title">Ваш email</div>
                                    <div class="block__input">
                                        <input type="text" name="email" class="input__item item-email">
                                    </div>
                                </div>
                                <div class="form__btn">
                                    <button type="submit" class="us-btn btn-transparent"><span>Получить прайслист</span></button>
                                </div>
                                <div class="form__btn-desc">
                                    Или перейти к <a href="#" class="js-close-overlay">сайту</a>
                                </div>
                            </div>
                            <div class="stages-status">
                                <a href="#" class="status__dot js-status-dot"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                                <span class="status__line"></span>
                                <a href="#" class="status__dot js-status-dot disabled"></a>
                            </div>
                            </form>
                        </div>
                    <div class="form__stage overlay__success js-poll-mail-success">Прайслист отправлен на ваш email</div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>