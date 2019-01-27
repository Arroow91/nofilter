function magnificPopupLoad(){
 
 jQuery('.popup-youtube, .popup-vimeo').each(function() { // the containers for all your galleries
    jQuery(this).magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false,
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
                    if ( !m || !m[5] ) return null;
                    return m[5];
                },
                src: '//player.vimeo.com/video/%id%?autoplay=1'
            }
        }
    }
	});
	});
	}


function hs_recent_popular_tab_loadTabContent(tab_name, page_num, container, args_obj) {
    
    var container = jQuery(container);
    var tab_content = container.find('[data-id="'+tab_name+'-tab-content"]');
        
    // only load content if it wasn't already loaded
    var isLoaded = tab_content.data('loaded');
    
    if (!isLoaded || page_num != 1) {
        if (!container.hasClass('hs-recent-popular-tab-loading')) {
            container.addClass('hs-recent-popular-tab-loading');
            
            tab_content.load(hs_recent_popular_tab.ajax_url, {
                    action: 'hs_recent_popular_tab_widget_content',
                    tab: tab_name,
                    page: page_num,
                    args: args_obj
                }, function() {
                    container.removeClass('hs-recent-popular-tab-loading');
                    tab_content.data('loaded', 1).hide().fadeIn().siblings().hide();
					magnificPopupLoad(); 
                }
            );
        }
    } else {
        tab_content.fadeIn().siblings().hide();
		
    }
	
}

jQuery(document).ready(function() {
    jQuery('.hs_recent_popular_tab_widget_content').each(function() {
        var $this = jQuery(this);
        var widget_id = this.id;
        var args = $this.data('args');
        
        // load tab content on click
        $this.find('.hs-recent-popular-tabs a').click(function(e) {
            e.preventDefault();
            jQuery(this).parent().addClass('selected').siblings().removeClass('selected');
            var tab_name = jQuery(this).attr("data-id").slice(0, -4); // -tab
            hs_recent_popular_tab_loadTabContent(tab_name, 1, $this, args);
        });
        
        // pagination
        $this.on('click', '.hs-recent-popular-tab-pagination a', function(e) {
            e.preventDefault();
            var $this_a = jQuery(this);
            var tab_name = $this_a.closest('.tab-content').attr('data-id').slice(0, -12); // -tab-content
            var page_num = parseInt($this_a.closest('.tab-content').children('.page_num').val());

            if ($this_a.hasClass('next')) {
                hs_recent_popular_tab_loadTabContent(tab_name, page_num + 1, $this, args);
            } else {
                $this.find('[data-id="'+tab_name+'-tab-content"]').data('loaded', 0);
                hs_recent_popular_tab_loadTabContent(tab_name, page_num - 1, $this, args);
            }
            
        });
        
        // load first tab now
        $this.find('.hs-recent-popular-tabs a').first().click();
    });
    
});