window.Help = {};
window.Garden = {};
window.Dictionary = window.Dictionary || {};
Dictionary.gardenPos = [55.04122958, 37.35616642];
Dictionary.mkadPos = [55.577007, 37.589141];
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
	var activeId = false;
	var show = function(id) {
		activeId = id;
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
	var autoPlay = function() {
		var nextId = 0;
		if(activeId !== false) {
			nextId = activeId + 1;
		}
		if(nextId == slides.length) {
			nextId = 0;
		}
		show(nextId);
		setTimeout(function(){
			autoPlay();
		}, 7000);
	}
	var init = function() {
		for(var i = 0; i < slides.length; i++) {
			dotsDiv.append('<li class="js-dot"></li>');
		}
		//show(0);
		autoPlay();
		$('.js-dot').on('click', function(){
			show($(this).index());
			return false;
		});
	}
	init();
}
Garden.indexLines = function() {
	var activeId = false;
	var setActive = function(id) {
		$('.js-inside-slide').eq(id).addClass('active').siblings().removeClass('active');
		$('.js-inside-slide').eq(id).prev().addClass('bottom').siblings().removeClass('bottom');
	}
	var show = function(id) {
		activeId = id;
		if(id == 0) {
			$('.js-inside-slide').last().addClass('bottom')
			setTimeout(function(){
				$('.js-inside-slide').removeClass('transition active bottom');
				setTimeout(function(){
					$('.js-inside-slide').addClass('transition');
					setActive(id);
				}, 50);
			}, 500);
		} else {
			setActive(id);
		}
	}
	var autoPlay = function() {
		var nextId = 0;
		var time = 5000;
		if(activeId !== false) {
			nextId = activeId + 1;
		}
		if(nextId == $('.js-inside-slide').length) {
			nextId = 0;
			time = time + 500;
		}
		show(nextId);
		setTimeout(function(){
			autoPlay();
		}, time);
	}
	autoPlay();
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
Garden.overlayForms = function() {
	var forms = $('.js-overlay-form');
	forms.filter('#call-form').validate({
	    rules: {
	        phone: {
	            required: true
	        }
	    },
	    submitHandler: function(form) {
	        Help.ajaxSubmit(form, {
	            success: function() {
	                $(form).slideUp();
	                $('.js-call-success').slideDown();
	                setTimeout(function(){
	                	Garden.overlays.close();
	                }, 1500);
	            }
	        });
	        return false;
	    }
	});
	forms.filter('#book-form').validate({
	    rules: {
	        name: {
	            required: true
	        },
	        email: {
	        	required: true,
	        	email: true
	        }
	    },
	    submitHandler: function(form) {
	        Help.ajaxSubmit(form, {
	            success: function() {
	                $(form).slideUp();
	                $('.js-book-success').slideDown();
	                setTimeout(function(){
	                	Garden.overlays.close();
	                }, 3000);
	            }
	        });
	        return false;
	    }
	});
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
    	myPlacemark,
    	placemarks = {};
    function init(){
        myMap = new ymaps.Map("infra-map", {
            center: Dictionary.gardenPos,
            zoom: 14
        });
        myPlacemark = new ymaps.Placemark([55.760768, 37.554879], { content: '2-я Звенигородская улица' });
        myMap.geoObjects.add(myPlacemark);
        myMap.controls	.add('zoomControl'
        						/*{
        							float: 'none',
    							    position: {
										right: 500,
										top: 5,
										left: 'auto'
									}
        						}*/)
					    .remove('searchControl')
					    .remove('typeSelector')
					    .remove('mapTools');

	    var BalloonLayout = ymaps.templateLayoutFactory.createClass(
	        '<div class="ymaps-discount-balloon"><a href="#" class="balloon-close"></a>$[[options.contentLayout]]</div>', {
	            build: function(e) {
	                this.constructor.superclass.build.call(this);
	                this._$element = $('.ymaps-discount-balloon', this.getParentElement());
	                this._$element_inner = $('.map-ballon');
	                this.applyElementOffset();
	                this._$element.find('.balloon__close').on('click', $.proxy(this.onCloseClick, this));
	            },
	            applyElementOffset: function() {
	                this._$element.css({
	                    left: -(this._$element_inner[0].offsetWidth / 2),
	                    top: -(this._$element_inner[0].offsetHeight)
	                });
	            },
	            onCloseClick: function (e) {
	                e.preventDefault();
	                this.events.fire('userclose');
	            },
	            clear: function() {
	                this.constructor.superclass.clear.call(this);
	            }
	        });
	    var BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
	        '<div class="map-ballon">\
	        	<a class="balloon__close"></a>\
	        	<div class="ballon__header">\
	        		<span class="ballon__img"><img src="{{properties.image}}"></span>\
	        		<span class="ballon__title">{{properties.title}}</span>\
	        	</div>\
	        	<div class="ballon__desc">{{properties.desc}}</div>\
	        </div>');
	    var i = 0;
	    $('.js-balloon-item').each(function(){
	    	var placemark = new ymaps.Placemark([$(this).attr('data-longitude'), $(this).attr('data-latitude')], {
	    	        image: $(this).attr('data-image'),
	    	        title: $(this).attr('data-title'),
	    	        desc: $(this).attr('data-desc')
	    	    }, {
	    	        balloonLayout: BalloonLayout,
	    	        balloonContentLayout: BalloonContentLayout,
	    	        balloonPanelMaxMapArea: 0,
	    	        balloonMaxWidth: 300,
	    	        iconLayout: 'default#image',
	    	        iconImageHref: '/theme/build/images/mark.png',
	    	        iconImageSize: [25, 35],
	    	        iconImageOffset: [-12.5, -35]
	    	    });
	    	var $this = $(this);
	    	$this.attr('data-balloon-id', i);
	    	placemarks[i] = {
	    		block: $this,
	    		mark: placemark
	    	};
	    	myMap.geoObjects.add(placemark);
	    	i++;
	    });
		$('.js-balloon-item').on('click', function(){
			var balloonId = $(this).attr('data-balloon-id');
			placemarks[balloonId].mark.balloon.open();
		});
    }
}
Garden.locationMap = function() {
	if(!$('#location-map').length) return;
	ymaps.ready(init);
    var myMap,
    	myPlacemark,
    	multiRouteModel,
    	multiRouteView;

    function init(){
    	myMap = new ymaps.Map("location-map", {
    	    center: Dictionary.gardenPos,
    	    zoom: 14
    	});     
		multiRouteModel = new ymaps.multiRouter.MultiRouteModel(['Россия, Москва, МКАД, 31-й километр', '', 'Россия, Московская область, Серпуховский район, коттеджный посёлок Вяземские сады'], {
		    avoidTrafficJams: false,
		    viaIndexes: [1],
		});
		multiRouteView = new ymaps.multiRouter.MultiRoute(multiRouteModel);
		myMap.geoObjects.add(multiRouteView);
        myMap.controls	.remove('searchControl')
					    .remove('typeSelector')
					    .remove('mapTools');
    }
    function showBusWay() {
    	multiRouteModel.setParams({ routingMode: 'masstransit' }, true);
    }
    function showCarWay() {
    	multiRouteModel.setParams({ routingMode: 'auto' }, true);
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
		//setMapCenter();
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
			console.log(thisObj.sold);
			if(thisObj.sold == 0) {
				self.tooltip.find('.js-bbtn').show();
			} else {
				self.tooltip.find('.js-bbtn').hide();
			}
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
			var soldStr = value.sold == 1 ? ' sold' : '';
			$('.js-map').append('<a class="image__mark js-mark' + soldStr + '" data-id="' + value.id + '" style="left: ' + value.coordinate_x/16 + 'rem; top: ' + value.coordinate_y/16 + 'rem;"></a>');
		});
	}
	var filter = function() {
		$('#range-price').slider({
			range: true,
			min: prices.min,
			max: prices.max,
			values: [prices.min, prices.max],
			slide: function(event, ui) {
				$('.js-price-from').text(ui.values[ 0 ].formatMoney());
				$('.js-price-to').text(ui.values[ 1 ].formatMoney());
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
		$('.js-price-from').text($('#range-price').slider('values', 0).formatMoney());
		$('.js-price-to').text($('#range-price').slider('values', 1).formatMoney());
		$('.js-area-from').text($('#range-area').slider('values', 0));
		$('.js-area-to').text($('#range-area').slider('values', 1));
		$('[name="pricefrom"]').val($('#range-price').slider('values', 0));
		$('[name="priceto"]').val($('#range-price').slider('values', 1));
		$('[name="areafrom"]').val($('#range-area').slider('values', 0));
		$('[name="areato"]').val($('#range-area').slider('values', 1));
	}
	var showMap = function() {
		$('.js-choise-filter').fadeOut();
		$('.js-show-filter, .js-map-title').fadeIn();
		return false;
	}
	var showFilter = function() {
		$('.js-choise-filter').fadeIn();
		$('.js-show-filter, .js-map-title').fadeOut();
		tooltip.close();
		return false;
	}
	var mapTabs = function() {
		$('.js-show-map').on('click', showMap);
		$('.js-show-filter').on('click', showFilter);
		showFilter();
	}
	var lines = {
		activeLine: false,
		setActive: function(number) {
			activeLine = number;
			$('.js-choice-center').attr('data-number', number);
			if(number == 1) {
				$('.js-choice-left').attr('disabled', 'disabled');
			} else {
				$('.js-choice-left').attr('data-number', number - 1);
				$('.js-choice-left').removeAttr('disabled');
			}
			if(number == 3) {
				$('.js-choice-right').attr('disabled', 'disabled');
			} else {
				$('.js-choice-right').attr('data-number', number + 1);
				$('.js-choice-right').removeAttr('disabled');
			}
		},
		setCenter: function(number) {
			var thisBlock = $('.js-line-' + number);
			var thisX = thisBlock.position().left + thisBlock.width() / 2;
			var thisY = thisBlock.position().top + thisBlock.height() / 2;
			setMapCenter(thisX, thisY);
		},
		init: function() {
			var self = this;
			if(!Dictionary.buildings[window.location.hash.substr(1)]) {
				self.setActive(1);
				self.setCenter(1);
			}
			$('.js-choice-left').on('click', function(){
				if($(this).attr('disabled') == 'disabled') return;
				var thisNum = parseInt($(this).attr('data-number'));
				self.setActive(thisNum);
				self.setCenter(thisNum);
				return false;
			});
			$('.js-choice-right').on('click', function(){
				if($(this).attr('disabled') == 'disabled') return;
				var thisNum = parseInt($(this).attr('data-number'));
				self.setActive(thisNum);
				self.setCenter(thisNum);
				return false;
			});
		}
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
	var submitFilter = function(form, noscroll) {
		var inputs = form.serialize().split('&');
		var params = {};
		$.each(inputs, function(i, v){
			var iArray = v.split('=');
			params[iArray[0]] = iArray[1] || false;
		});
		showSuited(params);
		$('.js-filter-list').slideDown(300);
		if(!noscroll) {
			setTimeout(function(){
				$('.js-choise-filter').animate({
					scrollTop: $('.js-filter-list').position().top
				}, 300);
				$('html, body').animate({
					scrollTop: $('.js-choise-filter').offset().top - 100
				}, 300);
			}, 150);
		}
	}
	var filterForm = function() {
		$('.js-filter-form').on('submit', function(e){
			e.preventDefault();
			submitFilter($(this));
		});
		$(document).on('click', '.js-filter-item', function(){
			var thisId = $(this).attr('data-id');
			showMap();
			tooltip.show(thisId);
			$('html, body').animate({
				scrollTop: $('.js-choise-wrapper').offset().top - 100
			});
		});
		var checks = {
			withHouse: false,
			withWork: false,
			withOutWork: false
		};
		$.each(Dictionary.buildings, function(i, v){
			if(v.status == 0) checks.withOutWork = true;
			if(v.status == 1) checks.withWork = true;
			if(v.status == 2) checks.withHouse = true;
		});
		if(!checks.withOutWork) {
			$('[name="withoutpod"]').parent().hide();
		}
		if(!checks.withWork) {
			$('[name="withpod"]').parent().hide();
		}
		if(!checks.withHouse) {
			$('[name="withhouse"]').parent().hide();
		}
		var thisHash = window.location.hash.substr(1);
		if(thisHash != '' && Dictionary.buildings[thisHash]) {
			showMap();
			tooltip.show(thisHash);
		}
	}
	var init = function() {
		$('.js-map').addClass('active transition');
		move();
		setMarks();
		tooltip.init();
		filter();
		mapTabs();
		filterForm();
		submitFilter($('.js-filter-form'), true);
		lines.init();
	}
	init();
}
Garden.book = function() {
	$(document).on('click', '.js-book', function(){
		var houseId = $(this).attr('data-id');
		var input = $('.js-input-book-id');
		var thisObj = Dictionary.buildings[houseId];
		input.val(houseId);
		$('.js-book-number').text(thisObj.number);
		$('.js-book-line').text(thisObj.turn);
		$('.js-book-area').text(thisObj.land_area);
		Garden.overlays.open('book');
		console.log(thisObj);
		return false;
	});
}
Garden.overlays = {
	open: function(name) {
		$('.js-overlay').show();
		$('.js-overlay-block[data-name="' + name + '"]').fadeIn()
			.siblings().fadeOut();
	},
	close: function() {
		$('.js-overlay').fadeOut(function(){
			$('.js-overlay-block').hide();
		});
	},
	init: function() {
		var self = this;
		$('.js-open-overlay').on('click', function(){
			self.open($(this).attr('data-open'));
			return false;
		});
		$('.js-close-overlay').on('click', function(){
			self.close();
			return false;
		});
	}
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
	this.overlays.init();
	this.locationMap();
	this.indexLines();
	this.book();
	this.overlayForms();
	//this.speedUp();
	//this.smartHover();
}
$(function(){
	Garden.init();
});