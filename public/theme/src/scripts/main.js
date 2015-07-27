window.Help = {};
window.Garden = {};
Help.ajaxSubmit = function(form, callbacks) {
    var response_cont = $(form).find('.js-response-text'),
        options = { 
        beforeSubmit: function(){
            response_cont.hide();
            $(form).find('[type="submit"]').addClass('loading')
                .attr('disabled', 'disabled');
        }, 
        success: function(data){
            if(data.status && data.redirect && data.redirect != '') {
                window.location.href = data.redirect;
            }
            if(callbacks && callbacks.success && data.status) {
                callbacks.success(data);
            }
            if(data.responseText) {
            	response_cont.show().text(data.responseText);
            }
            $(form).find('[type="submit"]').removeClass('loading')
                .removeAttr('disabled');
        },
        error: function(data) {
            response_cont.show().text('Ошибка на сервере, попробуйте позже');
            $(form).find('[type="submit"]').removeClass('loading')
                .removeAttr('disabled');
        }
    };
    $(form).ajaxSubmit(options);
}
Garden.header = function() {
	var headerStatus;
	var setHeader = function() {
		if($(window).scrollTop() >= 110) {
			if(headerStatus != 'min') {
				$('.js-header, .js-main').addClass('header-min');
				headerStatus = 'min';
			}
		} else {
			if(headerStatus != 'big') {
				$('.js-header, .js-main').removeClass('header-min');
				headerStatus = 'big';
			}
		}
	}
	$(window).on('scroll', setHeader);
	setHeader();
}
Garden.indexSlider = function() {
	if(!$('.js-index-slider').length) return;
	var parent = $('.js-index-slider');
	var slides = parent.find('.js-slide');
	var dotsDiv = parent.find('.js-dots');
	var zTimeout;
	var show = function(id) {
		$.each([slides, dotsDiv.find('.js-dot')], function(index, value){
			value.eq(id).addClass('active')
				.siblings().removeClass('active');
		});
		clearTimeout(zTimeout);
		zTimeout = setTimeout(function(){
			slides.eq(id).addClass('zActive')
				.siblings().removeClass('zActive');
		}, 500);
	}
	var init = function() {
		for(var i = 0; i < slides.length; i++) {
			dotsDiv.append('<li class="js-dot"></li>');
		}
		show(0);
		$('.js-dot').on('click', function(){
			show($(this).index());
			return false;
		});
	}
	init();
}
Garden.autosize = function() {
	if($('.js-autosize').length) {
		autosize($('.js-autosize'));
	}
}
Garden.contactForm = function() {
	if(!$('.js-contact-form').length) return;
	var form = $('.js-contact-form');
	form.validate({
	    rules: {
	        name: {
	            required: true
	        },
	        email: {
	            required: true,
	            email: true
	        },
	        message: {
	            required: true
	        },
	    },
	    submitHandler: function(form) {
	        Help.ajaxSubmit(form, {
	            success: function() {
	                $(form).slideUp();
	                $('.js-contact-success').slideDown();
	            }
	        });
	        return false;
	    }
	});
}
Garden.ymap = function() {
	if(!$('#contact-map').length) return;
	ymaps.ready(init);
    var myMap,
    	myPlacemark;

    function init(){     
        myMap = new ymaps.Map("contact-map", {
            center: [55.760768, 37.554879],
            zoom: 16
        });
        myPlacemark = new ymaps.Placemark([55.760768, 37.554879], { content: '2-я Звенигородская улица' });
        myMap.geoObjects.add(myPlacemark);
    }
}
Garden.init = function() {
	this.header();
	this.indexSlider();
	this.ymap();
	this.autosize();
	this.contactForm();
}
$(function(){
	Garden.init();
});