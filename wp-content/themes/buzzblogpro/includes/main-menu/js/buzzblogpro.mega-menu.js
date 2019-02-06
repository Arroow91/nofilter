/*
 * Buzzblogpro Mega Menu Plugin
 */
;(function ($) {
	$.fn.BuzzblogproMegaMenu = function( custom ) {

		var options = $.extend({
				events: 'mouseenter'
			}, custom),
			cacheMenu = {};


		return this.each(function() {
			var $thisMega = $(this),
				$megaMenuPosts = $('.mega-menu-posts', $thisMega);

			$thisMega.on(options.events+' touchend', '.mega-link', function(event) {
				event.preventDefault();

				var $self = $(this),
					termid = $self.data('termid'),
					itemid = $self.data('itemid'),
					tax = $self.data('tax'),
					nosubmenu = $self.parents('.no-sub-menu').attr('data-nosubmenu') ? $self.parents('.no-sub-menu').attr('data-nosubmenu') : '3';
				if( 'string' == typeof cacheMenu[itemid] ) {
					$megaMenuPosts.html( cacheMenu[itemid] );
				} else {
					if( $self.hasClass( 'loading' ) ) {
					
						return;
					}
					$self.addClass( 'loading' );
					
					$.ajax({
					 url: buzzblogproScript.ajax_url,
		             type: 'GET',
					 async: true,
		             data: {
			                action: 'buzzblogpro_theme_mega_posts',
							termid: termid,
							itemid: itemid,
							tax: tax,
							nosubmenu: nosubmenu
                           },
						 
						success: function( data ) {
							$megaMenuPosts.html( data );
							cacheMenu[itemid] = data;
							$self.removeClass( 'loading' );
						}
					});
				 }
			});

						// when hovering over top-level mega menu items, show the first one automatically
			$thisMega.on( 'mouseenter', '> a', function(){
				$( this ).closest( 'li' ).find( '.mega-sub-menu .mega-link:first' ).trigger( options.events );

			} );
			
			

		});
	
	};

	$(document).ready(function() {
	
	/////////////////////////////////////////////
        // Search Form							
        /////////////////////////////////////////////
        var $search = $('#search-lightbox-wrap');
        if ($search.length > 0) {
            var cache = [],
                    xhr,
                    $input = $search.find('#searchform input'),
                    $result_wrapper = $search.find('.search-results-wrap');
					$result_wrapper.hide();
            $('.search-icon, .closeit').click(function (e) {
                e.preventDefault();
                if ($(this).hasClass('search-icon')) {
                    $result_wrapper.html('');
                    $input.val("");
					$result_wrapper.hide();
                }
                else {
                    if (xhr) {
                        xhr.abort();
                    }
                    //$search.fadeOut();
					$input.val("");
                   $result_wrapper.html('');
				   $result_wrapper.hide();
                }
            });

            $result_wrapper.delegate('.search-option-tab a', 'click', function (e) {
                e.preventDefault();
                var $href = $(this).attr('href').replace('#', '');
                if ($href === 'all') {
                    $href = 'item';
                }
                else {
                    $result_wrapper.find('.result-item').stop().fadeOut();
                }
                if ($('#result-link-' + $href).length > 0) {
                    $('.view-all-button').hide();
                    $('#result-link-' + $href).show();
                }
                $result_wrapper.find('.result-' + $href).stop().fadeIn();
                $(this).closest('ul').children('li.active').removeClass('active');
                $(this).closest('li').addClass('active');
            });

            $input.prop('autocomplete', 'off').keyup(function (e) {
                function set_active_tab(index) {
                    if (index < 0) {
                        index = 0;
                    }
                    $result_wrapper.find('.search-option-tab li').eq(index).children('a').trigger('click');
                    $result_wrapper.show();
                }
                if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || e.keyCode === 8) {
                    var $v = $.trim($(this).val());
                    if ($v) {
                        if (cache[$v]) {
                            var $tab = $result_wrapper.find('.search-option-tab li.active').index();
                            $result_wrapper.hide();
                            set_active_tab($tab);
                            return;
                        }
                        setTimeout(function () {
                            $v = $.trim($input.val());
                            if (xhr) {
                                xhr.abort();
                            }
                            if (!$v) {
                                $result_wrapper.html('');
                                return;
                            }

                            xhr = $.ajax({
                                url: buzzblogproScript.ajax_url,
                                type: 'POST',
                                data: {'action': 'buzzblogpro_search_autocomplete', 'term': $v},
                                beforeSend: function () {
                                    $search.addClass('search-loading');
									$result_wrapper.show();
                                    $result_wrapper.html('<span class="loading"></span>');
                                },
                                complete: function () {
                                    $search.removeClass('search-loading');
                                },
                                success: function (resp) {
                                    if (!$v) {
                                        $result_wrapper.html('');
                                    }
                                    else if (resp) {
                                        var $tab = $result_wrapper.find('.search-option-tab li.active').index();
                                        $result_wrapper.hide().html(resp);
                                        set_active_tab($tab);
                                        $result_wrapper.find('.search-option-tab li.active')
                                        cache[$v] = resp;
                                    }
                                }
                            });
                        }, 100);
                    }
                    else {
                        $result_wrapper.html('');
						$result_wrapper.hide();
                    }
                }
            });
        }
	
	
	
		if( 'undefined' !== typeof $.fn.BuzzblogproMegaMenu ) {
			/* add required wrappers for mega menu items */
			$( '.has-sub-menu.has-mega-sub-menu' ).each(function(){
				var $this = $( this );

				$this.find( '> ul' ).removeAttr( 'class' )
					.wrap( '<div class="mega-sub-menu sub-menu" />' )
					.wrap( '<div class="mega-container" />' )
					.after( '<div class="mega-menu-posts" />' )
					.find( 'li.menu-item-type-taxonomy' ) // only taxonomy terms can display mega posts
						.addClass( 'mega-link' );
			});
			$('.has-sub-menu.has-mega-sub-menu').BuzzblogproMegaMenu({
				events: buzzblogproScript.events
			});
		} 
		
		
//Mailchimp Code//

			  var $wrap       = $('.buzzblogpro-mc-form'),
                $submit     = $wrap.find( '.buzzblogpro-mc' );
				
				
				
			function valid(email)
{
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email); 
}

			$submit.on('click', function () {
				
				var widg_id = $(this).attr('data-id'),
				email = $wrap.find('#buzzblogpro-mc-email-'+ widg_id ).val(),
				$button    = $('#buzzblogpro-mc-form'+ widg_id ).find( '.ajax-loader' ),
				$sub = $('#buzzblogpro-mc-form'+ widg_id ).find( '.buzzblogpro-mc' ),
				$consent = $wrap.find('input[name="buzzblogpro-mc-consent-'+ widg_id + '"]' );
				
				if($consent.length) {
if(!$consent.is(':checked')) {
return false;
}
}
				if(!valid(email)) {
					$('#buzzblogpro-mc-email-'+ widg_id ).parent('.form-group').addClass('has-error');
					$('#buzzblogpro-mc-email-'+ widg_id ).val(buzzblogproScript.must_fill);
					return false;
				}else{
				
					var btn_obj = $(this);
					var btn_txt = $(this).val();
		 
					//$(this).val(buzzblogproScript.wait);
					$.ajax({
						type: "POST",
						url: buzzblogproScript.ajax_url,
						data: 'action=buzzblogpro-mc&ajax_nonce='+buzzblogproScript.ajax_nonce+'&'+$('#buzzblogpro-mc-form'+widg_id).serialize(),
						beforeSend: function() {
                       
                        $button.fadeIn('fast');
						$sub.prop('disabled', true);
                        
                    },
						success: function (data) {
							$(btn_obj).val(btn_txt);
							$('#buzzblogpro-mc-email-'+ widg_id ).val(data);
							$('#buzzblogpro-mc-first_name'+ widg_id ).val('');
							$('#buzzblogpro-mc-last_name'+ widg_id ).val('');
							$('#buzzblogpro-mc-email-'+ widg_id ).parent('.form-group').removeClass('has-error');
							$('#buzzblogpro-mc-email-'+ widg_id ).parent('.form-group').attr('data-original-title', '');
							$('#buzzblogpro-mc-err'+widg_id).fadeOut();
							$button.fadeOut('fast');
							$sub.prop('disabled', false);
							setTimeout(function () {
                                        $('#buzzblogpro-mc-email-'+ widg_id ).val('');
										$consent.prop('checked', false);
                                    }, 2000);
						},error: function(xhr, status, error) {
							$('#buzzblogpro-mc-err'+widg_id).text(buzzblogproScript.must_fill);
							$button.fadeOut('fast');
							$sub.prop('disabled', false);
						}
					});
				
				}
			});
	});

})(jQuery);