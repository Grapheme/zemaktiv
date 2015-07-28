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
Garden.smartHover = function() {
	if(!$('.js-shover').length) return;
	var thisTimeout;
	var active = false;
	var setPosition = function(elem, e, close) {
		clearTimeout(thisTimeout);
		var circle = elem.find('.js-shover-circle');
		var thisY = elem.offset().top/* - $(window).scrollTop()*/;
		var thisX = elem.offset().left/* - $(window).scrollLeft()*/;
		var elemY = e.pageY - thisY;
		var elemX = e.pageX - thisX;
		circle.css({
			top: elemY,
			left: elemX
		});
		if(close) {
			circle.removeClass('active');
		} else {
			circle.removeClass('transition');
			thisTimeout = setTimeout(function(){
				circle.addClass('active transition');
			}, 10);
		}
	}
	$('.js-shover')
		.on('mouseover', function(e){
			var index = $(this).parent().index();
			if(active !== index) {
				setPosition($(this), e);
			}
			active = index;
		})
		.on('mouseout', function(e){
			setPosition($(this), e, true);
			active = false;
		});
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
Garden.infraMap = function() {
	if(!$('#infra-map').length) return;
	ymaps.ready(init);
    var myMap,
    	myPlacemark;

    function init(){     
        myMap = new ymaps.Map("infra-map", {
            center: [55.760768, 37.554879],
            zoom: 14
        });
        myPlacemark = new ymaps.Placemark([55.760768, 37.554879], { content: '2-я Звенигородская улица' });
        myMap.geoObjects.add(myPlacemark);
        myMap.controls	.remove('zoomControl')
					    .remove('searchControl')
					    .remove('typeSelector')
					    .remove('mapTools');
    }
}
Garden.fancybox = function() {
	$('.js-fancybox').fancybox({
		padding: 0
	});
}
Garden.lineGallery = function() {
	var parent = $('.js-line-gallery');
	if(!parent.length) return;
	var activeDir,
		activeSpeed,
		thisTimeout,
		slideLine = parent.find('.js-line'),
		startedSlide = false;
	var slide = function() {
		var amount = activeSpeed/15 * activeDir,
			activeLeft = parseInt(slideLine.css('transform').split(',')[4]),
			fullWidth = 0,
			thisLeft = 0;
		slideLine.children('a').each(function(){
			fullWidth = fullWidth + $(this).width();
		});
		if(fullWidth <= parent.width()) {
			return;
		}
		fullWidth = fullWidth - parent.width();
		if(activeLeft + amount <= 0) {
			if(activeLeft + amount < -fullWidth) {
				thisLeft = -fullWidth;
			} else {
				thisLeft = activeLeft + amount;
			}
		}
		slideLine.css({
			'transform': 'translateX(' + thisLeft + 'px)'
		});
		thisTimeout = setTimeout(function(){
			slide();
		}, 200);
		/* WITHOUT TRANSFORM
		var amount = activeSpeed/25 * activeDir,
			activeLeft = parseInt(slideLine.css('left')),
			fullWidth = 0,
			thisLeft = 0;
		slideLine.children('a').each(function(){
			fullWidth = fullWidth + $(this).width();
		});
		fullWidth = fullWidth - parent.width();
		if(activeLeft + amount <= 0) {
			if(activeLeft + amount < -fullWidth) {
				thisLeft = -fullWidth;
			} else {
				thisLeft = activeLeft + amount;
			}
		}
		slideLine.css({
			'left': thisLeft
		});
		*/
	}
	var stopSlide = function() {
		clearTimeout(thisTimeout);
		startedSlide = false;
	}
	var hover = function(e) {
		var middle = parent.width() / 2;
		activeSpeed = Math.abs(e.pageX - middle);
		if(e.pageX > middle) {
			activeDir = -1;
		} else {
			activeDir = 1;
		}
	}
	parent.on('mousemove', function(e){
		hover(e);
		if(!startedSlide) {
			startedSlide = true;
			slide();
		}
	});
	parent.on('mouseleave', function(){
		stopSlide();
	});
}
Garden.init = function() {
	this.header();
	this.indexSlider();
	this.ymap();
	this.autosize();
	this.contactForm();
	this.infraMap();
	this.fancybox();
	this.lineGallery();
	//this.smartHover();
}
$(function(){
	Garden.init();
});