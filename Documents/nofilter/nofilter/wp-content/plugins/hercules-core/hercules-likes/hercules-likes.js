jQuery(document).ready(function($){

	$('.hercules-likes').live('click',
	    function() {
    		var link = $(this);
    		if(link.hasClass('active')) return false;
		
    		var id = $(this).attr('id'),
    			postfix = link.find('.hercules-likes-postfix').text();
			
    		$.post(hercules_likes.ajaxurl, { action:'hercules-likes', likes_id:id, postfix:postfix }, function(data){
    			link.html(data).addClass('active').attr('title','You already like this');
    		});
		
    		return false;
	});
	
	if( $('body.ajax-hercules-likes').length ) {
        $('.hercules-likes').each(function(){
    		var id = $(this).attr('id');
    		$(this).load(hercules_likes.ajaxurl, { action:'hercules-likes', post_id:id });
    	});
	}

});