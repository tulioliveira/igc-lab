$('.ui[data-content]').popup({
	on: 'manual'
});

$('#help-button').hover(function() {
	$(this).addClass("active");
	
	$('.ui[data-content]').popup('show');
}, function() {
	$(this).removeClass("active");
	$('.ui[data-content]').popup('hide');
});