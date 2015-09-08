window.Help = {};
window.Garden = {};
window.Dictionary = window.Dictionary || {};
Dictionary.gardenPos = [55.04122958, 37.35616642];
Dictionary.mkadPos = [55.577007, 37.589141];
Dictionary.zoomOptions = {
	options: {
	    position: {
	    	left: 'auto',
	    	right: '43rem',
	    	top: '3rem'
	    }
	}
};
Help.getHash = function(index, str) {
	if(str) {
		var thisHash = str;
	} else {
		var thisHash = window.location.hash.substr(1);
	}
	if(thisHash == '') {
		return false;
	}
	var hashParts = thisHash.split('&');
	var hashVal = {};
	$.each(hashParts, function(index, value){
		var sValue = value.split('=');
		hashVal[sValue[0]] = sValue[1];
	});
	if(index) {
		return hashVal[index];
	} else {
		return hashVal;
	}
}
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
	forms.filter('#mortgage-form').validate({
	    rules: {
	        phone: {
	            required: true
	        }
	    },
	    submitHandler: function(form) {
	        Help.ajaxSubmit(form, {
	            success: function() {
	                $(form).slideUp();
	                $('.js-mortgage-success').slideDown();
	                setTimeout(function(){
	                	Garden.overlays.close();
	                }, 1500);
	                //dataLayer.push({'event': 'CallBackFormSend'});
	            }
	        });
	        return false;
	    }
	});
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
	                dataLayer.push({'event': 'CallBackFormSend'});
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
	        phone: {
	        	required: true
	        }
	    },
	    submitHandler: function(form) {
	    		var landObj = Dictionary.buildings[$(form).find('[name="id"]').val()];
	    		console.log(landObj);
	    		if(landObj) {
	    			var landNumber = landObj.number;
	    			dataLayer.push({'event': 'ReserveFormSend', 'landId': landNumber});
	    		} else {
	    			var landNumber = 0;
	    		}
	        Help.ajaxSubmit(form, {
	            success: function() {
	            	bookSubmitEvent();
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
	    		dataLayer.push({'event': 'ContactFormSend'});
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
            center: [55.76135, 37.551708],
            zoom: 16
        });
        myPlacemark = new ymaps.Placemark([55.76135, 37.551708], { content: '2-я Звенигородская улица' });
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
            zoom: 13,
            controls: []
        });
        var zoomControl = new ymaps.control.ZoomControl(Dictionary.zoomOptions);
        myMap.controls.add(zoomControl);
        myMap.behaviors.disable("scrollZoom")
        myMap.controls	.remove('searchControl')
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
	    	var placemark = new ymaps.Placemark([parseFloat($(this).attr('data-longitude')), parseFloat($(this).attr('data-latitude'))], {
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
	    var locationMark = new ymaps.Placemark(Dictionary.gardenPos, {}, {
			iconLayout: 'default#image',
			iconImageHref: '/theme/build/images/header/apple_min.png',
			iconImageSize: [32, 36],
			iconImageOffset: [-16, -18]
		});
		myMap.geoObjects.add(locationMark);
		$('.js-balloon-item').on('click', function(){
			var balloonId = $(this).attr('data-balloon-id');
			//myMap.setCenter();
			var thisCoordinates = placemarks[balloonId].mark.geometry.getCoordinates();
			myMap.panTo(thisCoordinates, {
	            delay: 1500
	        });
			placemarks[balloonId].mark.balloon.open();
		});
    }
}
Garden.locationMap = function() {
	if(!$('#location-map').length) return;
	ymaps.ready(init);
    var myMap,
    	myPlacemark,
    	routeModel = [],
    	routeViews = [];

    function init(){
    	myMap = new ymaps.Map("location-map", {
    	    center: Dictionary.gardenPos,
    	    zoom: 14,
    	    controls: []
    	});
    	var zoomControl = new ymaps.control.ZoomControl(Dictionary.zoomOptions);
    	myMap.controls.add(zoomControl);
    	myMap.behaviors.disable("scrollZoom")
		routeModel[0] = new ymaps.multiRouter.MultiRouteModel(['Россия, Москва, МКАД, 31-й километр', 'Россия, Московская область, Серпуховский район, коттеджный посёлок Вяземские сады'], {
		    avoidTrafficJams: false
		});
		routeModel[1] = new ymaps.multiRouter.MultiRouteModel(['Россия, Москва, МКАД, 31-й километр', [55.029864, 37.467662], 'Россия, Московская область, Серпуховский район, коттеджный посёлок Вяземские сады'], {
		    avoidTrafficJams: false
		});
		routeViews[0] = new ymaps.multiRouter.MultiRoute(routeModel[0], {
			wayPointDraggable: true,
	        boundsAutoApply: true
		});
		routeViews[1] = new ymaps.multiRouter.MultiRoute(routeModel[1], {
			wayPointDraggable: true,
	        boundsAutoApply: true
		});
		//myMap.geoObjects.add(routeViews[1]);
        myMap.controls	.remove('searchControl')
					    .remove('typeSelector')
					    .remove('mapTools');
		$('.js-way-btn').on('click', function(){
			showWay($(this).index());
			return false;
		});
		showWay(0);
    }
    function showWay(index) {
    	$('.js-way-btn').eq(index).addClass('active')
    		.siblings().removeClass('active');
    	$.each(routeViews, function(i, v){
    		if(i != index) {
    			myMap.geoObjects.remove(routeViews[i]);
    		}
    	});
    	myMap.geoObjects.add(routeViews[index]);
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
	var map = $('.js-map'),
		mapCont = $('.js-map-container'),
		cursorPos = [],
		mapPos = [],
		prices,
		areas,
		suitedArray = {},
		filterParams,
		transitionTimeout;
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
			/*setTimeout(function(){
				map.addClass('transition');
			}, 100);*/
		}
		var x = -(centerx - mapCont.width() / 2),
			y = -(centery - mapCont.height() / 2);
		setMapPos(x, y);
	}
	var setMapCenterAnim = function(x, y) {
		clearTimeout(transitionTimeout);
		map.addClass('transition');
		setTimeout(function(){
			setMapCenter(x, y);
		}, 20);
		transitionTimeout = setTimeout(function(){
			map.removeClass('transition');
		}, 320);
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
			var thisObj = Dictionary.buildingsAll[id];
			self.tooltip.attr('data-id', id);
			self.tooltip.find('.js-bnum').text(thisObj.number);
			self.tooltip.find('.js-bturn').text(thisObj.turn);
			if(parseInt(thisObj.price_total) == 0 || !thisObj.price_total) {
				self.tooltip.find('.js-bprice').text(thisObj.price.formatMoney(2));
			} else {
				self.tooltip.find('.js-bprice').text(thisObj.price_total.formatMoney(2));
			}
			self.tooltip.find('.js-bcont').text(numToContract(thisObj.status));
			self.tooltip.find('.js-barea').text(thisObj.land_area);
			self.tooltip.find('.js-book').attr('data-id', thisObj.id);
			if(thisObj.sold == 0) {
				self.tooltip.find('.js-not-sold-block').show();
				self.tooltip.find('.js-sold-block').hide();
				self.tooltip.find('.js-favorite').show();
			} else {
				self.tooltip.find('.js-not-sold-block').hide();
				self.tooltip.find('.js-sold-block').show();
				self.tooltip.find('.js-favorite').hide();
			}
			if($.cookie('favorite-areas')) {
				var favoriteData = JSON.parse($.cookie('favorite-areas'));
				var isFavorite = false;
				$.each(favoriteData, function(i){
					if(id == i) {
						self.tooltip.find('.js-favorite').addClass('active').attr('title', 'Убрать из избранного');
					}
				});
			}
			var thisMark = $('.js-mark[data-id="' + id + '"]');
			var markPos = thisMark.position();
			var bottomPos = $('.js-map').height() - markPos.top;
			lines.setActive(thisObj.turn);
			self.tooltip.hide().removeClass('transition active');
			self.tooltip.show();
			if(markPos.top - self.tooltip.outerHeight() < 0) {
				self.tooltip.addClass('fromtop');
				self.tooltip.css({
					left: markPos.left,
					bottom: 'auto',
					top: markPos.top
				});
			} else {
				self.tooltip.removeClass('fromtop');
				self.tooltip.css({
					left: markPos.left,
					bottom: bottomPos,
					top: 'auto'
				});
			}
			setTimeout(function(){
				self.tooltip.addClass('transition active');
			}, 10);
			setMapCenterAnim(markPos.left, markPos.top - (mapCont.height()/100)*20);
		},
		init: function() {
			var self = this;
			$(document).on('click', '.js-mark', function(){
				var thisId = $(this).attr('data-id');
				var thisNumber = Dictionary.buildingsAll[thisId].number;
				//console.log(thisNumber);
				dataLayer.push({'event': 'ChooseLandMapClick', 'landId': thisNumber});
				carrotquest.track('kruzhok', {
					uchastok_id: thisId,
			    uchastok_number: thisNumber
			  });
			  if(Dictionary.click_tracker_url) {
			  	$.ajax({
			  		type: 'POST',
			  		data: {
			  			land_id: thisId
			  		},
			  		url: Dictionary.click_tracker_url
			  	}).fail(function(data){
			  		console.log(data);
			  	});
			  }
				self.show(thisId);
				return false;
			});
			$(document).on('click', '.js-tooltip .js-close', function(){
				self.close();
				return false;
			});
		}
	}
	var setMinMax = function(obj, type) {
		var priceCondition = (type && type == 'price') || !type;
		var areaCondition = (type && type == 'area') || !type;
		var thisPrices = {
			min: false,
			max: 0
		};
		var thisAreas = {
			min: false,
			max: 0
		};
		$.each(obj, function(index, value){
			if(priceCondition) {
				if(value.price > thisPrices.max) thisPrices.max = value.price;
				if(value.price < thisPrices.min || thisPrices.min === false) thisPrices.min = value.price;
			}
			if(areaCondition) {
				if(value.land_area > thisAreas.max) thisAreas.max = value.land_area;
				if(value.land_area < thisAreas.min || thisAreas.min === false) thisAreas.min = value.land_area;
			}
		});
		if(type) {
			if(type == 'price') {
				return thisPrices;
			}
			if(type == 'area') {
				return thisAreas;
			}
		} else {
			prices = thisPrices;
			areas = thisAreas;
		}
	}
	var setMarks = function() {
		setMinMax(Dictionary.buildings);
		$.each(Dictionary.buildingsAll, function(index, value){
			var soldStr = value.sold == 1 ? ' sold' : '';
			$('.js-map').append('<a class="image__mark js-mark' + soldStr + '" data-id="' + value.id + '" style="left: ' + value.coordinate_x/16 + 'rem; top: ' + value.coordinate_y/16 + 'rem;"></a>');
		});
	}
	var filter = function() {
		$('.js-radio').on('change', function(){
			//$(document).trigger('sliders::update');
		});
		/*$('#range-price').slider({
			range: true,
			min: prices.min,
			max: prices.max,
			values: [prices.min, prices.max],
			slide: function(event, ui) {
				$('.js-price-from').text(ui.values[ 0 ].formatMoney());
				$('.js-price-to').text(ui.values[ 1 ].formatMoney());
				$('[name="pricefrom"]').val(ui.values[ 0 ]);
				$('[name="priceto"]').val(ui.values[ 1 ]);
				$(document).trigger('sliders::update');
			},
			change: function() {
				$(document).trigger('sliderprice::update');
			}
		});*/
		/*$('#range-area').slider({
			range: true,
			min: areas.min,
			max: areas.max,
			values: [areas.min, areas.max],
			step: 0.01,
			slide: function(event, ui) {
				$('.js-area-from').text(ui.values[ 0 ]);
				$('.js-area-to').text(ui.values[ 1 ]);
				$('[name="areafrom"]').val(ui.values[ 0 ]);
				$('[name="areato"]').val(ui.values[ 1 ]);
				$(document).trigger('sliders::update');
			},
			change: function() {
				$(document).trigger('sliderarea::update');
			}
		});*/
		//updateFilterText();
		$('.js-filter-form input[type="checkbox"]').on('change', function(){
			countSuited();
			updateSliders();
			var checkedButtons = $('.js-filter-form input[type="checkbox"]:visible:checked');
			if(checkedButtons.length == 1) {
				checkedButtons.parent().addClass('disabledCheck');
			} else {
				$('.js-filter-form input[type="checkbox"]').each(function(){
					$(this).parent().removeClass('disabledCheck');
				});
			}
		});
	}
	var updateFilterText = function(type) {
		return;
		if(!type || (type && type == 'price')) {
			$('.js-price-from').text($('#range-price').slider('values', 0).formatMoney());
			$('.js-price-to').text($('#range-price').slider('values', 1).formatMoney());
			$('[name="pricefrom"]').val($('#range-price').slider('values', 0));
			$('[name="priceto"]').val($('#range-price').slider('values', 1));
		}
		if(!type || (type && type == 'area')) {
			$('.js-area-from').text($('#range-area').slider('values', 0));
			$('.js-area-to').text($('#range-area').slider('values', 1));
			$('[name="areafrom"]').val($('#range-area').slider('values', 0));
			$('[name="areato"]').val($('#range-area').slider('values', 1));
		}
	}
	var inFrontTimeOut;
	var showMap = function() {
		$('.js-choise-map').addClass('active');
		$('.js-choise-filter').removeClass('active');
		inFrontTimeOut = setTimeout(function(){
			$('.js-choise-filter').removeClass('infront');
		}, 500);
		return false;
	}
	var showFilter = function() {
		clearTimeout(inFrontTimeOut);
		$('.js-choise-map').removeClass('active');
		$('.js-choise-filter').addClass('infront active');
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
			setMapCenterAnim(thisX, thisY);
		},
		init: function() {
			var self = this;
			if(!Dictionary.buildings[Help.getHash('id')]) {
				self.setActive(3);
				self.setCenter(3);
			}
			$('.js-choice-left').on('click', function(){
				if($(this).attr('disabled')) return false;
				var thisNum = parseInt($(this).attr('data-number'));
				self.setActive(thisNum);
				self.setCenter(thisNum);
				return false;
			});
			$('.js-choice-right').on('click', function(){
				if($(this).attr('disabled')) return false;
				var thisNum = parseInt($(this).attr('data-number'));
				self.setActive(thisNum);
				self.setCenter(thisNum);
				return false;
			});
		}
	}
	var countSuited = function() {
		var inputs = $('.js-filter-form').serialize().split('&');
		filterParams = {};
		/*$.each(inputs, function(i, v){
			var iArray = v.split('=');
			filterParams[iArray[0]] = iArray[1] || false;
		});*/
		$.each(inputs, function(i, v){
			var iArray = v.split('=');
			if(iArray[0] == 'range') {
				var rangeArray = iArray[1].split('-');
				filterParams['areafrom'] = rangeArray[0] || false;
				filterParams['areato'] = rangeArray[1] || false;
				return;
			}
			filterParams[iArray[0]] = iArray[1] || false;
		});
		suitedArray = {};
		var params = filterParams;
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
			if(v.sold == 1) {
				suited = false;
			}
			if(suited) {
				suitedArray[i] = v;
			}
		});
	}
	var showSuited = function() {
		var html = [];
		var count = 0;
		var sortable = [];
		$.each(suitedArray, function(i, v){
			sortable.push(v);
		});
		sortable.sort(function(obj1, obj2) {
			var value = $('[data-sort]').attr('data-sort-name');
			var sortType = $('[data-sort]').attr('data-sort');
			var sort1 = obj1[value];
			var sort2 = obj2[value];
			if(value == 'number') {
				if(sort1.replace(/[0-9]/g, '') != '') {
					sort1 = parseInt(sort1) + 0.5;
				}
				if(sort2.replace(/[0-9]/g, '') != '') {
					sort2 = parseInt(sort2) + 0.5;
				}
			}
			if(sortType == 'ASC') {
				return sort1 - sort2;
			} else {
				return sort2 - sort1;
			}
		});
		$.each(sortable, function(i, v){
			var totalPrice = '';
			if(v.status == 2) {
				totalPrice = v.price_total.formatMoney();
			}
			var isFavorite = false;
			if($.cookie('favorite-areas')) {
				var favoriteData = JSON.parse($.cookie('favorite-areas'));
				var isFavorite = false;
				$.each(favoriteData, function(favId){
					if(favId == v.id) {
						isFavorite = true;
					}
				});
			}
			html.push('<li class="body__item js-filter-item" data-id="' + v.id + '"><div class="wrapper"><span><a href="#" class="js-favorite favorite-link' + (isFavorite ? ' active':'') + '" title="' + (isFavorite ? 'Убрать из избранного':'Добавить в избранное') + '"></a>' + v.number + '</span><span>' + v.turn + '</span><span>' + v.land_area + '</span><span>' + numToContract(v.status) + '</span><span>' + v.price.formatMoney() + '</span><span>' + totalPrice + '</span></div></li>');
			count++;
		});
		if(count != 0) {
			$('.js-filter-items').html(html.join(''));
		} else {
			$('.js-filter-items').html('<li class="body__item nothing-found">К сожалению по заданым параметрам ничего не нашлось</li>');
		}
	}
	var updateChecks = function() {
		var thisObj = {};
		var params = filterParams;
		$.each(Dictionary.buildings, function(i, v){
			var suited = true;
			if(v.price < params.pricefrom || v.price > params.priceto) {
				suited = false;
			}
			if(v.land_area < params.areafrom || v.land_area > params.areato) {
				suited = false;
			}
			if(v.sold == 1) {
				suited = false;
			}
			if(suited) {
				thisObj[i] = v;
			}
		});
		checkBoxes(thisObj);
	}
	var updateArea = function() {
		var thisObj = {};
		var params = filterParams;
		$.each(Dictionary.buildings, function(i, v){
			var suited = true;
			if(!(	
				(params.withhouse && v.status == 2)||
				(params.withpod && v.status == 1)||
				(params.withoutpod && v.status == 0))) {
				suited = false;
			}
			if(v.price < $('#range-price').slider('values', 0) || v.price > $('#range-price').slider('values', 1)) {
				suited = false;
			}
			if(v.sold == 1) {
				suited = false;
			}
			if(suited) {
				thisObj[i] = v;
			}
		});
		var areaRange = setMinMax(thisObj, 'area');
		//$('#range-price').slider('option', 'min', prices.min);
		//$('#range-price').slider('option', 'max', prices.max);
		// $('#range-area').slider('option', 'min', areaRange.min);
		// $('#range-area').slider('option', 'max', areaRange.max);
		$('#range-area').slider('option', 'values', [areaRange.min, areaRange.max]);
		updateFilterText('area');
	}
	var updatePrice = function() {
		var thisObj = {};
		var params = filterParams;
		$.each(Dictionary.buildings, function(i, v){
			var suited = true;
			if(!(	
				(params.withhouse && v.status == 2)||
				(params.withpod && v.status == 1)||
				(params.withoutpod && v.status == 0))) {
				suited = false;
			}
			if(v.land_area < $('#range-area').slider('values', 0) || v.land_area > $('#range-area').slider('values', 1)) {
				suited = false;
			}
			if(v.sold == 1) {
				suited = false;
			}
			if(suited) {
				thisObj[i] = v;
			}
		});
		var priceRange = setMinMax(thisObj, 'price');
		//$('#range-area').slider('option', 'min', areas.min);
		//$('#range-area').slider('option', 'max', areas.max);
		// $('#range-price').slider('option', 'min', priceRange.min);
		// $('#range-price').slider('option', 'max', priceRange.max);
		$('#range-price').slider('option', 'values', [priceRange.min, priceRange.max]);
		updateFilterText('price');
	}
	var updateSliders = function() {
		var thisObj = {};
		var params = filterParams;
		$.each(Dictionary.buildings, function(i, v){
			var suited = true;
			if(!(	
				(params.withhouse && v.status == 2)||
				(params.withpod && v.status == 1)||
				(params.withoutpod && v.status == 0))) {
				suited = false;
			}
			if(v.sold == 1) {
				suited = false;
			}
			if(suited) {
				thisObj[i] = v;
			}
		});
		var priceRange = setMinMax(thisObj, 'price');
		var areaRange = setMinMax(thisObj, 'area');
		$('#range-area').slider('option', 'min', areaRange.min);
		$('#range-area').slider('option', 'max', areaRange.max);
		$('#range-price').slider('option', 'min', priceRange.min);
		$('#range-price').slider('option', 'max', priceRange.max);
		updateFilterText('price');
		updateFilterText('area');
	}
	var submitFilter = function(form, noscroll) {
		countSuited();
		showSuited();
		if(form.find('[name="priceto"][value="1000000"]').is(':checked')) {
			_txq.push(['track', 'till_1']);
		}
		$('.js-filter-list').slideDown(300);
		Garden.favorite.set();
		if(!noscroll) {
			setTimeout(function(){
				$('.js-choise-filter').animate({
					scrollTop: $('.js-choise-filter .page-full').outerHeight(true)
				}, 300);
				// setTimeout(function(){
				// 	$('html, body').animate({
				// 		scrollTop: $('.js-choise-filter').offset().top - 100
				// 	}, 300);
				// }, 10);
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
			var thisNumber = Dictionary.buildings[thisId].number;
			dataLayer.push({'event': 'ChooseLandListClick', 'landId': thisNumber});
			showMap();
			tooltip.show(thisId);
			$('html, body').animate({
				scrollTop: $('.js-choise-wrapper').offset().top - 100
			});
		});
		$(document).on('sliders::update', function(){
			countSuited();
			updateChecks();
		});
		$(document).on('sliderprice::update', function(){
			//updateArea();
		});
		$(document).on('sliderarea::update', function(){
			//updatePrice();
		});
		if(window.location.hash.substr(1) != '') {
			showMap();
			if(Dictionary.buildings[Help.getHash('id')]) {
				tooltip.show(Help.getHash('id'));
				$('.js-back-to-buildings').show();
					//.attr('href', $('.js-back-to-buildings').attr('href') + '?page=' + Help.getHash('backhash'));
			}
		} else {
			$('.js-show-filter').show();
		}
		$('[data-sort-name]').on('click', function(){
			if($(this).attr('data-sort') == 'ASC') {
				$(this).attr('data-sort', 'DESC');
			} else {
				$(this).attr('data-sort', 'ASC');
			}
			$(this).siblings().removeAttr('data-sort');
			showSuited();
		});
		checkBoxes(Dictionary.buildings);
	}
	var checkBoxes = function(obj) {
		var checks = {
			withHouse: false,
			withWork: false,
			withOutWork: false
		};
		$.each(obj, function(i, v){
			if(v.status == 0) checks.withOutWork = true;
			if(v.status == 1) checks.withWork = true;
			if(v.status == 2) checks.withHouse = true;
		});
		if(!checks.withOutWork) {
			$('[name="withoutpod"]').parent().hide();
		} else {
			$('[name="withoutpod"]').parent().show();
		}
		if(!checks.withWork) {
			$('[name="withpod"]').parent().hide();
		} else {
			$('[name="withpod"]').parent().show();
		}
		if(!checks.withHouse) {
			$('[name="withhouse"]').parent().hide();
		} else {
			$('[name="withhouse"]').parent().show();
		}
	}
	var filterScroll = function() {
		var oldScroll = 0;
		$('.js-choise-filter').on('scroll', function(e){
			if($(window).scrollTop() < 113 && oldScroll < $(this).scrollTop()) {
				$(window).scrollTop($(window).scrollTop() + ($(this).scrollTop() - oldScroll));
			}
			oldScroll = $(this).scrollTop();
		});
	}
	var init = function() {
		$('.js-map').addClass('active');
		move();
		setMarks();
		tooltip.init();
		filter();
		mapTabs();
		filterForm();
		countSuited();
		submitFilter($('.js-filter-form'), true);
		lines.init();
		filterScroll();
	}
	init();
}
Garden.book = function() {
	$(document).on('click', '.js-book', function(){
		var houseId = $(this).attr('data-id');
		if(houseId != 0) {
			var input = $('.js-input-book-id');
			var thisObj = Dictionary.buildings[houseId];
			input.val(houseId);
			$('.js-book-number').text(thisObj.number);
			$('.js-book-line').text(thisObj.turn);
			$('.js-book-area').text(thisObj.land_area);
			$('.js-book-price').text(thisObj.price.formatMoney());
			$('.js-book-price-total').text(thisObj.price_total.formatMoney());
			if(thisObj.status == 2) {
				$('.js-book-title-with-house').show()
					.siblings().hide();
			} else {
				$('.js-book-title').show()
					.siblings().hide();
			}
		} else {
			
		}
		Garden.overlays.open('book');
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
	$('.js-radio').button();
}
Garden.stagesForm = function() {
	$('.js-stages-form').each(function(){
		var parent = $(this);
		var activeStage = 0;
		var stage = function(n) {
			activeStage = n;
			parent.find('.js-stage').eq(n).addClass('active')
				.siblings().removeClass('active');
			parent.find('.js-status-dot').eq(n).addClass('active')
				.siblings().removeClass('active');
		}
		parent.find('input[type="radio"]').on('change', function(){
			stage(activeStage+1);
			$('.js-status-dot').eq(activeStage).removeClass('disabled');
		});
		parent.find('.js-status-dot').on('click', function(){
			if($(this).hasClass('disabled')) return false;
			stage($(this).index()/2);
			return false;
		});
		stage(0);
	});
}
Garden.setFor = function() {
	var count = 0;
	$('input.js-set-for').each(function(){
		var input = $(this);
		var parent = input.parent();
		var setStr = 'input' + count;
		input.attr('id', setStr);
		parent.find('label').attr('for', setStr);
		count++;
	});
}
Garden.housesFilter = {
	form: $('.js-houses-filter'),
	ajax: false,
	getItems: function() {
		var t = this;
		if(t.ajax) t.ajax.abort();
		var loader = $('.js-filter-loading');
		loader.addClass('loading');
		t.ajax = $.ajax({
			type: 'POST',
			url: t.form.attr('action'),
			data: t.form.serialize()
		}).done(function(data){
			if(data.status) {
				if(data.html == '') {
					data.html = '<div class="builds-empty">К сожалению по заданым параметрам ничего не нашлось</div>';
				}
				$('.js-done-wrapper').html(data.html);
			}
		}).fail(function(data){
			console.log(data);
		}).always(function(data){
			loader.removeClass('loading');
		});
	},
	setFilter: function() {
		if($.cookie('housesFilter')) {
			var hash = Help.getHash(false, $.cookie('housesFilter'));
			$.each(hash, function(i, v){
				$('input[name="' + i + '"]').attr('checked', 'checked');
			});
		} else {
			$('.js-houses-filter').find('input.default').each(function(){
				$(this)[0].checked = true;
			});
		}
	},
	disable: function() {
		this.form.find('input').each(function(){
			var listParent = $(this).parent().parent();
			listParent.find('input').not(':checked').parent().removeClass('disabled');
			listParent.find('input:checked').parent().addClass('disabled');
		});
	},
	init: function() {
		var t = this;
		if(!t.form.length) return;
		t.setFilter();
		t.getItems();
		t.disable();
		t.form.find('input').not('.js-set-all').on('change', function(){
			var listParent = $(this).parent().parent();
			var others = listParent.find('input').not($(this));
			// if($(this).hasClass('js-set-all')) {
			// 	if($(this).is(':checked')) {
			// 		thisAll.each(function(){
			// 			$(this)[0].checked = true;
			// 		});
			// 		thisAll.button('refresh');
			// 	}
			// }
			/*if(!isAllCheked) {
				allCheck[0].checked = false;
				allCheck.button('refresh');
			}*/
			others.each(function(){
				$(this)[0].checked = false;
				$(this).button('refresh');
			});
			if(t.form.serialize() == '') {
				$.removeCookie('housesFilter');
			} else {
				$.cookie('housesFilter', t.form.serialize(), {
					path: '/'
				});
			}
			t.getItems();
			t.disable();
		});
	}
}
Garden.scrollTop = function() {
	var link = $('.js-scroll-top');
	var scrollBlocks = $(window).add('.js-choise-filter');
	var show = function() {
		if($(window).scrollTop() > $(window).height() || $('.js-choise-filter').scrollTop() > $(window).height() || $(window).scrollTop() >= $(document).height()) {
			link.addClass('active');
		} else {
			link.removeClass('active');
		}
	}
	link.on('click', function(){
		$('html, body, .js-choise-filter').each(function(){
			$(this).animate({
				scrollTop: 0
			}, 300);
		});
		return false;
	});
	scrollBlocks.on('scroll', function(){
		show();
	});
	show();
}
Garden.favorite = {
	add: function(parent, scroll) {
		var json = $.cookie('favorite-areas');
		if(json) {
			var data = JSON.parse(json);
		} else {
			var data = {};
		}
		data[parent.attr('data-id')] = {};
		$.cookie('favorite-areas', JSON.stringify(data));
		if(scroll) $('.js-choise-filter').scrollTop($('.js-choise-filter').scrollTop() + $('.js-filter-item').first().height());
	},
	remove: function(parent, scroll) {
		var json = $.cookie('favorite-areas');
		var thisId = parent.attr('data-id');
		if(json) {
			var data = JSON.parse(json);
		} else {
			var data = {};
		}
		delete data[thisId];
		$('[data-id="' + thisId + '"] .js-favorite').removeClass('active').attr('title', 'Добавить в избранное');
		$.cookie('favorite-areas', JSON.stringify(data));
		if(scroll) $('.js-choise-filter').scrollTop($('.js-choise-filter').scrollTop() - $('.js-filter-item').first().height());
	},
	click: function(elem) {
		var t = this;
		var parent = elem.parents('[data-id]').first();
		if(parent.hasClass('js-filter-item')) {
			var doScroll = true;
		} else {
			var doScroll = false;
		}
		if(elem.hasClass('active')) {
			t.remove(parent, doScroll);
		} else {
			t.add(parent, doScroll);
		}
		t.set();
	},
	set: function() {
		var json = $.cookie('favorite-areas');
		if(json) {
			var data = JSON.parse(json);
			var html = [];
			$.each(data, function(i){
				if(i == undefined || i == 'undefined') return;
				$('[data-id="' + i + '"] .js-favorite').addClass('active').attr('title', 'Убрать из избранного');
				var v = Dictionary.buildingsAll[i];
				var totalPrice = '';
				if(v.status == 2) {
					totalPrice = v.price_total.formatMoney();
				}
				html.push('<li class="body__item js-filter-item" data-id="' + v.id + '"><div class="wrapper"><span><a href="#" class="js-favorite favorite-link active" title="Убрать из избранного"></a>' + v.number + '</span><span>' + v.turn + '</span><span>' + v.land_area + '</span><span>' + numToContract(v.status) + '</span><span>' + v.price.formatMoney() + '</span><span>' + totalPrice + '</span></div></li>');
			});
			$('.js-favorite-cont').show()
				.find('.js-favorite-items').html(html.join(''));
		} else {
			$('.js-favorite-cont').hide();
		}
		var realCount = 0;
		if($.cookie('favorite-areas')) {
			$.each(JSON.parse($.cookie('favorite-areas')), function(i){
				if(i != 'undefined' && i != undefined) {
					realCount++;
				}
			});
		}
		if(realCount == 0) {
			$('.js-favorite-cont').hide();
		}
	},
	init: function() {
		var t = this;
		if(!$('.js-favorite-cont').length) return;
		t.set();
		$(document).on('click', '.js-favorite', function(){
			t.click($(this));
			return false;
		});
	}
}
Garden.tooltip = {
	block: $('.js-info-overlay'),
	timeout: false,
	close: function() {
		var t = this;
		t.timeout = setTimeout(function(){
			t.block.hide();
		}, 1000);
	},
	show: function(elem) {
		var t = this;
		var text = elem.attr('data-tooltip');
		clearTimeout(t.timeout);
		t.block.show().css({
			top: elem.offset().top - 10 * parseInt($('html').css('font-size')) / 16,
			left: elem.offset().left + 30 * parseInt($('html').css('font-size')) / 16
		}).html(text);
	},
	init: function() {
		var t = this;
		$(document).on('mouseenter', '[data-tooltip]', function(){
			t.show($(this));
		}).on('mouseleave', '[data-tooltip]', function(){
			t.close();
		});
		t.block.on('mouseenter', function(){
			clearTimeout(t.timeout);
		}).on('mouseleave', function(){
			t.close();
		});
	}
}
Garden.init = function() {
	$('.js-gallery-track').on('click', function(){
		dataLayer.push({'event': 'HousePhotoClick', 'landId': $(this).attr('data-number')});
	});
	this.tooltip.init();
	this.scrollTop();
	this.housesFilter.init();
	this.setFor();
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
	this.stagesForm();
	this.favorite.init();
	//this.speedUp();
	//this.smartHover();
}
$(function(){
	Garden.init();
});