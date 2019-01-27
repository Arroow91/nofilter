<?php
add_action( 'wp_enqueue_scripts', 'buzzblogpro_child_theme_enqueue_styles' );
function buzzblogpro_child_theme_enqueue_styles() {

    $parent_style = 'buzzblogpro-style';
    wp_register_style( $parent_style, get_template_directory_uri() . '/style.css', array('bootstrap'), '1.0', 'all' );
    wp_enqueue_style( $parent_style);
    wp_enqueue_style( 'buzzblogpro-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}