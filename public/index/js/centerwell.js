$(document).ready(function() {
	var $centerwell_first = $('#centerwell .centerwell:first');
	$centerwell_first.animate({width: '898px'}, 600);
	$centerwell_first.find('h3').animate({backgroundPosition: '-80px'}, 600);
	

	$('#centerwell .centerwell').mouseenter(function() {
if(!$(this).is(':animated')){
	$(this).animate({width: '898px'}, 600).siblings().animate({width: '80px'}, 600);
	$(this).find('h3').animate({backgroundPosition: '-80px'}, 600).parent().siblings().find('h3').animate({backgroundPosition: '0px'}, 600);
}
	});
});