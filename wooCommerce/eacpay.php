<?php
/**
 * Eacpay
 *
 * @package         Eacpay
 * @author            Eacpay <cansnow@Eacpay.com>
 * @copyright     2021 Eacpay.
 * @license         GPLv3
 *
 * Plugin Name: Eacpay
 * Plugin URI: http://eacpay.com
 * Description: 在 WooCommerce 使用地球币支付。
 * Version: 0.0.1
 * Author: Eacpay <Eacpay@Eacpay.com>
 * Author URI: https://Eacpay.com
 * Text Domain: eacpay
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) || die();

$active_plugins = apply_filters('active_plugins', get_option('active_plugins'));

if(Eacpay::eacpay_payment_is_woocommerce_active()){
    
    add_filter('woocommerce_payment_gateways', 'woocommerce_add_eacpay_payment_gateway');
    function woocommerce_add_eacpay_payment_gateway( $gateways ) {
        $gateways[] = 'WC_Eacpay_Payment_Gateway';
        return $gateways;
    }

    add_action('plugins_loaded', 'woocommerce_init_eacpay_payment_gateway');
    function woocommerce_init_eacpay_payment_gateway() {
        require 'includes/class-wc-gateway-eacpay.php';
    }

    add_action( 'plugins_loaded', 'load_eacpay_textdomain' );
    function load_eacpay_textdomain() {
        load_plugin_textdomain('includes/class-wc-gateway-eacpay', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
    }

    add_filter ( 'plugin_action_links_'.plugin_basename( __FILE__ ),'eacpay_plugin_action_links_new',10,1 );
    function eacpay_plugin_action_links_new($links) {
        return array_merge ( array (
            'settings' => '<a href="' . admin_url ( 'admin.php?page=wc-settings&tab=checkout&section=eacpay' ) . '">'.__('设置','eacpay').'</a>'
        ), $links );
    }
    
    add_action('woocommerce_admin_order_data_after_billing_address','so_32457242_before_order_itemmeta',60,1); 
    function so_32457242_before_order_itemmeta($item){
        global $wpdb;
        $eacOrder = $wpdb->get_row("select * from {$wpdb->prefix}eacpay_order where `oid`=".$item->id);
        echo '<div class="address">
            <p>
                <strong>付款地址:</strong>
                <a href="javascript:;" id="eacpay_from_address" data-href="includes/eacpay.php?eacorderid='.$eacOrder->id.'">'.$eacOrder->from_address.'</a>
            </p>
        </div>';
        echo '<div id="eacpay_from_address_qrcode" style="display:none;position: absolute;left: 0;top: 0;z-index: 99999;text-align: center;background: #fff;padding: 10px;border: 1px solid #d2d2d2;box-shadow: rgb(0 0 0 / 20%) 1px 1px 10px 5px;">
            <div>退款二维码:</div>
            <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/wp-content/plugins/eacpay/includes/eacpay.php?action=rejectqrcode&eacorderid='.$eacOrder->id.'" />
        </div>';
        echo '<script>
            jQuery("#eacpay_from_address").on("mouseenter",function(){
                jQuery("#eacpay_from_address_qrcode").css({
                    top:jQuery("#eacpay_from_address").offset().top-jQuery("#eacpay_from_address").parents(".meta-box-sortables").offset().top+20,
                    left:jQuery("#eacpay_from_address").offset().left-jQuery("#eacpay_from_address").parents(".meta-box-sortables").offset().left,
                    display:"block"
                })
            }).on("mouseleave",function(){
                jQuery("#eacpay_from_address_qrcode").hide();
            });
        </script>';
    } 

    add_filter( 'cron_schedules', 'example_add_cron_interval' );
    function example_add_cron_interval( $schedules ) {
        $schedules['5seconds'] = array(
            'interval' => 5,
            'display'  => esc_html__( 'Every Five Seconds' ),
        );
        return $schedules;
    }

    function eacpay_order_cron( $rules ) {
        $w = new WC_Eacpay_Payment_Gateway();
        global $wpdb;
        $table_name = $wpdb->prefix . "eacpay_order";
        $settings =get_option('woocommerce_eacpay_settings');
        $maxtime = time()-$settings['eacpay_maxwaitpaytime']*60;

        $wpdb->update($table_name,array(
            `status`=>'cancel'
        ),array(
            'status'=>'wait',
            'type'=>'recharge',
            'create_time'=>$maxtime
        ));
        $sql = "select * from {$table_name} where `status`='wait'";
        $list = $wpdb->get_results($sql);
        foreach($list as $k=>$v){
            $w->check($v);
        }
    }
    add_action( 'eacpay_order_cron', 'eacpay_order_cron' );
}

class Eacpay
{
    function activate() {
        $this->tokeneacpay_install();
        if ( ! wp_next_scheduled( 'eacpay_order_cron' ) ) {
            wp_schedule_event( time(), '5seconds', 'eacpay_order_cron' );
        }
        /*if($this->eacpay_payment_is_woocommerce_active()){
            flush_rewrite_rules();
        }*/
    }

    function deactivate() {
        $timestamp = wp_next_scheduled( 'eacpay_order_cron' );
        wp_unschedule_event( $timestamp, 'eacpay_order_cron' );

    }

    function uninstall() {

    }

    function tokeneacpay_install() {
        global $wpdb;
        $table_name = $wpdb->prefix . "eacpay_order";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "DROP TABLE IF EXISTS $table_name;
        CREATE TABLE $table_name  (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `oid` varchar(100) NOT NULL,
          `order_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
          `amount` float(10, 4) NULL DEFAULT 0.0000,
          `eac` float(10, 4) NULL DEFAULT 0.0000,
          `real_eac` float(10, 4) NULL DEFAULT 0.0000,
          `form_address` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
          `to_address` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
          `block_height` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
          `create_time` int(11) NULL DEFAULT 0,
          `pay_time` int(11) NULL DEFAULT 0,
          `last_time` int(11) NULL DEFAULT 0,
          `status` enum('cancel','reject','wait','complete','payed') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
          `type` enum('recharge','cash') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
          PRIMARY KEY (`id`) USING BTREE,
          INDEX `plid`(`order_id`) USING BTREE
        ) $charset_collate;";
        require_once( ABSPATH.'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    /**
    * @return bool
    * Determine if there is an installation woocommerce
    */
    function eacpay_payment_is_woocommerce_active()
    {
        $active_plugins = (array) get_option('active_plugins', array());

        if (is_multisite()) {
            $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
        }

        return in_array('woocommerce/woocommerce.php', $active_plugins) || array_key_exists('woocommerce/woocommerce.php', $active_plugins);
    }
}

if (class_exists('Eacpay')) {
    $tokenEacpayPlugin = new Eacpay();
}

register_activation_hook( __FILE__, array( $tokenEacpayPlugin, 'activate') );
register_deactivation_hook( __FILE__, array( $tokenEacpayPlugin, 'deactivate') );
