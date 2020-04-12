// Confirm page-load complete
$(window).on('load', function() {
	// 1. My Weird CSS.
	logger("Hello, Greetings Student!!!!, I am SICk designed by Utkarsh Vishnoi. So please mind u'r own buisness and press F12 immediately.");

	// 2. Page Preloader Call
	preload();

	// 3. Table Auto-Number Call
	autoNumber();
});

// Page Preloader
function preload()
{
	$('#status').fadeOut();
	$('#preloader').delay(750).fadeOut('slow'); 
	$('body').delay(750).css({'overflow':'visible'});
}

// Table Auto Number
function autoNumber()
{
	$('td.id').each(function(index) {
		$(this).text(index + 1);
	});
}

// Console logger
function logger(data) {
	console.log(data);
}