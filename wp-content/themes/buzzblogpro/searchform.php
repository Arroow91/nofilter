<div class="search-form">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" accept-charset="utf-8" class="custom-search-form form-search form-horizontal">
	<div class="input-append">
		<input type="text" value="<?php the_search_query(); ?>" name="s" class="search-query" placeholder="<?php echo theme_locals("search"); ?>">
		<button type="submit" value="" class="btn"><i class="fa fa-search"></i></button>
		</div>
	</form>
</div>