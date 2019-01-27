<?php /* Loop Name: Gallery */ ?>
<?php // Theme Options vars
$images_per_page = buzzblogpro_getVariable('images_per_page');
$gallery_columns = buzzblogpro_getVariable('gallery_columns');

switch ($gallery_columns) {
    case 2:
        $cols = 'col-xs-12 col-sm-6 col-md-6';
        break;
    case 3:
        $cols = 'col-xs-12 col-sm-4 col-md-4';
        break;
	case 4:
        $cols = 'col-xs-12 col-sm-3 col-md-3';
        break;
}

require_once get_template_directory() . '/gallery-loop.php';