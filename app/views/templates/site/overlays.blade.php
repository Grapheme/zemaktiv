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
                <div class="book__title"><span>Участок №<span class="js-book-number"></span>, <span class="js-book-line"></span>-ая очередь, <span class="js-book-area"></span> соток</span></div>
                <div class="overlay__form">
                    <form id="book-form" class="js-overlay-form" action="theme/build/json/form.json">
                        <input type="hidden" name="id" class="js-input-book-id">

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
                    </form>
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
</div>