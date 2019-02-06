<?php
	if (has_nav_menu('mobile_menu')) { ?>
<div class="menu-container">
    <div class="menu-mobile">
      <?php wp_nav_menu( array('theme_location' => 'mobile_menu') ); ?>
    </div>
</div>
<?php } ?>