<?php
if ( ! class_exists( 'Hercules_Likes' ) ) {
class Hercules_Likes {

    function __construct() 
    {	
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
        add_filter('body_class', array(&$this, 'body_class'));
        add_action('publish_post', array(&$this, 'setup_likes'));
        add_action('wp_ajax_hercules-likes', array(&$this, 'ajax_callback'));
		add_action('wp_ajax_nopriv_hercules-likes', array(&$this, 'ajax_callback'));
	}

	function enqueue_scripts()
	{
		
		wp_enqueue_script( 'hercules-likes', plugin_dir_url( __FILE__ ) . 'hercules-likes.js', array('jquery'), '1.0', true );
		wp_localize_script( 'hercules-likes', 'hercules_likes', array('ajaxurl' => admin_url('admin-ajax.php')) );
	}
	
	function setup_likes( $post_id ) 
	{
		if(!is_numeric($post_id)) return;
	
		add_post_meta($post_id, '_hercules_likes', '0', true);
	}
	
	function ajax_callback($post_id) 
	{

		if( isset($_POST['likes_id']) ) {

			$post_id = str_replace('hercules-likes-', '', $_POST['likes_id']);
			echo wp_kses_post($this->like_this($post_id, 'update'));
		} else {

			$post_id = str_replace('hercules-likes-', '', $_POST['post_id']);
			echo wp_kses_post($this->like_this($post_id, 'get'));
		}
		
		exit;
	}
	
	function like_this($post_id, $action = 'get') 
	{
		if(!is_numeric($post_id)) return;		
		
		switch($action) {
		
			case 'get':
				$likes = get_post_meta($post_id, '_hercules_likes', true);
				if( !$likes ){
					$likes = 0;
					add_post_meta($post_id, '_hercules_likes', $likes, true);
				}
				
				return '<span>'.$likes.'</span>';
				break;
				
			case 'update':
				$likes = get_post_meta($post_id, '_hercules_likes', true);
				if( isset($_COOKIE['hercules_likes_'. $post_id]) ) return $likes;
				
				$likes++;
				update_post_meta($post_id, '_hercules_likes', $likes);
				setcookie('hercules_likes_'. $post_id, $post_id, time()*20, '/');
				
				return '<span>'.$likes.'</span>';
				break;
		
		}
	}

	function do_likes()
	{
		global $post;
		
		$output = $this->like_this($post->ID);
  
  		$class = 'hercules-likes';
  		$title = esc_html__('Like this', 'buzzblogpro');
		if( isset($_COOKIE['hercules_likes_'. $post->ID]) ){
			$class = 'hercules-likes active';
			$title = esc_html__('You already like this', 'buzzblogpro');
		}
		
		return '<a href="#" class="'. $class .'" id="hercules-likes-'. $post->ID .'" title="'. $title .'">'. $output .'</a>';
	}
	
    function body_class($classes) {
        	$classes[] = 'ajax-hercules-likes';
    	return $classes;
    }

}
global $hercules_likes;
$hercules_likes = new Hercules_Likes();

function hercules_likes()
{
	global $hercules_likes;
    echo wp_kses_post($hercules_likes->do_likes()); 
}
	function hercules_posts_column_views( $defaults ) {
 $defaults['post_likes'] = esc_html__( 'Likes','buzzblogpro' );
 
 return $defaults;
}  
function hercules_posts_custom_column_views( $column_name, $id ) {
if ( $column_name === 'post_likes' ) {
echo get_post_meta( get_the_ID(), '_hercules_likes', true); 
 }
}
add_filter( 'manage_posts_columns', 'hercules_posts_column_views' );
add_action( 'manage_posts_custom_column', 'hercules_posts_custom_column_views', 5, 2 );
add_filter( 'manage_gallery_posts_columns', 'hercules_posts_column_views' );
add_action( 'manage_gallery_posts_custom_column', 'hercules_posts_custom_column_views', 5, 2 );
}