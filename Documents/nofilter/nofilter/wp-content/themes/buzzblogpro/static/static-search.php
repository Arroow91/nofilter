<?php /* Static Name: Search */ ?> 

					
<div id="search-lightbox-wrap">
	<div class="search-lightbox">
		<div id="searchform-wrap">
				<div class="sb-search">
						<form id="searchform" class="" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" accept-charset="utf-8">
							<input class="sb-search-input" placeholder="<?php echo theme_locals("search_term"); ?>" type="text" value="<?php echo get_search_query(); ?>" id="s" name="s" autofocus><a class="closeit" href="#"><i class="hs hs-cancel"></i></a>
						</form>
					</div>
		</div>
	
		<div class="container"><div class="row"><div class="col-md-12"><div class="search-results-wrap"></div></div></div></div>
	</div>
	<i id="close-search-box"></i>
</div>