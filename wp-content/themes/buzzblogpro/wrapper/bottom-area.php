<?php if ( buzzblogpro_getVariable('bottom_layout') == 'onecolumn') { ?>  
<?php if ( is_active_sidebar( 'hs_bottom_1' ) ) : ?>
<div class="bottom1">
<div class="container">
<div class="row bottom1-widgets">
    <div class="col-md-12">
        <?php dynamic_sidebar("hs_bottom_1"); ?>
    </div>
</div>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'hs_bottom_2' ) ) : ?>
<div class="bottom2">
<div class="container">
<div class="row bottom2-widgets">
    <div class="col-md-12">
        <?php dynamic_sidebar("hs_bottom_2"); ?>
    </div>
</div>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'hs_bottom_3' ) ) : ?>
<div class="bottom3">
<div class="container">
<div class="row bottom3-widgets">
    <div class="col-md-12">
        <?php dynamic_sidebar("hs_bottom_3"); ?>
    </div>
</div>
</div>
</div>
<?php endif; ?>
<?php } else { ?> 
<?php if ( is_active_sidebar( 'hs_bottom_1' ) || is_active_sidebar( 'hs_bottom_2' ) || is_active_sidebar( 'hs_bottom_3' ) ) : ?>
<div class="bottom-widgets-column">
<div class="container">
<div class="row">

    <div class="col-md-4 bottom1-widgets-column">
	<?php if ( is_active_sidebar( 'hs_bottom_1' ) ) :
         dynamic_sidebar("hs_bottom_1"); 
		 endif; ?>
    </div>

   <div class="col-md-4 bottom2-widgets-column">
	<?php if ( is_active_sidebar( 'hs_bottom_2' ) ) :
         dynamic_sidebar("hs_bottom_2"); 
		 endif; ?>
    </div>

   <div class="col-md-4 bottom3-widgets-column">
	<?php if ( is_active_sidebar( 'hs_bottom_3' ) ) :
         dynamic_sidebar("hs_bottom_3"); 
		 endif; ?>
    </div>
</div>
</div>
</div>
<?php endif; ?>
<?php } ?> 