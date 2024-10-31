<?php 
/**
* Plugin Name: Products Attachments For Woocommerce
* Description: This plugin allows create Products Attachments plugin.
* Version: 1.0
* Copyright: 2020
* Text Domain: products-attachments-for-woocommerce
* Domain Path: /languages 
*/
if (!defined('ABSPATH')) {
	exit();
}
if (!defined('PAFW_PLUGIN_NAME')) {
  define('PAFW_PLUGIN_NAME', 'Products Attachments For Woocommerce');
}
if (!defined('PAFW_PLUGIN_VERSION')) {
  define('PAFW_PLUGIN_VERSION', '2.0.0');
}
if (!defined('PAFW_PLUGIN_FILE')) {
  define('PAFW_PLUGIN_FILE', __FILE__);
}
if (!defined('PAFW_PLUGIN_DIR')) {
  define('PAFW_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('PAFW_BASE_NAME')) {
    define('PAFW_BASE_NAME', plugin_basename(PAFW_PLUGIN_FILE));
}
if (!defined('PAFW_DOMAIN')) {
  define('PAFW_DOMAIN', 'products-attachments-for-woocommerce');
}

if (!class_exists('PAFW')) {

	class PAFW {

  	protected static $PAFW_instance;

  	public static function PAFW_instance() {
    	if (!isset(self::$PAFW_instance)) {
      	self::$PAFW_instance = new self();
      	self::$PAFW_instance->init();
      	self::$PAFW_instance->includes();
    	}
    	return self::$PAFW_instance;
    }

    function __construct() {
    	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    	add_action('admin_init', array($this, 'PAFW_check_plugin_state'));
  	}

  	function init() {	   
  		add_action( 'admin_notices', array($this, 'PAFW_show_notice'));   	
    	add_action( 'admin_enqueue_scripts', array($this, 'PAFW_load_admin_script_style'));
    	add_action( 'wp_enqueue_scripts',  array($this, 'PAFW_load_script_style'));
  		add_filter( 'plugin_row_meta', array( $this, 'PAFW_plugin_row_meta' ), 10, 2 );
    }		

    //Load all includes files
    function includes() {
      include_once('includes/pafw_comman.php');
      include_once('includes/pafw_backend.php');
    	include_once('includes/pafw_kit.php');
      include_once('includes/pafw_frontend.php');
    }

    function PAFW_load_admin_script_style() {
  	  wp_enqueue_style( 'pafw-backend-css', PAFW_PLUGIN_DIR.'/assets/css/pafw_backend_css.css', false, '1.0' );
      wp_enqueue_script( 'pafw-backend-js', PAFW_PLUGIN_DIR.'/assets/js/pafw_backend_js.js', array( 'jquery', 'select2') );
      wp_enqueue_style( 'PAFW_admin_fa_css', PAFW_PLUGIN_DIR . '/assets/css/font-awesome.min.css', false, '1.0' );
      wp_enqueue_style( 'PAFW_admin_fa_css' );
      wp_localize_script( 'ajaxloadpost', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
      wp_enqueue_style( 'woocommerce_admin_styles-css', WP_PLUGIN_URL. '/woocommerce/assets/css/admin.css',false,'1.0',"all");
      wp_enqueue_style( 'wp-color-picker' );
      wp_enqueue_script( 'wp-color-picker-alpha', PAFW_PLUGIN_DIR . '/assets/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
      wp_enqueue_script( 'jquery-ui-datepicker' );
      wp_enqueue_style( 'jquery-ui', PAFW_PLUGIN_DIR.'/assets/css/jquery-ui.css', false, '1.0' );
      wp_enqueue_style( 'jquery-ui' );
      wp_enqueue_script('jquery');
      wp_enqueue_media();
      wp_upload_dir();
    }


    function PAFW_load_script_style() {
      wp_enqueue_style( 'pafw-frontend-css', PAFW_PLUGIN_DIR.'/assets/css/pafw_frontend_css.css', false, '1.0' );
      wp_enqueue_style( 'PAFW_admin_fa_css', PAFW_PLUGIN_DIR . '/assets/css/font-awesome.min.css', false, '1.0' );
      wp_enqueue_style( 'PAFW_admin_fa_css' );
    }

    function PAFW_show_notice() {
    	if ( get_transient( get_current_user_id() . 'wfcerror' ) ) {
    		deactivate_plugins( plugin_basename( __FILE__ ) );
    		delete_transient( get_current_user_id() . 'wfcerror' );
    		echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';
    	}
  	}

    function PAFW_plugin_row_meta( $links, $file ) {
      if ( PAFW_BASE_NAME === $file ) {
        $row_meta = array(
            'rating'    =>  '<a href="https://xthemeshop.com/products-attachments-for-woocommerce/" target="_blank">Documentation</a> | <a href="https://xthemeshop.com/contact/" target="_blank">Support</a> | <a href="https://wordpress.org/support/plugin/products-attachments-for-woocommerce/reviews/?filter=5" target="_blank"><img src="'.PAFW_PLUGIN_DIR.'/images/star.png" class="pafw_rating_div"></a>'
        );
        return array_merge( $links, $row_meta );
      }
      return (array) $links;
    }

    function PAFW_check_plugin_state(){
  		if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
    		set_transient( get_current_user_id() . 'wfcerror', 'message' );
  		}
  	}
	}
  	add_action('plugins_loaded', array('PAFW', 'PAFW_instance'));  	
}


add_action( 'plugins_loaded', 'PAFW_load_textdomain' );
 
function PAFW_load_textdomain() {
    load_plugin_textdomain( 'products-attachments-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function PAFW_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'products-attachments-for-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'PAFW_load_my_own_textdomain', 10, 2 );

