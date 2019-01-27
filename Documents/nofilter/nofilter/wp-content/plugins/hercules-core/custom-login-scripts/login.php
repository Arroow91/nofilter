<?php
// Custom login form

function buzzblogpro_login_logo() {
if ( function_exists( 'buzzblogpro_getVariable' ) ) {
if(buzzblogpro_getVariable('login_form_logo','url')){
?>
<style type="text/css">
.login h1 a {
    background-image: url(<?php echo esc_url( buzzblogpro_getVariable('login_form_logo','url'));?>)!important;
    width: 100%!important; 
    margin: 0 auto 25px!important;
    padding: 0!important;
    background-size: auto!important;
}

body.login {
    background-image:url(<?php echo esc_url( buzzblogpro_getVariable('login_form_image_bg','url')); ?>)!important;
    background: no-repeat #fff;
    background-origin: unset!important;
    background-clip: unset!important;
    background-size: cover!important;
    background-attachment: scroll!important;
	display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center !important;
-ms-flex-align: center !important;
align-items: center !important;
padding:0px!important;
}
#login {
    width: 350px !important;padding:0px!important;
}
.login #backtoblog, .login #nav {padding: 0px!important;}.login form{padding:0px!important;margin-top:0px!important;background: transparent!important;box-shadow:unset!important;border:0px solid #222!important}.login .message{border-left:4px solid #fff!important;background-color:transparent!important;box-shadow:unset!important}.login form .input,.login form input[type=checkbox],.login input[type=text]{background:#fff!important}input[type=checkbox],input[type=color],input[type=date],input[type=datetime-local],input[type=datetime],input[type=email],input[type=month],input[type=number],input[type=password],input[type=radio],input[type=search],input[type=tel],input[type=text],input[type=time],input[type=url],input[type=week],select,textarea{border-top:0!important;border-left:0!important;border-right:0!important;border-bottom:0px solid #ddd!important;box-shadow:unset!important;background-color:#FFF!important}.wp-core-ui .button-primary{text-shadow:0 0 0 #fff,0 0 0 #fff,0 0 0 #fff,0 0 0 #fff!important;background:#ffffff!important;border-color:#222!important;box-shadow:unset!important;color:#222!important;text-decoration:none!important;border-radius:0!important}input[type=checkbox]:focus,input[type=color]:focus,input[type=date]:focus,input[type=datetime-local]:focus,input[type=datetime]:focus,input[type=email]:focus,input[type=month]:focus,input[type=number]:focus,input[type=password]:focus,input[type=radio]:focus,input[type=search]:focus,input[type=tel]:focus,input[type=text]:focus,input[type=time]:focus,input[type=url]:focus,input[type=week]:focus,select:focus,textarea:focus{border-color:#ddd!important;box-shadow:unset!important}.wp-core-ui .button-primary.focus,.wp-core-ui .button-primary.hover,.wp-core-ui .button-primary:focus,.wp-core-ui .button-primary:hover{background:#222!important;border-color:#222!important;box-shadow:unset!important;color:#FFF!important}.login #backtoblog a:hover,.login #nav a:hover,.login h1 a:hover{color:#222!important}.wp-core-ui .button.button-large {height:40px!important;line-height:40px!important;padding: 0 22px 2px!important;border:0px!important;font-weight:600!important;text-transform:uppercase!important;font-size:12px!important;}
    </style>
<?php }}}
add_action( 'login_enqueue_scripts', 'buzzblogpro_login_logo' );

function buzzblogpro_login_logo_url() {
    return esc_url( home_url( '/' ) );
}
add_filter( 'login_headerurl', 'buzzblogpro_login_logo_url' );

function buzzblogpro_login_logo_url_title() {
    return '';
}
add_filter( 'login_headertitle', 'buzzblogpro_login_logo_url_title' ); ?>