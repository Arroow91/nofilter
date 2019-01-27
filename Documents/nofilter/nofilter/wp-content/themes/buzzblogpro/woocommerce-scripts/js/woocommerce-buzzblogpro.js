; //defensive semicolon

// Begin jQuery functions
jQuery(function($) {

    // Quantity buttons
    $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
	
	$(document.body).on('updated_wc_div', function() {
 $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
         });

    $( document ).on( 'click', '.plus, .minus', function() {

        // Get values
        var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr( 'max' ) ),
            min         = parseFloat( $qty.attr( 'min' ) ),
            step        = $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {

            if ( max && ( max == currentVal || currentVal > max ) ) {
                $qty.val( max );
            } else {
                $qty.val( currentVal + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentVal || currentVal < min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( currentVal - parseFloat( step ) );
            }

        }

        // Trigger change event
        $qty.trigger( 'change' );
    });

});
(function ($) {

    $.fn.serializeObject = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    
    $(document).ready(function () {

        $('body').on('wc_fragments_refreshed', function () {
            $('.is_mobile #cart-wrap').show();
        });

        /////////////////////////////////////////////
        // Add to cart ajax
        /////////////////////////////////////////////

            // Ajax add to cart
            var $loadingIcon;
            $('body').on('adding_to_cart', function (e, $button, data) {
                //add_to_cart_spark($button);
                var cart = $('#cart-wrap');
                // hide cart wrap
                cart.hide();
                // This loading icon
                $loadingIcon = $('.loading-product', $button.closest('.product')).first();
                $loadingIcon.show();
            }).on('added_to_cart removed_from_cart', function (e, fragments, cart_hash) {
                $('#cart-wrap').show();

                if (typeof $loadingIcon !== 'undefined') {
                    // Hides loading animation
                    $loadingIcon.hide(300, function () {
                        $(this).addClass('loading-done');
                    });
                    $loadingIcon
                            .fadeIn()
                            .delay(500)
                            .fadeOut(300, function () {
                                $(this).removeClass('loading-done');
                            });
                }

          
                $('form.cart').find(':submit').removeAttr('disabled');
            });

            // remove item ajax
			
            $(document).on('click', '.remove-item-js', function (e) {
			
                e.preventDefault();
                // AJAX add to cart request
                var $thisbutton = $(this),
                        data = {
                            action: 'theme_delete_cart',
                            remove_item: $thisbutton.attr('data-product-key')
                        };
                $thisbutton.addClass('buzzblogpro_spinner');
                // Ajax action
                $.post(woocommerce_params.ajax_url, data, function (response) {

                    var this_page = window.location.toString();
                    this_page = this_page.replace('add-to-cart', 'added-to-cart');

                    fragments = response.fragments;
                    cart_hash = response.cart_hash;

                    // Block fragments class
                    if (fragments) {
                        $.each(fragments, function (key, value) {
                            $(key).addClass('updating');
                        });
                    }

                    // Block widgets and fragments
                    $('.shop_table.cart, .updating, .cart_totals, .widget_shopping_cart').fadeTo('400', '0.6').block({message: null, overlayCSS: {background: 'transparent url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});

                    // Changes button classes
                    if ($thisbutton.parent().find('.added_to_cart').size() == 0)
                        $thisbutton.addClass('added');

                    // Replace fragments
                    if (fragments) {
                        $.each(fragments, function (key, value) {
                            $(key).replaceWith(value);
                        });
                    }

                    // Unblock
                    $('.widget_shopping_cart, .updating').stop(true).css('opacity', '1').unblock();

                    // Cart page elements
                    $('.shop_table.cart').load(this_page + ' .shop_table.cart:eq(0) > *', function () {

                        $('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<input type="button" value="+" id="add1" class="plus" />').prepend('<input type="button" value="-" id="minus1" class="minus" />');

                        $('.shop_table.cart').stop(true).css('opacity', '1').unblock();

                        $('body').trigger('cart_page_refreshed');
                    });

                    $('.cart_totals').load(this_page + ' .cart_totals:eq(0) > *', function () {
                        $('.cart_totals').stop(true).css('opacity', '1').unblock();
                    });

                    // Trigger event so themes can refresh other areas
                    $('body').trigger('removed_from_cart', [fragments, cart_hash]);
                    $thisbutton.removeClass('buzzblogpro_spinner');
                    if($('#cart-icon-count').hasClass('cart_empty')){
                            $body.addClass('wc-cart-empty');
                    }
                });
            });

            // Ajax add to cart in single page
            ajax_add_to_cart_single_page();


        /*function ajax add to cart in single page */
        function ajax_add_to_cart_single_page() {
            var submitClicked = false;
            $(document).on('click', '.single_add_to_cart_button', function (event) {
                if (!$(this).closest('.product').hasClass('product-type-external')) {
                    event.preventDefault();
                    submitClicked = true;
                    $('form.cart').submit();
                }


            }).on('submit', 'form.cart', function (event) {
                if (submitClicked) {
                    // This loading icon
                    var $loadingIcon = $(this).closest('.product').find('.loading-product').first();
                    $loadingIcon.show();

                    var data = $(this).serializeObject(),
						data2 = {action: 'theme_add_to_cart'};
					if($(this).find('input[name="add-to-cart"]').length===0){
						data2['add-to-cart'] = $(this).find('[name="add-to-cart"]').val();
					}
                    $.extend(true, data, data2);

                    // Trigger event
                    $('body').trigger('adding_to_cart', [$(this), data]);

                    // Ajax action
                    $.post(woocommerce_params.ajax_url, data, function (response) {

                        submitClicked = false;

                        if (!response)
                            return;
                        if (buzzblogproShop.redirect) {
                            window.location.href = buzzblogproShop.redirect;
                        }
                        var this_page = window.location.toString();
                        this_page = this_page.replace('add-to-cart', 'added-to-cart');

                        fragments = response.fragments;
                        cart_hash = response.cart_hash;

                        // Block fragments class
                        if (fragments) {
                            $.each(fragments, function (key, value) {
                                $(key).addClass('updating');
                            });
                        }

                        // Block widgets and fragments
                        $('.shop_table.cart, .updating, .cart_totals, .widget_shopping_cart').fadeTo('400', '0.6').block({message: null, overlayCSS: {background: 'transparent url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});

                        // Replace fragments
                        if (fragments) {
                            $.each(fragments, function (key, value) {
                                $(key).replaceWith(value);
                            });
                        }

                        // Unblock
                        $('.widget_shopping_cart, .updating').stop(true).css('opacity', '1').unblock();

                        // Cart page elements
                        $('.shop_table.cart').load(this_page + ' .shop_table.cart:eq(0) > *', function () {

                            $("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass('buttons_added').append('<input type="button" value="+" id="add1" class="plus" />').prepend('<input type="button" value="-" id="minus1" class="minus" />');

                            $('.shop_table.cart').stop(true).css('opacity', '1').unblock();

                            $('body').trigger('cart_page_refreshed');
                        });

                        $('.cart_totals').load(this_page + ' .cart_totals:eq(0) > *', function () {
                            $('.cart_totals').stop(true).css('opacity', '1').unblock();
                        });

                        // Trigger event so themes can refresh other areas
                        $('body').trigger('added_to_cart', [fragments, cart_hash]);

                    });
                    return false;
                }
            });
        }

        var $body = $('body');

        $body.on('added_to_cart', function (e) {

            $('.added_to_cart:not(.button)').addClass('button');

                    $('#cart-icon-count').addClass('show_cart');
                    setTimeout(function () {
                        $('#cart-icon-count').removeClass('show_cart');
                    }, 1000);
                
            
			$body.removeClass('wc-cart-empty');
        });
    });

}(jQuery));