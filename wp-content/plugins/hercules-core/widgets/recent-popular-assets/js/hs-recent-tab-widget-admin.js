jQuery(document).on('click', function(e) {
    var $this = jQuery(e.target);
    var $form = $this.closest('.hs_recent_popular_tab_options_form');
    
    if ($this.is('.hs_recent_popular_tab_enable_mostpopular')) {
        $form.find('.hs_recent_popular_tab_mostpopular_order').slideToggle($this.is(':checked'));
        $form.find('.hs_recent_popular_tab_mostpopular_title').slideToggle($this.is(':checked'));
    } else if ($this.is('.hs_recent_popular_tab_enable_recent')) {
        $form.find('.hs_recent_popular_tab_recent_order').slideToggle($this.is(':checked'));
        $form.find('.hs_recent_popular_tab_recent_title').slideToggle($this.is(':checked'));
	} else if ($this.is('.hs_recent_popular_tab_enable_trending')) {
        $form.find('.hs_recent_popular_tab_trending_order').slideToggle($this.is(':checked'));
        $form.find('.hs_recent_popular_tab_trending_title').slideToggle($this.is(':checked'));
    }  else if ($this.is('.hs_recent_popular_tab_enable_custom')) {
        $form.find('.hs_recent_popular_tab_custom_order').slideToggle($this.is(':checked'));
        $form.find('.hs_recent_popular_tab_custom_title').slideToggle($this.is(':checked'));
        $form.find('.hs_recent_popular_tab_custom_posts').slideToggle($this.is(':checked'));
	}  else if ($this.is('.hs_recent_popular_tab_enable_mostcommented')) {
        $form.find('.hs_recent_popular_tab_mostcommented_order').slideToggle($this.is(':checked'));
        $form.find('.hs_recent_popular_tab_mostcommented_title').slideToggle($this.is(':checked'));
    } else if ($this.is('.hs_recent_popular_tab_order_header')) {
        e.preventDefault();
        $form.find('.hs_recent_popular_tab_order').slideToggle();
        $form.find('.hs_recent_popular_tab_titles').slideUp();
    } else if ($this.is('.hs_recent_popular_tab_titles_header')) {
        e.preventDefault();
        $form.find('.hs_recent_popular_tab_titles').slideToggle();
        $form.find('.hs_recent_popular_tab_order').slideUp();
    }
});