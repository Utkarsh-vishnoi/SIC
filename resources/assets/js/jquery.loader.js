(function($) {

    $.fn.loader = function(method) {

        this.each( function() {
            
            if(method == 'show') {
                $(this).prepend(
            		$('<div>', { id: "loader"}).append(
            			$('<div>', {id: "loader-status"}).html('&nbsp;')));
            }

            if (method == 'hide') {
            	$('#loader').fadeOut();
				$('#loader-status').delay(750).fadeOut('slow'); 
				$(this).delay(750).css({'overflow':'visible'});
            }
        });

    }

}(jQuery));