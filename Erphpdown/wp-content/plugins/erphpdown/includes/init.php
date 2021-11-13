<?php
if(isset($_REQUEST['aff']) && !isset($_COOKIE["erphprefid"])){
	setcookie("erphprefid", $_REQUEST['aff'], time()+2592000, '/');
}

function erphpdown_style() {
	global $erphpdown_version;
	wp_enqueue_style( 'erphpdown', constant("erphpdown")."static/erphpdown.css", array(), $erphpdown_version,'screen' );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'erphpdown', constant("erphpdown")."static/erphpdown.js", false, $erphpdown_version, true);
	wp_localize_script( 'erphpdown', '_ERPHP', array('ajaxurl'=>admin_url("admin-ajax.php")));
	wp_localize_script( 'erphpdown', 'erphpdown_ajax_url', admin_url("admin-ajax.php"));
}
add_action('wp_enqueue_scripts', 'erphpdown_style',20,1);

add_action( 'wp_head', 'erphpdown_head_style' );
function erphpdown_head_style(){
	$erphp_wppay_payment = get_option('erphp_wppay_payment');
?>
	<style id="erphpdown-custom"><?php echo get_option('erphp_custom_css');?></style>
	<script>window._ERPHPDOWN = {"uri":"<?php echo ERPHPDOWN_URL;?>", "payment": "<?php if($erphp_wppay_payment == 'f2fpay') echo "1";elseif($erphp_wppay_payment == 'f2fpay_weixin') echo "4";elseif($erphp_wppay_payment == 'f2fpay_hupiv3') echo "4";elseif($erphp_wppay_payment == 'weixin') echo "3";elseif($erphp_wppay_payment == 'paypy' || $erphp_wppay_payment == 'vpay' || $erphp_wppay_payment == 'f2fpay_paypy' || $erphp_wppay_payment == 'eacpay') echo "6";elseif($erphp_wppay_payment == 'hupiv3') echo "5";elseif($erphp_wppay_payment == 'payjs') echo "5"; else echo "2";?>", "author": "mobantu"}</script>
<?php 
}

add_action('user_register', 'erphp_register_extra_fields');
function erphp_register_extra_fields($user_id, $password="", $meta=array()) {
	global $wpdb;
	$hasRe = $wpdb->get_row("select ID,father_id from $wpdb->users where reg_ip = '".erphpGetIP()."'");
	if($hasRe){
		$sql = "update $wpdb->users set reg_ip = '".erphpGetIP()."' where ID=".$user_id;
		$wpdb->query($sql);

		if(!$hasRe->father_id){
			if(isset($_COOKIE["erphprefid"]) && is_numeric($_COOKIE["erphprefid"])){
				$sql = "update $wpdb->users set father_id='".esc_sql($_COOKIE["erphprefid"])."',reg_ip = '".erphpGetIP()."' where ID=".$user_id;
				$wpdb->query($sql);
				addUserMoney($_COOKIE["erphprefid"], get_option('ice_ali_money_reg'));
			}
		}
	}else{
		$ice_ali_money_new = get_option('ice_ali_money_new');
		if($ice_ali_money_new){
			addUserMoney($user_id,$ice_ali_money_new);
		}

		if(isset($_COOKIE["erphprefid"]) && is_numeric($_COOKIE["erphprefid"])){
			$sql = "update $wpdb->users set father_id='".esc_sql($_COOKIE["erphprefid"])."',reg_ip = '".erphpGetIP()."' where ID=".$user_id;
			$wpdb->query($sql);
			addUserMoney($_COOKIE["erphprefid"],get_option('ice_ali_money_reg'));
		}
	}
}

add_action("init","erphp_noadmin_redirect");
function erphp_noadmin_redirect(){
	global $wpdb;
	if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) && get_option('erphp_url_front_noadmin')=='yes') {
	  	$current_user = wp_get_current_user();
	  	if($current_user->roles[0] == get_option('default_role')) {
			$userpage = get_bloginfo('url');
			if(get_option('erphp_url_front_userpage')){
				$userpage = get_option('erphp_url_front_userpage');
			}
			wp_redirect( $userpage );
	  	}
	}
}