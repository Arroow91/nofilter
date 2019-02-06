<?php
if( !class_exists( 'CMB2_Radio_Image' ) ) {
    /**
     * Class CMB2_Radio_Image
     */
    class CMB2_Radio_Image {
        public function __construct() {
            add_action( 'cmb2_render_radio_image', array( $this, 'callback' ), 10, 5 );
            add_filter( 'cmb2_list_input_attributes', array( $this, 'attributes' ), 10, 4 );
        }
        public function callback($field, $escaped_value, $object_id, $object_type, $field_type_object) {
            echo $field_type_object->radio();
        }
        public function attributes($args, $defaults, $field, $cmb) {
            if ($field->args['type'] == 'radio_image' && isset($field->args['images'])) {
                foreach ($field->args['images'] as $field_id => $image) {
                    if ($field_id == $args['value']) {
                        $image = trailingslashit($field->args['images_path']) . $image;
                        $args['label'] = '<img src="' . $image . '" alt="' . $args['value'] . '" title="' . $args['label'] . '" /><span>' . $args['label'] . '</span>';
                    }
                }
            }
            return $args;
        }
    }
    $cmb2_radio_image = new CMB2_Radio_Image();
}
add_action( 'cmb2_admin_init', 'buzzblogpro_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function buzzblogpro_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_buzzblogpro_';
	/**
	 * Initiate category options
	 */

	$categoryoptions = new_cmb2_box( array(
		'id'            => $prefix . 'category_options',
		'title'         => esc_html__( 'Post Layouts', 'buzzblogpro' ),
		'object_types'     => array( 'term' ), 
		'taxonomies'       => array( 'category' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) ); 

$categoryoptions->add_field( array(
	'name'    => esc_html__( 'Category Image', 'buzzblogpro' ), 
	'desc'    => esc_html__( 'Upload an image', 'buzzblogpro' ), 
	'id'      => $prefix . 'category-image-id',
	'type'    => 'file',
	'options' => array(
		'url' => false,
	),
	'text'    => array(
		'add_upload_file_text' => esc_html__( 'Add the category image', 'buzzblogpro' ),
	),
	'preview_size' => 'thumb', 
) );
	$categoryoptions->add_field( array(
		'name'             => esc_html__( 'Layout options', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Select layout option', 'buzzblogpro' ),
		'id'               => $prefix . 'category_layout_format',
		'type'             => 'radio_image',
		'default'          => 'inherit',
		'options'          => array(
		'inherit'  => esc_html__('Inherit', 'buzzblogpro'),
		'left'  => esc_html__('left sidebar', 'buzzblogpro'),
		'right'  => esc_html__('right sidebar', 'buzzblogpro'),
		'full'  => esc_html__('no sidebar', 'buzzblogpro'),
		'masonry2'  => esc_html__('masonry 2 columns', 'buzzblogpro'),
		'masonry3'  => esc_html__('masonry 3 columns', 'buzzblogpro'),
		
		    'masonry4'  => esc_html__('masonry 4 columns', 'buzzblogpro'),
			'masonry2sideleft'  => esc_html__('masonry 2 columns sidebar left', 'buzzblogpro'),
			'masonry2sideright'  => esc_html__('masonry 2 columns sidebar right', 'buzzblogpro'),
			'listpostsideright'  => esc_html__('list view sidebar right', 'buzzblogpro'),
			'listpostsideleft'  => esc_html__('list view sidebar left', 'buzzblogpro'),
			'listpostfullwidth'  => esc_html__('list view no sidebar', 'buzzblogpro'),
			'zigzagfullwidth'  => esc_html__('zigzag view no sidebar', 'buzzblogpro'),
			'zigzagsideright'  => esc_html__('zigzag view right sidebar', 'buzzblogpro'),
			'zigzagsideleft'  => esc_html__('zigzag view left sidebar', 'buzzblogpro'),
		),
		'images_path'      => get_template_directory_uri(),
		'images'           => array(
		'inherit'    => 'includes/admin/posts-metabox-image/inherit.png',
		    'left'    => 'includes/images/2cl.png',
			'right'    => 'includes/images/2cr.png',
			'full'  => 'includes/images/1col.png',
			'masonry2'  => 'includes/images/masonry2.png',
			'masonry3'  => 'includes/images/masonry3.png',
			'masonry4'  => 'includes/images/masonry4.png',
			'masonry2sideleft'  => 'includes/images/masonry2-leftsidebar.png',
			'masonry2sideright'  => 'includes/images/masonry2-rightsidebar.png',
			'listpostsideright'  => 'includes/images/listpost-rightsidebar.png',
			'listpostsideleft'  => 'includes/images/listpost-leftsidebar.png',
			'listpostfullwidth'  => 'includes/images/listpost-fullwidth.png',
			'zigzagfullwidth'  => 'includes/images/zigzag-fullwidth.png',
			'zigzagsideright'  => 'includes/images/zigzag-right-sidebar.png',
			'zigzagsideleft'  => 'includes/images/zigzag-left-sidebar.png',
		)
	) );
$categoryoptions->add_field( array(
		'name'       => esc_html__( 'Available sidebars', 'buzzblogpro' ),
		'desc'       => wp_kses( sprintf( __( 'Choose the sidebar to display. If you wish to generate additional sidebars, you can do it, in the <a href="%s">Apperance -> Theme Options</a> panel.', 'buzzblogpro' ), admin_url('admin.php?page=buzzblogpro_options_options&tab=18') ), wp_kses_allowed_html( 'post' ) ),
		'id'         => $prefix . 'category_availablesidebars',
		'type'       => 'select',
		'options_cb'     => 'buzzblogpro_get_sidebars_list',
		'default'          => 'hs_main_sidebar',
	) );
$categoryoptions->add_field( array(
	'name'    => 'Category color',
	'id'      => $prefix . 'category_color',
	'type'    => 'colorpicker',
	'default' => '',
) );
$categoryoptions->add_field( array(
	'name'    => 'Category background color',
	'id'      => $prefix . 'category_bg_color',
	'type'    => 'colorpicker',
	'default' => '',
) );
	/**
	 * Initiate sidebar options
	 */
	 
	$secondfeaturedimage = new_cmb2_box( array(
		'id'            => 'second_featured_image_box',
		'title'         => esc_html__( 'Featured Image 2', 'buzzblogpro' ),
		'object_types'  => array( 'post' ),
        'context' => 'side',
	    'priority' => 'low',
		'show_names'    => false,
	) );
	
	$secondfeaturedimage->add_field( array(
	'name'    => 'Featured Image 2',
	'desc'    => 'Upload an image',
	'id'      => $prefix . 'second_featured_image',
	'type'    => 'file',
	'options' => array(
		'url' => false,
	),
	'text'    => array(
		'add_upload_file_text' => 'Add a second featured image'
	),
	'preview_size' => 'medium',
) );
	$secondfeaturedimage->add_field( array(
	'name'    => esc_html__('Featured Image 2 Width','buzzblogpro'),
	'desc'    => esc_html__('The preferred width of the Featured Image 2','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'second_featured_image_width',
	'type'    => 'text_small'
) );
	$secondfeaturedimage->add_field( array(
	'name'    => esc_html__('Featured Image 2 Height','buzzblogpro'),
	'desc'    => esc_html__('The preferred height of the Featured Image 2','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'second_featured_image_height',
	'type'    => 'text_small'
) );
$secondfeaturedimage->add_field( array(
		'name'             => esc_html__( 'Crop', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Do you want to crop the photo?', 'buzzblogpro' ),
		'id'               => $prefix . 'second_featured_image_crop',
		'default' => '1',
	    'type' => 'checkbox',
	) );
	
	
	$sidebaroptions = new_cmb2_box( array(
		'id'            => 'sidebar_options',
		'title'         => esc_html__( 'Sidebar options', 'buzzblogpro' ),
		'object_types'  => array( 'post' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
    
	$sidebaroptions->add_field( array(
		'name'             => esc_html__( 'Sidebar position', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Select sidebar position', 'buzzblogpro' ),
		'id'               => $prefix . 'sidebarposition',
		'type'             => 'radio_image',
		'default'          => 'inherit',
		'options'          => array(
		    'inherit'    => esc_html__('Inherit', 'buzzblogpro'),
			'none'    => esc_html__('Full Width', 'buzzblogpro'),
			'left'  => esc_html__('Left Sidebar', 'buzzblogpro'),
			'right' => esc_html__('Right Sidebar', 'buzzblogpro'),
		),
		'images_path'      => get_template_directory_uri(),
		'images'           => array(
		    'inherit'    => 'includes/admin/posts-metabox-image/inherit.png',
			'none'    => 'includes/admin/posts-metabox-image/post-side-none.png',
			'left'  => 'includes/admin/posts-metabox-image/post-side-left.png',
			'right' => 'includes/admin/posts-metabox-image/post-side-right.png',
		)
	) );
	
	// Regular text field
	$sidebaroptions->add_field( array(
		'name'       => esc_html__( 'Available sidebars', 'buzzblogpro' ),
		'desc'       => wp_kses( sprintf( __( 'Choose the sidebar to display. If you wish to generate additional sidebars, you can do it, in the <a href="%s">Apperance -> Theme Options</a> panel.', 'buzzblogpro' ), admin_url('admin.php?page=buzzblogpro_options_options&tab=18') ), wp_kses_allowed_html( 'post' ) ),
		'id'         => $prefix . 'availablesidebars',
		'type'       => 'select',
		'options_cb'     => 'buzzblogpro_get_sidebars_list',
		'default'          => 'hs_main_sidebar',
	) );
/**
* Initiate layout options
*/
	$layoutoptions = new_cmb2_box( array(
		'id'            => 'layout_options',
		'title'         => esc_html__( 'Single Post Layouts', 'buzzblogpro' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
    $layoutoptions->add_field( array(
	'name'    => esc_html__('Intro text','buzzblogpro'),
	'desc'    => esc_html__('Enter intro text','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'post_intro_text',
		'type'    => 'textarea',
) );
	$layoutoptions->add_field( array(
		'name'             => esc_html__( 'Layout options', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Select layout option', 'buzzblogpro' ),
		'id'               => $prefix . 'standard_layout_format',
		'type'             => 'radio_image',
		'default'          => 'inherit',
		'options'          => array(
		    'inherit'  => esc_html__('Inherit', 'buzzblogpro'),
			'layout1'  => esc_html__('Layout 1', 'buzzblogpro'),
			'layout2'  => esc_html__('Layout 2', 'buzzblogpro'),
			'layout3'  => esc_html__('Layout 3', 'buzzblogpro'),
			'layout4'  => esc_html__('Layout 4', 'buzzblogpro'),
			'layout5'  => esc_html__('Layout 5', 'buzzblogpro'),
			'layout6'  => esc_html__('Layout 6', 'buzzblogpro'),
			'layout7'  => esc_html__('Layout 7', 'buzzblogpro'),
			'layout8'  => esc_html__('Layout 8', 'buzzblogpro'),
		),
		'images_path'      => get_template_directory_uri(),
		'images'           => array(
		    'inherit'    => 'includes/admin/posts-metabox-image/inherit.png',
			'layout1'    => 'includes/admin/posts-metabox-image/layout1.png',
			'layout2'  => 'includes/admin/posts-metabox-image/layout2.png',
			'layout3'  => 'includes/admin/posts-metabox-image/layout3.png',
			'layout4'  => 'includes/admin/posts-metabox-image/layout4.png',
			'layout5'  => 'includes/admin/posts-metabox-image/layout5.png',
			'layout6'  => 'includes/admin/posts-metabox-image/layout6.png',
			'layout7'  => 'includes/admin/posts-metabox-image/layout7.png',
			'layout8'  => 'includes/admin/posts-metabox-image/layout8.png',
		)
	) );
$layoutoptions->add_field( array(
		'name'             => esc_html__( 'Parallax', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Enable Parallax For Layout 5', 'buzzblogpro' ),
		'id'               => $prefix . 'post_enable_parallax',
		'default' => '1',
	    'type' => 'checkbox',
	) );
$layoutoptions->add_field( array(
		'name'             => esc_html__( 'Overlay mode', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Enable overlay mode for the post visible on the blog page.', 'buzzblogpro' ),
		'id'               => $prefix . 'post_enable_overlay_mode',
		'default' => '0',
	    'type' => 'checkbox',
	) );
$layoutoptions->add_field( array(
		'name'             => esc_html__( 'Content width', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Select content width', 'buzzblogpro' ),
		'id'               => $prefix . 'content_width',
		'type'             => 'radio_image',
		'default'          => 'normal',
		'options'          => array(
		    'normal'    => esc_html__('Normal', 'buzzblogpro'),
			'narrow' => esc_html__('Narrow', 'buzzblogpro'),
		),
		'images_path'      => get_template_directory_uri(),
		'images'           => array(
		    'normal'    => 'includes/admin/posts-metabox-image/normal.png',
			'narrow' => 'includes/admin/posts-metabox-image/post-side-narrow.png',
		)
	) );
/**
* Initiate gallery settings 
*/
$postformatsettings = new_cmb2_box( array(
		'id'            => $prefix . 'post-formats-settings',
		'title'         => esc_html__( 'Post format settings', 'buzzblogpro' ),
		'object_types'  => array( 'post' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
		        'tabs'      => array(
            'gallery' => array(
                'label' => __('Gallery', 'buzzblogpro'),
                 'icon'  => 'dashicons-format-gallery', 
				 'show_on_cb' => 'cmb2_tabs_show_if_front_page',
            ),
            'link'  => array(
                'label' => __('Link', 'buzzblogpro'),
                'icon'  => 'dashicons-admin-links',
            ),
            'quote'    => array(
                'label' => __('Quote', 'buzzblogpro'),
                'icon'  => 'dashicons-format-quote', 
            ),
			'audio'    => array(
                'label' => __('Audio', 'buzzblogpro'),
                'icon'  => 'dashicons-format-audio', 
            ),
			'video'    => array(
                'label' => __('Video', 'buzzblogpro'),
                'icon'  => 'dashicons-format-video', 
            ),
        ),
		'tab_style'   => 'default',
	) );
	
$postformatsettings->add_field( array(
	'name' => esc_html__('Images','buzzblogpro'),
	'desc' => '',
	'id'   => '_format_gallery_images',
	'type' => 'file_list',
	'preview_size' => array( 150, 150 ),
	'query_args' => array( 'type' => 'image' ),
	'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
	'text' => array(
		'add_upload_files_text' => esc_html__('Pick Images','buzzblogpro'),
	),
) );
$postformatsettings->add_field( array(
	'name'             => esc_html__('Gallery type','buzzblogpro'),
	'desc'             => esc_html__('Choose gallery type.','buzzblogpro'),
	'id'               => 'buzzblogpro_gallery_format',
	'type'             => 'select',
	'show_option_none' => true,
	'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
	'default'          => 'grid',
	'options'          => array(
		'slideshow'   => esc_html__('slideshow', 'buzzblogpro'),
		'grid'     => esc_html__('grid', 'buzzblogpro'),
		'lightboxgallery'     => esc_html__('lightbox gallery', 'buzzblogpro'),
	),
) );
$postformatsettings->add_field( array(
	'name'    => esc_html__('Row Height','buzzblogpro'),
	'desc'    => esc_html__('The preferred height of rows in pixel.','buzzblogpro'),
	'default' => '200',
	'id'      => 'buzzblogpro_gallery_targetheight',
	'type'    => 'text_small',
	'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name'    => esc_html__('Row Height on Single Post Page','buzzblogpro'),
	'desc'    => esc_html__('The preferred height of rows in pixel on Single Post Page.','buzzblogpro'),
	'default' => '200',
	'id'      => 'buzzblogpro_gallery_targetheight_single',
	'type'    => 'text_small',
		'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name'    => esc_html__('Margins','buzzblogpro'),
	'desc'    => esc_html__('Decide the margins between the images. This only works with grid type gallery format.','buzzblogpro'),
	'default' => '10',
	'id'      => 'buzzblogpro_gallery_margins',
	'type'    => 'text_small',
		'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name'             => esc_html__('Randomize','buzzblogpro'),
	'desc'             => esc_html__('Automatically randomize or not the order of photos. This only works with grid type gallery format.','buzzblogpro'),
	'id'               => 'buzzblogpro_gallery_randomize',
	'type'             => 'select',
	'show_option_none' => false,
	'default'          => 'false',
	'options'          => array(
		'false'   => esc_html__('false', 'buzzblogpro'),
		'true'     => esc_html__('true', 'buzzblogpro'),
	),
		'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name'             => esc_html__('Captions','buzzblogpro'),
	'desc'             => esc_html__('Decide if you want to show the caption or not, that appears when your mouse is over the image. This only works with grid type gallery format.','buzzblogpro'),
	'id'               => 'buzzblogpro_gallery_captions',
	'type'             => 'select',
	'show_option_none' => false,
	'default'          => 'false',
	'options'          => array(
		'false'   => esc_html__('false', 'buzzblogpro'),
		'true'     => esc_html__('true', 'buzzblogpro'),
	),
		'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name'             => esc_html__('Featured image','buzzblogpro'),
	'desc'             => esc_html__('Do you want to show gallery on the single post page only ?','buzzblogpro'),
	'id'               => 'buzzblogpro_gallery_featured',
	'type'             => 'select',
	'show_option_none' => false,
	'default'          => 'false',
	'options'          => array(
		'false'   => esc_html__('false', 'buzzblogpro'),
		'true'     => esc_html__('true', 'buzzblogpro'),
	),
		'tab'  => 'gallery',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
/**
* Initiate layout options
*/

$postformatsettings->add_field( array(
	'name' => esc_html__( 'The url', 'buzzblogpro' ),
	'desc' => esc_html__('Insert the URL you wish to link to.','buzzblogpro'),
	'id'   => 'buzzblogpro_post_link',
	'type' => 'text_url',
	'tab'  => 'link',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb'),
	'protocols' => array( 'http', 'https', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ),
) );

$postformatsettings->add_field( array(
	'name'    => esc_html__('Quote','buzzblogpro'),
	'desc'    => esc_html__('Enter the quote','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'post_quote',
	'type'    => 'textarea_small',
	'tab'  => 'quote',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name' => esc_html__( 'Quote author', 'buzzblogpro' ),
	'desc' => esc_html__('Enter the author of the quote.','buzzblogpro'),
	'id'   => $prefix . 'post_quote_author',
	'type' => 'text_medium',
		'tab'  => 'quote',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
/**
* Initiate audio options
*/

$postformatsettings->add_field( array(
	'name'    => esc_html__('Title','buzzblogpro'),
	'desc'    => esc_html__('Input the audio title (for playlist).','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'audio_title',
	'type'    => 'text_medium',
	'tab'  => 'audio',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name'    => esc_html__('Artist','buzzblogpro'),
	'desc'    => esc_html__('Input the audio artist (for playlist).','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'audio_artist',
	'type'    => 'text_medium',
		'tab'  => 'audio',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name' => esc_html__( 'Audio URL', 'buzzblogpro' ),
	'desc' => esc_html__('Input the audio URL.','buzzblogpro'),
	'id'   => $prefix . 'audio_url',
	'type' => 'text_url',
	'protocols' => array( 'http', 'https' ),
		'tab'  => 'audio',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
$postformatsettings->add_field( array(
	'name'    => esc_html__('Embedded Code','buzzblogpro'),
	'desc'    => esc_html__('You can include embedded code from soundcloud.com here. Attention! This code overwrite your audio URL.','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'audio_embed',
	'type'    => 'textarea_code',
	'tab'  => 'audio',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
/**
* Initiate video options
*/

$postformatsettings->add_field( array(
	'name' => esc_html__( 'Video URL', 'buzzblogpro' ),
	'desc' => esc_html__('YouTube Video - Enter the full url to the video page like this: http://youtube.com/watch?v=3H8bnKdf654. Vimeo Video - Enter the full url to the video page like this: http://vimeo.com/9679622','buzzblogpro'),
	'id'   => $prefix . 'video_embed',
	'type' => 'text_url',
	'protocols' => array( 'http', 'https' ),
	'tab'  => 'video',
	 'render_row_cb' => array('CMB2_Tabs', 'tabs_render_row_cb')
) );
/**
* Affiliate Banner 
*/
$affiliatebanner = new_cmb2_box( array(
		'id'            => 'buzzblogpro-affiliate-meta',
		'title'         => esc_html__('Affiliate Banner', 'buzzblogpro'),
		'object_types'  => array( 'post' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
$affiliatebanner->add_field( array(
	'name'    => esc_html__('RewardStyle affiliate banner ID','buzzblogpro'),
	'desc'    => esc_html__('Enter banner ID','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'affiliate_banner',
	'type'    => 'text_medium'
) );
$affiliatebanner->add_field( array(
	'name'    => esc_html__('ShopStyle banner code','buzzblogpro'),
	'desc'    => esc_html__('Enter banner code','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'shopstyle_affiliate_banner',
	'type'    => 'textarea_code'
) );
$affiliatebanner->add_field( array(
	'name'             => esc_html__('Single Post Affiliate Banner','buzzblogpro'),
	'desc'             => esc_html__('Do you want to display the affiliate banner on single post page ?','buzzblogpro'),
	'id'               => $prefix . 'single_affiliate_banner',
	'type'             => 'select',
	'show_option_none' => false,
	'default'          => 'yes',
	'options'          => array(
		'yes'   => esc_html__('Yes', 'buzzblogpro'),
		'no'     => esc_html__('No', 'buzzblogpro'),
	),
) );
/**
* Initiate page options 
*/
$pageoptions = new_cmb2_box( array(
		'id'            => 'buzzblogpro-page-meta',
		'title'         => esc_html__( 'Page Options', 'buzzblogpro' ),
		'object_types'  => array( 'page' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
$pageoptions->add_field( array(
	'name'    => esc_html__('Title','buzzblogpro'),
	'desc'    => esc_html__('Enter page title','buzzblogpro'),
	'default' => '',
	'id'      => 'buzzblogpro_page_tit',
	'type'    => 'text'
) );
$pageoptions->add_field( array(
	'name'    => esc_html__('Subtitle','buzzblogpro'),
	'desc'    => esc_html__('Enter page Subtitle','buzzblogpro'),
	'default' => '',
	'id'      => 'buzzblogpro_page_sub',
	'type'    => 'textarea_small'
) );
$pageoptions->add_field( array(
	'name'             => esc_html__('Enable / disable title','buzzblogpro'),
	'desc'             => esc_html__('Enable or disable title and subtitle.','buzzblogpro'),
	'id'               => 'buzzblogpro_page_title_enable',
	'type'             => 'select',
	'show_option_none' => false,
	'default'          => 'enable',
	'options'          => array(
		'enable'   => esc_html__('Enable', 'buzzblogpro'),
		'disable'     => esc_html__('Disable', 'buzzblogpro'),
	),
) );


	
/**
	 * Initiate Page sidebar options
	 */
	$pagesidebaroptions = new_cmb2_box( array(
		'id'            => 'page_sidebar_options',
		'title'         => esc_html__( 'Sidebar options', 'buzzblogpro' ),
		'object_types'  => array( 'page' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
    
	$pagesidebaroptions->add_field( array(
		'name'             => esc_html__( 'Sidebar position', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Select sidebar position', 'buzzblogpro' ),
		'id'               => $prefix . 'pagesidebarposition',
		'type'             => 'radio_image',
		'default'          => 'inherit',
		'options'          => array(
		    'inherit'    => esc_html__('Inherit', 'buzzblogpro'),
			'none'    => esc_html__('Full Width', 'buzzblogpro'),
			'left'  => esc_html__('Left Sidebar', 'buzzblogpro'),
			'right' => esc_html__('Right Sidebar', 'buzzblogpro'),
		),
		'images_path'      => get_template_directory_uri(),
		'images'           => array(
		    'inherit'    => 'includes/admin/posts-metabox-image/inherit.png',
			'none'    => 'includes/admin/posts-metabox-image/post-side-none.png',
			'left'  => 'includes/admin/posts-metabox-image/post-side-left.png',
			'right' => 'includes/admin/posts-metabox-image/post-side-right.png',
		)
	) );
	
	// Regular text field
$pagesidebaroptions->add_field( array(
		'name'       => esc_html__( 'Available sidebars', 'buzzblogpro' ),
		'desc'       => wp_kses( sprintf( __( 'Choose the sidebar to display. If you wish to generate additional sidebars, you can do it, in the <a href="%s">Apperance -> Theme Options</a> panel.', 'buzzblogpro' ), admin_url('admin.php?page=buzzblogpro_options_options&tab=18') ), wp_kses_allowed_html( 'post' ) ),
		'id'         => $prefix . 'pageavailablesidebars',
		'type'       => 'select',
		'options_cb'     => 'buzzblogpro_get_sidebars_list',
		'default'          => 'hs_main_sidebar',
	) );
/**
* Initiate page layout options
*/
	$pagelayoutoptions = new_cmb2_box( array(
		'id'            => 'page_layout_options',
		'title'         => esc_html__( 'Page Layouts', 'buzzblogpro' ),
		'object_types'  => array( 'page' ), 
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
    $pagelayoutoptions->add_field( array(
	'name'    => esc_html__('Intro text','buzzblogpro'),
	'desc'    => esc_html__('Enter intro text','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'page_intro_text',
	'type'    => 'textarea',
) );
	$pagelayoutoptions->add_field( array(
		'name'             => esc_html__( 'Layout options', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Select layout option', 'buzzblogpro' ),
		'id'               => $prefix . 'standard_layout_format_page',
		'type'             => 'radio_image',
		'default'          => 'inherit',
		'options'          => array(
		    'inherit'  => esc_html__('Inherit', 'buzzblogpro'),
			'layout1'  => esc_html__('Layout 1', 'buzzblogpro'),
			'layout2'  => esc_html__('Layout 2', 'buzzblogpro'),
			'layout3'  => esc_html__('Layout 3', 'buzzblogpro'),
			'layout4'  => esc_html__('Layout 4', 'buzzblogpro'),
			'layout5'  => esc_html__('Layout 5', 'buzzblogpro'),
			'layout6'  => esc_html__('Layout 6', 'buzzblogpro'),
			'layout7'  => esc_html__('Layout 7', 'buzzblogpro'),
			'layout8'  => esc_html__('Layout 8', 'buzzblogpro'),
		),
		'images_path'      => get_template_directory_uri(),
		'images'           => array(
		    'inherit'    => 'includes/admin/posts-metabox-image/inherit.png',
			'layout1'    => 'includes/admin/posts-metabox-image/layout1.png',
			'layout2'  => 'includes/admin/posts-metabox-image/layout2.png',
			'layout3'  => 'includes/admin/posts-metabox-image/layout3.png',
			'layout4'  => 'includes/admin/posts-metabox-image/layout4.png',
			'layout5'  => 'includes/admin/posts-metabox-image/layout5.png',
			'layout6'  => 'includes/admin/posts-metabox-image/layout6.png',
			'layout7'  => 'includes/admin/posts-metabox-image/layout7.png',
			'layout8'  => 'includes/admin/posts-metabox-image/layout8.png',
		)
	) );
$pagelayoutoptions->add_field( array(
		'name'             => esc_html__( 'Parallax', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Enable Parallax For Layout 5', 'buzzblogpro' ),
		'id'               => $prefix . 'page_enable_parallax',
		'default' => '1',
	    'type' => 'checkbox',
	) );
$pagelayoutoptions->add_field( array(
		'name'             => esc_html__( 'Content width', 'buzzblogpro' ),
		'desc'             => esc_html__( 'Select content width', 'buzzblogpro' ),
		'id'               => $prefix . 'content_width_page',
		'type'             => 'radio_image',
		'default'          => 'normal',
		'options'          => array(
		    'normal'    => esc_html__('Normal', 'buzzblogpro'),
			'narrow' => esc_html__('Narrow', 'buzzblogpro'),
		),
		'images_path'      => get_template_directory_uri(),
		'images'           => array(
		    'normal'    => 'includes/admin/posts-metabox-image/normal.png',
			'narrow' => 'includes/admin/posts-metabox-image/post-side-narrow.png',
		)
	) );
if ( buzzblogpro_getVariable('review_system')=='yes' ) {
/**
* Initiate review system fields
*/
	$reviewoptions = new_cmb2_box( array(
		'id'            => 'review_options',
		'title'         => esc_html__( 'Review', 'buzzblogpro' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );
	$reviewoptions->add_field( array(
	'name'    => esc_html__('Title','buzzblogpro'),
	'desc'    => esc_html__('Enter review title','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'review_title_text',
	'type'    => 'text'
) );
    $reviewoptions->add_field( array(
	'name'    => esc_html__('Description','buzzblogpro'),
	'desc'    => esc_html__('Enter review description','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'review_description_text',
	'type'    => 'textarea'
) );

$reviewbox = $reviewoptions->add_field( array(
	'id'          => $prefix . 'review_box',
	'type'        => 'group',
	'options'     => array(
		'group_title'   => esc_html__( 'Review nr {#}', 'buzzblogpro' ),
		'add_button'    => esc_html__( 'Add another review', 'buzzblogpro' ),
		'remove_button' => esc_html__( 'Remove review', 'buzzblogpro' ),
		'sortable'      => true,
	),
) );

$reviewoptions->add_group_field( $reviewbox, array(
	'name'    => esc_html__('Review Title','buzzblogpro'),
	'default' => '',
	'id'      => $prefix . 'review_title_box',
	'type'    => 'text'
) );

$reviewoptions->add_group_field( $reviewbox, array(
	'name'             => esc_html__('Review Number','buzzblogpro'),
	'desc'             => esc_html__('Minimum is 1, Maximum is 10','buzzblogpro'),
	'id'               => $prefix . 'review_number',
	'type'             => 'select',
	'show_option_none' => false,
	'default'          => '',
	'options'          => array(
	    '0'   => esc_html__('0', 'buzzblogpro'),
		'1'   => esc_html__('1', 'buzzblogpro'),
		'2'     => esc_html__('2', 'buzzblogpro'),
		'3'   => esc_html__('3', 'buzzblogpro'),
		'4'     => esc_html__('4', 'buzzblogpro'),
		'5'   => esc_html__('5', 'buzzblogpro'),
		'6'     => esc_html__('6', 'buzzblogpro'),
		'7'   => esc_html__('7', 'buzzblogpro'),
		'8'     => esc_html__('8', 'buzzblogpro'),
		'9'     => esc_html__('9', 'buzzblogpro'),
		'10'     => esc_html__('10', 'buzzblogpro'),
	),
) );

}
}



?>