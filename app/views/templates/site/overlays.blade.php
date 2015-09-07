<?
/**
 * TEMPLATE_IS_NOT_SETTABLE
 */
?>
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
                    <div class="book__title js-book-title-with-house">
                        <span>
                            Получить больше информации
                        </span>
                    </div>
                </div>
                <div class="overlay__form">
                    {{ Form::open(array('route'=>'request_bron','id'=>'book-form','class'=>'js-overlay-form')) }}
                        {{ Form::hidden('id',NULL,array('class'=>'js-input-book-id')) }}
                        <div class="stages-form form-book js-stages-form">
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Вас интересует:</div>
                                    <div class="stage__checks">
                                        <div class="checks__title">Период проживания</div>
                                        <span>
                                            <input value="0" name="livetype" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label>Дом для постоянного проживания</label>
                                        </span>
                                        <span>
                                            <input value="1" name="livetype" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label>Летний дом, дача</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Вас интересует:</div>
                                    <div class="stage__checks">
                                        <div class="checks__title">Технология строительства</div>
                                        <span>
                                            <input value="0" name="technology" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label>Строительные конструкции</label>
                                        </span>
                                        <span>
                                            <input value="1" name="technology" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label>Комплектация домов</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Вас интересует</div>
                                    <div class="stage__checks">
                                        <div class="checks__title">Цена:</div>
                                        <span>
                                            <input value="0" name="price" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label>Купить дом и участок в рассрочку</label>
                                        </span>
                                        <span>
                                            <input value="1" name="price" type="radio"
                                                   class="js-checkbox js-set-for" autocomplete="off">
                                            <label>Наличие скидки при 100% оплате</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form__stage js-stage">
                                <div class="form__block block-phone">
                                    <div class="block__title">Ваш номер телефона</div>
                                    <div class="block__input">
                                        <div class="phone__number">+7</div>
                                        <input type="text" name="phone" class="input__item">
                                    </div>
                                </div>
                                <div class="form__block">
                                    <div class="block__title">Имя</div>
                                    <div class="block__input">
                                        <input type="text" name="name" class="input__item">
                                    </div>
                                </div>
                                <div class="form__block">
                                    <div class="block__title">Почта</div>
                                    <div class="block__input">
                                        <input type="text" name="email" class="input__item">
                                    </div>
                                </div>
                                <div class="form__btn">
                                    <button type="submit" class="us-btn btn-transparent"><span>Забронировать</span></button>
                                </div>
                                <div class="form__block">
                                    <div class="block__response js-response-text">Сообщение</div>
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
                        </div>
                    {{ Form::close() }}
                    <div class="overlay__success js-book-success">Скоро с вами свяжутся наши специалисты<br>для уточнения информации</div>
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