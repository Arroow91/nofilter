/**
 * sidebarEffects.js
 */
var SidebarMenuEffects = (function() {

    function hasParentClass(e, classname) {
        if (e === document) return false;
        if (classie.has(e, classname)) {
            return true;
        }
        return e.parentNode && hasParentClass(e.parentNode, classname);
    }

    function mobilecheck() {
        var check = false;
        (function(a) {
            if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    }

    function init() {

        var container = document.getElementById('st-container'),
            buttons = Array.prototype.slice.call(document.querySelectorAll('.st-trigger-effects > a.nav-icon4')),
            butclose = document.querySelector('.icon-menu a.nav-icon4'),
            butclosee = document.querySelector('.mobile-icons a.nav-icon4'),
            eventtype = mobilecheck() ? 'touchstart' : 'click',
            resetMenu = function() {
                classie.remove(container, 'st-menu-open');
                if(butclose) {classie.remove(butclose, 'open') }; 
                if(butclosee) {classie.remove(butclosee, 'open') };
            },
            bodyClickFn = function(evt) {
                if (!hasParentClass(evt.target, 'st-menu')) {
                    resetMenu();
                    document.removeEventListener(eventtype, bodyClickFn);
                }
            };

        buttons.forEach(function(el, i) {
            var effect = 'st-effect-4';

            el.addEventListener(eventtype, function(ev) {
                el.classList.toggle('open');
                ev.stopPropagation();
                ev.preventDefault();
                classie.add(container, effect);
                container.classList.toggle('st-menu-open');
                document.addEventListener(eventtype, bodyClickFn);

            });
        });
    }

    init();

})();
(function($) {
    'use strict';
    $.fn.pinIt = function() {
        this.each(function() {
            $(this).width() > 120 && $(this).height() > 120 && $(this).hover(function() {
                var b = $(location).attr("href");
                b = encodeURIComponent(b);
                var c = $(this).find("img").attr("src"),
				a = $(this).find("img").attr("alt");
                if ($("> a", this).length > 0) {
                    var d = $("> a", this).attr("href");
                    d.match(/\.(gif|jpeg|jpg|png)/) && (c = d)
                }
                c = encodeURIComponent(c), $('<a class="hs hs-pinterest pinterest-share-icon" href="//www.pinterest.com/pin/create/bookmarklet/?url=' + b + "&media=" + c + '&description=' + a + '&is_video=false" target="_blank"></a>').appendTo(this).addClass("pin-it-visible")
            }, function() {
                $(this).children(".pinterest-share-icon").remove()
            })
        })
    }


	function audioPlayerInit() {

        $('.audio-wraper').each(function() {
	
	if($(this).hasClass('active')) {
	$(this).find('audio').audioPlayer();
	}
	$(this).removeClass("active");
	
	});
	
	}

	
    function justifiedgalleryInit() {
        //justified gallery

        $('div[id^="justifiedgall_"]').each(function() {
            var captions_data = $(this).attr('data-captions') == 'true' ? true : false,
                margins_data = $(this).attr('data-margins'),
				selector = $(this).attr('data-selector'),
				lastrow = $(this).attr('data-lastrow') ? $(this).attr('data-lastrow') : 'justify',
				rtl_data = $(this).attr('data-rtl') == 'true' ? true : false,
				pinit = $(this).attr('data-pinit') != 'false' ? true : false,
                randomize_data = $(this).attr('data-randomize') == 'true' ? true : false,
                rowheight_data = $(this).attr('data-rowheight'),
				closetext = $(this).attr('data-backtostory') ? $(this).attr('data-backtostory') : 'back to story';
				
            $(this).justifiedGallery({
                rowHeight: rowheight_data,
                maxRowHeight: null,
                margins: margins_data,
                selector: "div:not(.spinner)",
                border: 0,
                lastRow: lastrow,
                captions: captions_data,
				rtl: rtl_data,
                randomize: randomize_data,
            }).on('jg.complete', function() {
			if(pinit == true) {
                $(this).find($("div", this)).pinIt();
				}
                if ($('.grid')[0]) {
                    $(".grid").masonry();
                }
                $(this).magnificPopup({
                    delegate: '.jg-entry a:not(.pinterest-share-icon)',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: true,
                    mainClass: 'mfp-zoom-in',
					removalDelay: 300,
					closeMarkup: '<span title="%title%" class="mfp-close">'+ closetext +'</span>',
                    image: {
markup: 
            '<div class="mfp-wrapper"><div class="mfp-counter"></div><div class="mfp-contain"><div class="mfp-bottom-bar">'+
              '<div class="mfp-title"></div>'+

            '</div>'+
'<div class="mfp-figure">'+
            '<div class="mfp-close"></div>'+
            '<div class="mfp-img"></div>'+
          '</div></div></div>',
                        verticalFit: true,
                        titleSrc: function(item) {
                            var caption = '',
							title = item.el.find('img').attr('data-title'),
							excerpt = item.el.find('img').attr('data-excerpt'),
							content = item.el.find('img').attr('data-content');
							
							if(title) {
							caption += '<h6>' + title + '</h6>';
							}
							if(title) {
							caption += '<p>' + excerpt + '</p>';
							}
							if(content) {
							caption += '<small>' + content + '</small>';
							}

							return caption;
                        }
                    },
                    gallery:{
            enabled:true,
			tCounter: '%curr%/%total%',
			arrowMarkup: '<i class="mfp-arrow mfp-arrow-%dir%"></i>',
			
        },

                  callbacks: {
            open: function() {
                //overwrite default prev + next function. Add timeout for css3 crossfade animation
                $.magnificPopup.instance.next = function() {
                    var self = this;
                    self.wrap.removeClass('mfp-image-loaded');
                    setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);
                }
                $.magnificPopup.instance.prev = function() {
                    var self = this;
                    self.wrap.removeClass('mfp-image-loaded');
                    setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);
                }
            },
            imageLoadComplete: function() { 
                var self = this;
                setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
            }
        }
                });
								$('.'+selector).on('click', function () {
    $('#'+selector).magnificPopup('open');
});
            });
        });
    }
    //  Set the Cookie
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    // Get the Cookie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    // Check if Cookie exists
    function checkCookie() {
            $.magnificPopup.open({
                items: {
                    src: '#hs_signup'
                },
                type: 'inline',
                tClose: '',
                fixedContentPos: true,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in newsletter-ajax'
            });
    }
    function masonryStart() {
        if ($('.grid')[0]) {
      
            var $container = $(".grid");
            $container.imagesLoaded(function() {
                $container.masonry({
                    itemsSelector: ".block",
                    columnWidth: ".block",
                    isAnimated: false
                });
            });
	$container.each(function(){
    var $masonry = $(this);
    var update = function(){
    $masonry.masonry('layout');
    };
    this.addEventListener('load', update, true);
});
        }
    }

	 
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    function jarallaxResize(event) {
		var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
    {
         } else {
	
        $(".top-slideshow .cover-wrapper").each(function() {
            $(this).jarallax("clipContainer").jarallax("coverImage").jarallax("onScroll");
        })
		
		}
    }

    function jarallaxInit(event) {
	var $container = $( event.target ),
	speed = 1;

        $(".top-slideshow .cover-wrapper:not(.slide-video)").each(function() {
		if ( $( this ).attr( 'data-parallax' ) == 'parallax-enabled' ) {
		speed = 0.73;
		
            $(this).jarallax({
                speed: speed,
                elementInViewport: $container,
				noIos: false,
				imgPosition: '50% 0%'
				
            })
			}
        }), $(".top-slideshow .cover-wrapper.slide-video" ).each(function() {
            if ( $( this ).attr( 'data-parallax' ) == 'parallax-enabled' ) {
		speed = 0.83;
		}
		if ( $( this ).attr( 'data-videoplayback' ) == 'video-playback-on' ) {
		
            $(this).jarallax({
                videoSrc: $(this).data("video"),
                videoStartTime: $(this).data("videostart"),
                videoEndTime: $(this).data("videoend"),
                videoPlayOnlyVisible: true,
				elementInViewport: $container,
                speed: speed,
				noIos: false,
            })
			}else{
			$(this).jarallax({
                speed: speed,
                elementInViewport: $container,
				noIos: false,
            })
			}
        });
		
    }
	

		
	function owlCarouselRefresh() {
        $('div[id^="owl-carousel-"]').each(function() {
	$(this).trigger("refresh.owl.carousel");

        });
	}
    function owlCarousel() {
  
  
        $('div[id^="owl-carousel-"]').each(function() {
            var carousel = $(this),
			
                auto_play = carousel.attr('data-auto-play') == 'true' ? true : false,
                center_mode = carousel.attr('data-center') == 'true' ? true : false,
                auto_play_timeout = parseInt(carousel.attr('data-auto-play-timeout')),
                items_desktop = parseInt(carousel.attr('data-items')),
                data_howmany = parseInt(carousel.attr('data-howmany')),
                items_tablet = parseInt(carousel.attr('data-tablet')),
                items_mobile = parseInt(carousel.attr('data-mobile')),
                margin_val = parseInt(carousel.attr('data-margin')),
                display_navs = carousel.attr('data-nav') == 'true' ? true : false,
                rtl_mode = carousel.attr('data-rtl') == 'true' ? true : false,
                display_pagination = carousel.attr('data-pagination') == 'true' ? true : false,
                auto_height = items_desktop <= 1 ? true : false,
                data_howmany_count = data_howmany <= 1 ? false : true;

            $(carousel).owlCarousel({
                autoplay: auto_play,
                autoplayTimeout: auto_play_timeout,
                loop: data_howmany_count,
                margin: margin_val,
                smartSpeed: 600,
                responsiveRefreshRate: 10,
				responsiveClass: true,
				lazyLoad: false,
                nav: display_navs,
                rtl: rtl_mode,
                autoplayHoverPause: true,
                dots: display_pagination,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                items: false,
                responsive: {
				0: {
					items: 1,
					loop: false,
					margin: 0,
					dots: true,
					nav: false,
						center: center_mode
				},
				    480: {
                        items: items_mobile,
						center: center_mode
                    },
                    767: {
                        items: items_mobile,
						center: center_mode
                    },
                    992: {
                        items: items_tablet,
						center: center_mode
                    },
                    1200: {
                        items: items_desktop,
						autoWidth:center_mode,
						center: center_mode
                    }
                },
                onInitialized: jarallaxInit,
                onResized: jarallaxResize,
				onDrag: jarallaxResize,
				onDragged: jarallaxResize
            });
			


        });
        $('.owl-prev').addClass('icon-chevron-left');
        $('.owl-next').addClass('icon-chevron-right');
    }
	
	function singlenextpost() {
	            if ( $('body').hasClass( 'single-post' ) ) {

                var $entry_content               = $( '.post_content' ),
                    $entry_looks                 = $( '.single-next-trigger' ),
                    $next_post                   = $( '.single-next-post' );
                    

                if ( $entry_looks.length ) {

                    var $entry_content_from_top      = $entry_content.offset().top,
                        $entry_looks_from_top        = $entry_looks.offset().top;

                    if ( $(window).scrollTop() > $entry_content_from_top ) {

                        

                        if ( $(window).scrollTop() > $entry_looks_from_top - $(window).height() ) {
                         
                            if ( !$next_post.hasClass( 'shows' ) ) {
                                $next_post.addClass('shows');
                            }
                        } else {
                            
                            if ( $next_post.hasClass( 'shows' ) ) {
                                $next_post.removeClass('shows');
                            }
                        }

                    } 

                }

            }
	}

$(window).smartresize(function(){
owlCarouselRefresh();
jarallaxResize();
});

    $(document).ready(function() {
		
		
        $(".search-icon, .closeit").click(function() {
            $(".top-panel22").slideToggle("600", "easeInOutCirc", function() {
                if ($(this).is(':visible')) {
                    $(".sb-search-input").focus();
                }
            });
        });

		
        $('.parallax-enabled:not(.parallax-video).headerstyler').each(function() {
            $(this).jarallax({
            speed: 0.8,
            type: 'scroll',
            zIndex: 0
                   })
        });
        $(".parallax-enabled.parallax-image").each(function() {
            $(this).jarallax({
                speed: 0.8,
                type: 'scroll',
                zIndex: -1,
				imgPosition: '50% 0%'
            })
        });
		
				var parallaxVideo = $( '.parallax-video' ),
			speed = 0.8;

		if ( $( 'header' ).hasClass( 'parallax-disabled' ) ) {
			speed = 1;
		}

		$( parallaxVideo ).each( function() {

			$( this ).jarallax( {
				speed: speed,
				videoSrc: $( this ).attr( 'data-video' ),
				videoStartTime: $( this ).data( 'start' ),
				videoEndTime: $( this ).data( 'end' ),
				autoplay: 1,
                loop: 1,
				videoPlayOnlyVisible: true,
				noIos: false,
			} );

		} );
		
		
		var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
		 if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
    {
         } else {
        if ($('.sidebar.sticky-sidebar').length) {
            $('.sidebar.sticky-sidebar').theiaStickySidebar({
                containerSelector: '.main-blog',
                additionalMarginTop: 120,
                minWidth: 961,
            });
        }
        if ($('.vertical-share').length) {
            $('.vertical-share').theiaStickySidebar({
                containerSelector: '.post_content',
                additionalMarginTop: 170,
                minWidth: 961,
				defaultPosition: 'absolute'
            });
        }
		}
        justifiedgalleryInit();
        owlCarousel();
       audioPlayerInit();
	   
        if (inf_var.pagination_type === "loadmore" && inf_var.issingle === "false" || inf_var.pagination_type === "infinite" && inf_var.issingle === "false" || inf_var.single_pagination_type === "infinite" && inf_var.issingle === "true"  ) {
            ajaxLoadMoreButton();
        }
        magnificPopupLoad();

        var newsletter = $('#hs_signup'),
            newsletterload = newsletter.attr('data-showonload');
        if (newsletterload == 'true') {
            setTimeout(checkCookie, 5000);
        }

        if ($().doubleTouchToGo) {
            $('#primary-menu li.menu-item-has-children, #primary-menu li.has-mega-sub-menu, #top-menu li.menu-item-has-children').doubleTouchToGo();
        } // doubleTouchToGo

        if ($('.menu-mobile').length) {
            $('.menu-mobile').navAccordion({
                expandButtonText: '<i class="fa fa-angle-right"></i>',
                collapseButtonText: '<i class="fa fa-angle-down"></i>'
            });
        }
		/**
        if ($('.widget_nav_menu').length) {
            $(".widget_nav_menu").each(function() {
                $(this).navAccordion({
                    expandButtonText: '<i class="fa fa-angle-right"></i>',
                    collapseButtonText: '<i class="fa fa-angle-up"></i>'
                })
            });
        }
     */

        //Zoom fix
        // IPad/IPhone
        var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
            ua = navigator.userAgent,

            gestureStart = function() {
                viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
            },

            scaleFix = function() {
                if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                    viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                    document.addEventListener("gesturestart", gestureStart, false);
                }
            };
        scaleFix();

        // ---------------------------------------------------------
        // Tooltip
        // ---------------------------------------------------------
        $("[data-rel='tooltip']").tooltip();
        // ---------------------------------------------------------
        // Back to Top
        // ---------------------------------------------------------
        $(window).scroll(function() {
		
		singlenextpost();
            if ($(this).scrollTop() > 300) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });
        $('#back-top a').click(function() {
            $('body,html').stop(false, false).animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        $('.skills').appear(function() {
            $(".chart").each(function() {
                var size = $(this).attr('data-size');
                var fgcolor = $(this).attr('data-fgcolor');
                var bgcolor = $(this).attr('data-bgcolor');
                var donutwidth = $(this).attr('data-donutwidth');
                $(this).easyPieChart({
                    easing: 'easeInOutQuad',
                    barColor: fgcolor,
                    animate: 2000,
                    trackColor: bgcolor,
                    lineWidth: donutwidth,
                    lineCap: 'square',
                    size: size,
                    scaleColor: false,
					  onStep: function(from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent));
                    }
                });
            });
        });

        $('.bars').appear(function() {
            $('.progress').each(function() {
                var percentage = $(this).find('.bar').attr('data-progress');
                $(this).find('.bar').css('width', '0%');
                $(this).find('.bar').animate({
                    width: percentage + '%'
                }, {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                });
            });
        });

        // ---------------------------------------------------------
        // placeholder fix
        $('[placeholder]').focus(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function() {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur().parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            })
        });
		
		    masonryStart();

    });
	
document.addEventListener('lazybeforeunveil', function(e){
    var bg = e.target.getAttribute('data-bg');
    if(bg){
        e.target.style.backgroundImage = 'url(' + bg + ')';
    }
});

    

    function magnificPopupLoad() {
	

				$('.lightbox-gallery-link').each(function() {
					var _this = $(this),
						items = [],
						target = $( _this.attr('href') );
						
					target.find('.post-gallery-content').each(function() {
						items.push({
							src: $(this),
type: 'inline'							
						});
					});
					
					_this.on('click', function() {
						$.magnificPopup.open({
							midClick: true,
							mainClass: 'mfp-zoom-in',
							removalDelay: 300,
							closeBtnInside: true,
							items: items,
							overflowY: 'hidden',
							verticalFit: true,
							gallery: {
								enabled: true,
								arrowMarkup: '<i class="mfp-arrow mfp-arrow-%dir%"></i>',
							},
                  callbacks: {
            open: function() {
			var self = this;

					self.wrap.find('.mfp-container').addClass('mfp-image-holder');
					setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 300);
					
                $.magnificPopup.instance.next = function() {
				
                    var self = this;
					 self.wrap.removeClass('mfp-image-loaded');
				$.magnificPopup.proto.next.call(	
setTimeout(function() {
        self.wrap.addClass('mfp-image-loaded');
      }, 400));

                   
                }
                $.magnificPopup.instance.prev = function() {
				
                    var self = this;
					self.wrap.removeClass('mfp-image-loaded');
                  				$.magnificPopup.proto.prev.call(	
setTimeout(function() {
        self.wrap.addClass('mfp-image-loaded');
      }, 400));
                    
                }
            }
	
        }
						});
						return false;
					});
					
				});
	

	

        $('.popup-youtube, .popup-vimeo, .popup-gmaps').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                disableOn: 320,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 300,
                preloader: false,
                fixedContentPos: true,
            fixedBgPos: true,
                iframe: {
                    patterns: {
                        youtube: {
                            index: 'youtube.com/',
                            id: null,
                            src: '%id%?autoplay=1'
                        },
                        vimeo: {
                            index: 'vimeo.com/',
                            id: function(url) {
                                var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                                if (!m || !m[5]) return null;
                                return m[5];
                            },
                            src: '//player.vimeo.com/video/%id%?autoplay=1'
                        }
                    }
                }
            });
        });

        $('.newsletter-ajax-popup').magnificPopup({
            type: 'inline',
            tClose: '',
            fixedContentPos: true,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in newsletter-ajax'
        });
		
		    $('.magnificpopup-enabled').find('.post__holder .isopad a:not(.nolightbox)').each(function(i, el){
      var href_value = el.href;
      if (/\.(jpg|jpeg|png|gif)$/.test(href_value)){
        $(this).magnificPopup({
            tClose: '',
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
			removalDelay: 300,
            mainClass: 'mfp-zoom-in',  
                    image: {
markup: 
            '<div class="mfp-wrapper"><div class="mfp-contain"><div class="mfp-bottom-bar">'+
              '<div class="mfp-title"></div>'+
              '<div class="mfp-counter"></div>'+
            '</div>'+
'<div class="mfp-figure">'+
            '<div class="mfp-img"></div>'+
          '</div></div></div>',
                        verticalFit: true,
                        titleSrc: function(item) {
                            var caption = item.el.find('img').attr('alt');
							return caption;
                        }
                    },
                  callbacks: {
            open: function() {
                //overwrite default prev + next function. Add timeout for css3 crossfade animation
                $.magnificPopup.instance.next = function() {
                    var self = this;
                    self.wrap.removeClass('mfp-image-loaded');
                    setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);
                }
                $.magnificPopup.instance.prev = function() {
                    var self = this;
                    self.wrap.removeClass('mfp-image-loaded');
                    setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);
                }
            },
            imageLoadComplete: function() { 
                var self = this;
                setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
            }
        }
        });
      }
    });
	
        $('.image-popup-no-margins').magnificPopup({
            tClose: '',
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            removalDelay: 300,
            mainClass: 'mfp-zoom-in',
            image: {
			markup: 
            '<div class="mfp-wrapper"><div class="mfp-contain"><div class="mfp-bottom-bar">'+
              '<div class="mfp-title"></div>'+
            '</div>'+
'<div class="mfp-figure">'+
            '<div class="mfp-img"></div>'+
          '</div></div></div>',
                verticalFit: true,
				                        titleSrc: function(item) {
                            var caption = item.el.find('img').attr('alt');
							return caption;
                        }
            },
            callbacks: {
                imageLoadComplete: function() { 
                var self = this;
                setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
            }
            }
        });
        $('.zoom-gallery').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                tClose: '',
                delegate: 'a.zoomer',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: true,
                mainClass: 'mfp-zoom-in',
				removalDelay: 300,
				closeMarkup: '<span title="%title%" class="mfp-close">x</span>',
                image: {
				markup: 
            '<div class="mfp-wrapper"><div class="mfp-counter"></div><div class="mfp-contain"><div class="mfp-bottom-bar">'+
              '<div class="mfp-title"></div>'+
            '</div>'+
'<div class="mfp-figure">'+
            '<div class="mfp-close"></div>'+
            '<div class="mfp-img"></div>'+
          '</div></div></div>',
                    verticalFit: true,
                    titleSrc: function(item) {
                        var caption = item.el.attr('title');
                        return caption;
                        
                    }
                },
                gallery: {
                    enabled:true,
			tCounter: '%curr%/%total%',
			arrowMarkup: '<i class="mfp-arrow mfp-arrow-%dir%"></i>',
                },
                  callbacks: {
            open: function() {
                //overwrite default prev + next function. Add timeout for css3 crossfade animation
                $.magnificPopup.instance.next = function() {
                    var self = this;
                    self.wrap.removeClass('mfp-image-loaded');
                    setTimeout(function() { $.magnificPopup.proto.next.call(self); }, 120);
                }
                $.magnificPopup.instance.prev = function() {
                    var self = this;
                    self.wrap.removeClass('mfp-image-loaded');
                    setTimeout(function() { $.magnificPopup.proto.prev.call(self); }, 120);
                }
            },
            imageLoadComplete: function() { 
                var self = this;
                setTimeout(function() { self.wrap.addClass('mfp-image-loaded'); }, 16);
            }
        }
            });
        });
        $('.popup-with-zoom-anim').magnificPopup({
            tClose: '',
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in',
            focus: '.sb-search-input',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function() {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '.sb-search-input';
                    }
                },
                afterClose: function() {

                }
            }
        });
    }

    function ajaxLoadMoreButton() {

        var hrs = $.hrs({
            container: ".ajax-container",
            item: ".ajax-post-wrapper",
            pagination: ".ajax-pagination-container",
            next: "#ajax-load-more-posts-button",
        });

        if ($('.grid:not(.widget-loop)')[0]) {
            hrs.on('render', function(items) {
                $(items).css({
                    opacity: 0
                });

            });
        }

        hrs.on('rendered', function(items) {
            magnificPopupLoad();
            justifiedgalleryInit();
            owlCarousel();
			audioPlayerInit();
			
           
        $(".parallax-enabled.parallax-image").each(function() {
            $(this).jarallax({
                speed: 0.8,
                type: 'scroll',
                zIndex: -1,
				imgPosition: '50% 0%'
            })
        });
		var parallaxVideo = $( '.parallax-video' ),
			speed = 0.8;

		$( parallaxVideo ).each( function() {

			$( this ).jarallax( {
				speed: speed,
				videoSrc: $( this ).attr( 'data-video' ),
				videoStartTime: $( this ).data( 'start' ),
				videoEndTime: $( this ).data( 'end' ),
				autoplay: 1,
                loop: 1,
				videoPlayOnlyVisible: true,
				noIos: true,
			} );

		} );
		
		$('[data-herculesdesign-parallax]' ).each( function(){
		$( this ).herculesDesignParallax( $( this ).data('herculesdesign-parallax') );
	} );
		        if ($('.vertical-share').length) {
            $('.vertical-share').theiaStickySidebar({
                containerSelector: '.post_content',
                additionalMarginTop: 170,
                minWidth: 961,
				defaultPosition: 'absolute'
            });
        }
		
			var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
    {
         } else {
        if ($('.sidebar.sticky-sidebar').length) {
            $('.sidebar.sticky-sidebar').theiaStickySidebar({
                containerSelector: '.main-blog',
                additionalMarginTop: 120,
                minWidth: 961,
            });
        }
		}
            if ($('.grid:not(.widget-loop)')[0]) {
                $('.grid:not(.widget-loop)').masonry('appended', items, true);
            }
        });

        hrs.extension(new HRSNoneLeftExtension({
            text: inf_var.you_reached_the_end,
        }));
		
		if (inf_var.issingle != "true") {
        if (inf_var.pagination_type === "loadmore") {

            hrs.extension(new HRSTriggerExtension({
                text: inf_var.load_more,
                offset: inf_var.offset,
                html: '<div class="row pagination-below"><div class="col-md-12"><div class="ajax-pagination"><div class="ajax-loader"></div><a id="ajax-load-more-posts" class="btn btn-default btn-normal">{text}</a></div></div></div>'
            }));
        }}
        hrs.extension(new HRSSpinnerExtension({
            html: '<div class="row pagination-below"><div class="col-md-12"><div class="ajax-pagination"><div class="ajax-loader loading"><svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve"> <path fill="#222" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"> <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="0.5s" from="0 50 50" to="360 50 50" repeatCount="indefinite"/> </path></svg></div></div></div></div>'
        }));
    }
}(jQuery));