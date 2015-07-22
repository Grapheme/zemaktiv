window.Garden = {};
Garden.header = function() {
	var headerStatus;
	var setHeader = function() {
		if($(window).scrollTop() >= 205) {
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
Garden.init = function() {
	this.header();
}
$(function(){
	Garden.init();
});