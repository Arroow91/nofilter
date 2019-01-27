<?php
include plugin_dir_path( __FILE__ ) . '/mcapi.class.php';
use \DrewM\MailChimp\MailChimp;
class Buzzblogpro_mailchimp_widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
   
add_action('wp_ajax_nopriv_buzzblogpro-mc', array($this, 'buzzblogpro_mailchimp'));  
add_action('wp_ajax_buzzblogpro-mc', array($this, 'buzzblogpro_mailchimp')); 

		
		$widget_ops = array( 'classname' => 'buzzblogpro_mailchimp_widget', 'description' => esc_html__('Mailchimp Widget', 'buzzblogpro') );
		/* Widget control settings. */
		$control_ops = array('id_base' => 'buzzblogpro_mailchimp_widget');
		

		/* Create the widget. */
		parent::__construct( 'Buzzblogpro_mailchimp_widget', esc_html__('Hercules - Mailchimp', 'buzzblogpro'), $widget_ops, $control_ops );
	}


	public function widget( $args, $instance ) {
		extract($args);
		
		echo wp_kses_post( $before_widget );
		echo ( $instance['title'] != '' ? wp_kses_post( $before_title . $instance['title'] . $after_title ) : '' );
			
			?>	
			
			<form class="buzzblogpro-mc-form black-bg typo-white <?php if (!empty($instance['horizontal_layout'])) { echo 'form-inline';} ?>" id="<?php echo 'buzzblogpro-mc-form' . $this->number; ?>" method="post">
			
				
			
			
			
				<?php	
					if ($instance['subtitle']) {
				?>	
				<h4 class="buzzblogpro-mc-subtitle"><?php echo stripslashes($instance['subtitle']); ?></h4>
				<?php	
					}
					if (!empty($instance['collect_first'])) { 
				?>
				<div class="form-group">
					<input type="text" placeholder="<?php echo stripslashes($instance['enter_first_text']); ?>" class="form-control first-name" name="<?php echo 'buzzblogpro-mc-first_name' . $this->number; ?>" />
				</div>
				<?php
					}
					if (!empty($instance['collect_last'])) { 
				?>	
				<div class="form-group">
					<input type="text" placeholder="<?php echo stripslashes($instance['enter_last_text']); ?>" class="form-control last-name" name="<?php echo 'buzzblogpro-mc-last_name' . $this->number; ?>" />
				</div>
				<?php	
					} 					
					
				?> 
					<input type="hidden" name="buzzblogpro_mc_number" value="<?php echo esc_attr( $this->number ); ?>" />
					<input type="hidden" name="buzzblogpro_mc_listid<?php echo esc_attr( $this->number ); ?>" value="<?php echo stripslashes($instance['current_mailing_list']); ?>" />
					<input type="hidden" name="buzzblogpro_mc_success<?php echo esc_attr( $this->number ); ?>" value="<?php echo stripslashes($instance['success_message']); ?>" />
					<input type="hidden" name="buzzblogpro_mc_failure<?php echo esc_attr( $this->number ); ?>" value="<?php echo stripslashes($instance['failure_message']); ?>" />
					
					<div class="form-group submitcontainer" data-toggle="tooltip" data-placement="top">
					  <input type="text" class="form-control buzzblogpro-mc-email" id="buzzblogpro-mc-email-<?php echo esc_attr( $this->number ); ?>" placeholder="<?php echo stripslashes($instance['enter_email_text']); ?>" name="<?php echo 'buzzblogpro-mc-email' . esc_attr( $this->number ); ?>">
					 
					 <div class="ajax-loader loading"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve"> <path fill="#222" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"> <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="0.5s" from="0 50 50" to="360 50 50" repeatCount="indefinite"/> </path></svg></div>
					  
					</div>
<?php
if (!empty($instance['consent'])) { 
				?>	
				<div class="form-group">
					<input style="margin-right:8px;" type="checkbox" name="<?php echo 'buzzblogpro-mc-consent-' . $this->number; ?>"><?php echo stripslashes($instance['consent_text']); ?>
				</div>
				<?php	
					} ?> 
					<div class="form-group">
					<input id="buzzblogpro-mc-<?php echo esc_attr( $this->number ); ?>" class="buzzblogpro-mc btn-block" data-id="<?php echo esc_attr( $this->number ); ?>" type="button" name="<?php echo stripslashes($instance['signup_text']); ?>" value="<?php echo stripslashes($instance['signup_text']); ?>" />
				</div>
				</form>
				
				<?php
			echo wp_kses_post( $after_widget );
		}
	/**
	 * Update the widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance; 
		
		
		$instance['collect_first'] = strip_tags($new_instance['collect_first']);
		
		$instance['horizontal_layout'] = strip_tags($new_instance['horizontal_layout']);
		
		$instance['consent'] = strip_tags($new_instance['consent']);
		
		$instance['consent_text'] = $new_instance['consent_text'];

		$instance['collect_last'] = strip_tags($new_instance['collect_last']);
		
		$instance['current_mailing_list'] = strip_tags($new_instance['current_mailing_list']);
		
		$instance['failure_message'] = strip_tags($new_instance['failure_message']);
		
		$instance['signup_text'] = strip_tags($new_instance['signup_text']);
		$instance['enter_first_text'] = strip_tags($new_instance['enter_first_text']);
		$instance['enter_last_text'] = strip_tags($new_instance['enter_last_text']);
		$instance['enter_email_text'] = strip_tags($new_instance['enter_email_text']);
		
		$instance['success_message'] = strip_tags($new_instance['success_message']);
		
		$instance['subtitle'] = $new_instance['subtitle'];
		
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	public function form( $instance ) {
	
		$defaults = array( 'title' => '', 'current_mailing_list' => '', 'signup_text' => 'Subscribe', 'enter_first_text' => 'First name', 'enter_last_text' => 'Last name', 'enter_email_text' => 'Enter email address', 'horizontal_layout' => '' , 'consent' => '' , 'consent_text' => 'I have read and agree to the <a href="/privacy-policy/" target="blank">Privacy Policy</a>' ,'collect_first' => '', 'collect_last' => '', 'subtitle' => '', 'success_message' => esc_html__('Success', 'buzzblogpro'), 'failure_message' => esc_html__('Failure', 'buzzblogpro'));
		$instance = wp_parse_args( (array) $instance, $defaults );

		$mcapi = '';
		$MC_API_KEY = buzzblogpro_getVariable('mailchimp_apikey');
		 
        if ($MC_API_KEY) {
           $mcapi = new MailChimp($MC_API_KEY);
        }
		
		//print_r( $mcapi->getLastResponse());
		
		if ($mcapi){
			$this->lists = $mcapi->get('lists');
			}
			?>
					<h3><?php echo  esc_html__('General Settings', 'buzzblogpro');?></h3>
					<!-- Widget Title: Text Input -->
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'buzzblogpro-mc-title' ) ); ?>"><?php esc_html_e('Title:', 'buzzblogpro'); ?></label>
						<input  class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('current_mailing_list') ); ?>"><?php echo esc_html__('Select a Mailing List :', 'buzzblogpro'); ?></label>
						<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('current_mailing_list') );?>" name="<?php echo esc_attr( $this->get_field_name('current_mailing_list') ); ?>">
			<?php	
			foreach ($this->lists['lists'] as $key => $value) {
				$selected = (isset($instance['current_mailing_list']) && $instance['current_mailing_list'] == $value['id']) ? '1' : '';
				?>	
						<option <?php echo ( $selected == '1' ? ' selected="selected" ' : '' ); ?>value="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_attr( $value['name'] ); ?></option>
				<?php
			}
			?>
						</select>
					</p>
					
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('signup_text') ); ?>"><?php echo esc_html__('Sign Up Button Text :', 'buzzblogpro'); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('signup_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('signup_text') ); ?>" value="<?php echo esc_attr( $instance['signup_text'] ); ?>" type="text"  />
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('enter_first_text') ); ?>"><?php echo esc_html__('First Name Text :', 'buzzblogpro'); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('enter_first_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('enter_first_text') ); ?>" value="<?php echo esc_attr( $instance['enter_first_text'] ); ?>" type="text"  />
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('enter_last_text') ); ?>"><?php echo esc_html__('Last name Text :', 'buzzblogpro'); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('enter_last_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('enter_last_text') ); ?>" value="<?php echo esc_attr( $instance['enter_last_text'] ); ?>" type="text"  />
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('enter_email_text') ); ?>"><?php echo esc_html__('Enter email Text :', 'buzzblogpro'); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('enter_email_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('enter_email_text') ); ?>" value="<?php echo esc_attr( $instance['enter_email_text'] ); ?>" type="text"  />
					</p>
					
					<p>
						
						
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("horizontal_layout")); ?>" name="<?php echo esc_attr($this->get_field_name("horizontal_layout")); ?>"<?php checked( (bool) $instance["horizontal_layout"], true ); ?> />
						
						
						<label for="<?php echo esc_attr( $this->get_field_id('horizontal_layout') ); ?>"><?php echo esc_html__('Enable horizontal layout ?', 'buzzblogpro'); ?></label>
						<br />
						</p>
					<h3><?php echo esc_html__('Personal Information', 'buzzblogpro'); ?></h3>
					<p>
						
						
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("collect_first")); ?>" name="<?php echo esc_attr($this->get_field_name("collect_first")); ?>"<?php checked( (bool) $instance["collect_first"], true ); ?> />
						
						
						<label for="<?php echo esc_attr( $this->get_field_id('collect_first') ); ?>"><?php echo esc_html__('Collect first name.', 'buzzblogpro'); ?></label>
						<br />
						
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("collect_last")); ?>" name="<?php echo esc_attr($this->get_field_name("collect_last")); ?>"<?php checked( (bool) $instance["collect_last"], true ); ?> />
						
						<label><?php echo esc_html__('Collect last name.', 'buzzblogpro'); ?></label>
					</p>
					<h3><?php echo esc_html__('Notifications', 'buzzblogpro'); ?></h3>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('subtitle') ); ?>"><?php echo esc_html__('Sub Title:', 'buzzblogpro'); ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('subtitle') ); ?>" name="<?php echo esc_attr( $this->get_field_name('subtitle') ); ?>"><?php echo esc_textarea( $instance['subtitle'] ); ?></textarea>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('success_message') ); ?>"><?php echo esc_html__('Success Message:', 'buzzblogpro'); ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('success_message') ); ?>" name="<?php echo esc_attr( $this->get_field_name('success_message') ); ?>"><?php echo esc_attr( $instance['success_message'] ); ?></textarea>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('failure_message') ); ?>"><?php echo esc_html__('Failure Message:', 'buzzblogpro'); ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('failure_message') ); ?>" name="<?php echo esc_attr( $this->get_field_name('failure_message') ); ?>"><?php echo esc_attr( $instance['failure_message'] ); ?></textarea>
					</p>
					
										<p>
						
						
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id("consent")); ?>" name="<?php echo esc_attr($this->get_field_name("consent")); ?>"<?php checked( (bool) $instance["consent"], true ); ?> />
						
						
						<label for="<?php echo esc_attr( $this->get_field_id('consent') ); ?>"><?php echo esc_html__('Display consent checkbox ?', 'buzzblogpro'); ?></label>
						<br />
						</p>
						<p>
						<label for="<?php echo esc_attr( $this->get_field_id('consent_text') ); ?>"><?php echo esc_html__('Consent text:', 'buzzblogpro'); ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('consent_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('consent_text') ); ?>"><?php echo esc_textarea( $instance['consent_text'] ); ?></textarea>
					</p>
						
			<?php
			
		
	}
	

public function buzzblogpro_mailchimp() {
	
	$nonce = $_POST['ajax_nonce'];

   if ( ! wp_verify_nonce( $nonce, 'ajax_nonce' ) )
        die ( -1 );
	 
	if(isset($_POST['buzzblogpro_mc_number'])) { 
		$first_name = 'buzzblogpro-mc-first_name'. esc_attr( $_POST['buzzblogpro_mc_number'] );
		$last_name = 'buzzblogpro-mc-last_name'. esc_attr( $_POST['buzzblogpro_mc_number'] );
		$email = 'buzzblogpro-mc-email'. esc_attr( $_POST['buzzblogpro_mc_number'] );
		$success = 'buzzblogpro_mc_success'. esc_attr( $_POST['buzzblogpro_mc_number'] );
		$failure = 'buzzblogpro_mc_failure'. esc_attr( $_POST['buzzblogpro_mc_number'] );
		$listid = 'buzzblogpro_mc_listid'. esc_attr( $_POST['buzzblogpro_mc_number'] );
		global $newVar;
	
	$apikey = buzzblogpro_getVariable('mailchimp_apikey');
		
    $MailChimp = new MailChimp($apikey); 
	
		
		$merge_vars = array();
		$merge_vars['FNAME'] = isset($_POST[$first_name]) ? strip_tags($_POST[$first_name]) : '';
		$merge_vars['LNAME'] = isset($_POST[$last_name]) ? strip_tags($_POST[$last_name]) : '';
		
		$subscribed = $MailChimp->post("lists/$_POST[$listid]/members", [
                            'email_address' => strip_tags($_POST[$email]),
                            'merge_fields'  => $merge_vars,
                            'status'        => 'pending',
                        ]);
						
						 
		if ($MailChimp->success()) {
			echo stripslashes( $_POST[$success] );
		}else{
			echo stripslashes( $_POST[$failure] );
		}
	}
	exit;
}	
}
?>