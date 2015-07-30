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
		if(!$('.js-header').hasClass('transition')) {
			setTimeout(function(){
				$('.js-header').addClass('transition');
			}, 10);
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
Garden.speedUp = function() {
	var body = $('body'),
	    timer;
	$(window).on('scroll', function() {
		clearTimeout(timer);
		if(!body.hasClass('disable-hover')) {
			body.addClass('disable-hover');
		}
		timer = setTimeout(function(){
			body.removeClass('disable-hover');
		}, 200);
	});
}
Garden.map = function() {
	if(!$('.js-choise-wrapper').length) return;
	var map = $('.js-map');
	var mapCont = $('.js-map-container');
	var cursorPos = [];
	var mapPos = [];
	var prices = {
		min: false,
		max: 0
	};
	var areas = {
		min: false,
		max: 0
	};
	var setMapPos = function(x, y) {
		if(x > 0) x = 0;
		if(y > 0) y = 0;
		if(x < -(map.width() - mapCont.width())) x = -(map.width() - mapCont.width());
		if(y < -(map.height() - mapCont.height())) y = -(map.height() - mapCont.height());
		map.css('transform', 'translate(' + x + 'px, ' + y + 'px)');
	}
	var setMapCenter = function(newx, newy) {
		if(newx && newy) {
			var centerx = newx,
				centery = newy;
		} else {
			var centerx = map.width()/2,
				centery = map.height()/2;
			map.addClass('active');
			setTimeout(function(){
				map.addClass('transition');
			}, 100);
		}
		var x = -(centerx - mapCont.width() / 2),
			y = -(centery - mapCont.height() / 2);
		setMapPos(x, y);
	}
	var move = function() {
		var moveMap = function(pageX, pageY) {
			var xDiff = pageX - cursorPos[0],
				yDiff = pageY - cursorPos[1],
				xNew = xDiff + mapPos[0],
				yNew = yDiff + mapPos[1];
			setMapPos(xNew, yNew);
		}
		var mousedown = false;
		map.on('mousedown', function(e){
			mousedown = true;
			cursorPos = [e.pageX, e.pageY]
			mapX = parseInt(map.css('transform').split(',')[4]);
			mapY = parseInt(map.css('transform').split(',')[5]);
			mapPos = [mapX, mapY];
		});
		$(document).on('mousemove', function(e){
			if(mousedown) {
				moveMap(e.pageX, e.pageY);
				return false;
			}
		});
		$(document).on('mouseup', function(){
			mousedown = false;
		});
		setMapCenter();
	}
	var tooltip = {
		tooltip: $('.js-tooltip'),
		closeTimeout: false,
		activeId: false,
		close: function() {
			var self = this;
			self.activeId = false;
			self.tooltip.removeClass('active');
			self.closeTimeout = setTimeout(function(){
				self.tooltip.removeClass('transition').hide();
			}, 500);
		},
		show: function(id) {
			var self = this;
			clearTimeout(self.closeTimeout);
			if(id === self.activeId) return;
			self.activeId = id;
			var thisObj = Dictionary.buildings[id];
			self.tooltip.find('.js-bnum').text(thisObj.number);
			self.tooltip.find('.js-bturn').text(thisObj.turn);
			self.tooltip.find('.js-bprice').text(thisObj.price.formatMoney(2));
			self.tooltip.find('.js-bcont').text(numToContract(thisObj.status));
			self.tooltip.find('.js-barea').text(thisObj.land_area);
			self.tooltip.find('.js-book').attr('data-id', thisObj.id);
			var thisMark = $('.js-mark[data-id="' + id + '"]');
			var markPos = thisMark.position();
			setMapCenter(markPos.left, markPos.top - (mapCont.height()/100)*20);
			self.tooltip.hide().removeClass('transition active');
			self.tooltip.css({
				left: markPos.left,
				bottom: $('.js-map').height() - markPos.top
			}).show();
			setTimeout(function(){
				self.tooltip.addClass('transition active');
			}, 10);
		},
		init: function() {
			var self = this;
			$(document).on('click', '.js-mark', function(){
				var thisId = $(this).attr('data-id');
				self.show(thisId);
				return false;
			});
			$(document).on('click', '.js-tooltip .js-close', function(){
				self.close();
				return false;
			});
		}
	}
	var setMarks = function() {
		$.each(Dictionary.buildings, function(index, value){
			if(value.price > prices.max) prices.max = value.price;
			if(value.price < prices.min || prices.min === false) prices.min = value.price;
			if(value.land_area > areas.max) areas.max = value.land_area;
			if(value.land_area < areas.min || areas.min === false) areas.min = value.land_area;
			$('.js-map').append('<a class="image__mark js-mark" data-id="' + value.id + '" style="left: ' + value.coordinate_x + 'px; top: ' + value.coordinate_y + 'px;"></a>');
		});
	}
	var filter = function() {
		$('#range-price').slider({
			range: true,
			min: prices.min,
			max: prices.max,
			values: [prices.min, prices.max],
			slide: function(event, ui) {
				$('.js-price-from').text(ui.values[ 0 ]);
				$('.js-price-to').text(ui.values[ 1 ]);
				$('[name="pricefrom"]').val(ui.values[ 0 ]);
				$('[name="priceto"]').val(ui.values[ 1 ]);
			}
		});
		$('#range-area').slider({
			range: true,
			min: areas.min,
			max: areas.max,
			values: [areas.min, areas.max],
			slide: function(event, ui) {
				$('.js-area-from').text(ui.values[ 0 ]);
				$('.js-area-to').text(ui.values[ 1 ]);
				$('[name="areafrom"]').val(ui.values[ 0 ]);
				$('[name="areato"]').val(ui.values[ 1 ]);
			}
		});
		$('.js-price-from').text($('#range-price').slider('values', 0));
		$('.js-price-to').text($('#range-price').slider('values', 1));
		$('.js-area-from').text($('#range-area').slider('values', 0));
		$('.js-area-to').text($('#range-area').slider('values', 1));
		$('[name="pricefrom"]').val($('#range-price').slider('values', 0));
		$('[name="priceto"]').val($('#range-price').slider('values', 1));
		$('[name="areafrom"]').val($('#range-area').slider('values', 0));
		$('[name="areato"]').val($('#range-area').slider('values', 1));
	}
	var showMap = function() {
		$('.js-choise-filter').fadeOut();
		$('.js-show-filter').fadeIn();
		return false;
	}
	var showFilter = function() {
		$('.js-choise-filter').fadeIn();
		$('.js-show-filter').fadeOut();
		return false;
	}
	var mapTabs = function() {
		$('.js-show-map').on('click', showMap);
		$('.js-show-filter').on('click', showFilter);
		showFilter();
	}
	var showSuited = function(params) {
		var suitedArray = {};
		$.each(Dictionary.buildings, function(i, v){
			var suited = true;
			if(!(	
				(params.withhouse && v.status == 2)||
				(params.withpod && v.status == 1)||
				(params.withoutpod && v.status == 0))) {
				suited = false;
			}
			if(v.price < params.pricefrom || v.price > params.priceto) {
				suited = false;
			}
			if(v.land_area < params.areafrom || v.land_area > params.areato) {
				suited = false;
			}
			if(suited) {
				suitedArray[i] = v;
			}
		});
		var html = [];
		var count = 0;
		$.each(suitedArray, function(i, v){
			html.push('<li class="body__item js-filter-item" data-id="' + v.id + '"><div class="wrapper"><span>' + v.number + '</span><span>' + v.turn + '</span><span>' + v.land_area + '</span><span>' + numToContract(v.status) + '</span><span>' + v.price.formatMoney() + '</span></div></li>');
			count++;
		});
		if(count != 0) {
			$('.js-filter-items').html(html.join(''));
		} else {
			$('.js-filter-items').html('<li class="body__item nothing-found">К сожалению по заданым параметрам ничего не нашлось</li>');
		}
	}
	var filterForm = function() {
		$('.js-filter-form').on('submit', function(e){
			e.preventDefault();
			var inputs = $(this).serialize().split('&');
			var params = {};
			$.each(inputs, function(i, v){
				var iArray = v.split('=');
				params[iArray[0]] = iArray[1] || false;
			});
			showSuited(params);
			$('.js-filter-list').slideDown(300);
			setTimeout(function(){
				$('html, body').animate({
					scrollTop: $('.js-filter-list').offset().top
				}, 300);
			}, 150);
		});
		$(document).on('click', '.js-filter-item', function(){
			var thisId = $(this).attr('data-id');
			showMap();
			tooltip.show(thisId);
		});
	}
	var init = function() {
		move();
		setMarks();
		tooltip.init();
		filter();
		mapTabs();
		filterForm();
	}
	init();
}
Garden.checkbox = function() {
	$('.js-checkbox').button();
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
	this.map();
	this.checkbox();
	//this.speedUp();
	//this.smartHover();
}
$(function(){
	Garden.init();
});