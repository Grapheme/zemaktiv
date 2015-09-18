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
            <a href="#" class="block__close js-close-overlay"></a>
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
</div>