<?php
/*
Plugin Name: T-Shirt Designer
Plugin URI: http://paratheme.com
Description: Awesome T-Shirt Designer for woocommenrce.
Version: 1.0
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('tshirt_designer_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('tshirt_designer_plugin_dir', plugin_dir_path( __FILE__ ) );
define('tshirt_designer_wp_url', 'https://wordpress.org/plugins/tshirt-designer' );
define('tshirt_designer_wp_reviews_url', 'http://wordpress.org/support/view/plugin-reviews/tshirt-designer' );
define('tshirt_designer_pro_url','http://paratheme.com/items/t-shirt-designer-woocommerce-ready-online-product-designer/' );
define('tshirt_designer_demo_url', 'http://paratheme.com/demo/tshirt-designer/' );
define('tshirt_designer_conatct_url', 'http://paratheme.com/contact' );
define('tshirt_designer_qa_url', 'http://paratheme.com/qa/' );
define('tshirt_designer_plugin_name', 'T-Shirt Designer' );
define('tshirt_designer_share_url', 'http://paratheme.com/items/t-shirt-designer-woocommerce-ready-online-product-designer/' );
define('tshirt_designer_tutorial_video_url', '//www.youtube.com/embed/w_2qdMQqNQQ?rel=0' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/tshirt-designer-meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/tshirt-designer-functions.php');





function tshirt_designer_init_scripts()
	{

		wp_enqueue_script('jquery');
				
    	wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );		
    	wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-resizable' );

		wp_enqueue_style('jquery-ui.css', tshirt_designer_plugin_url.'css/jquery-ui.css');

		wp_enqueue_script( 'html2canvas.js', plugins_url( '/js/html2canvas.js', __FILE__ ), array('jquery'), '1.0', false);
		
		wp_enqueue_script( 'jscolor.js', plugins_url( '/js/jscolor.js', __FILE__ ), array('jquery'), '1.0', false);
		
		wp_enqueue_script('tshirt_designer_js', plugins_url( '/js/scripts.js' , __FILE__ ) , array( 'jquery' ));

				
		wp_localize_script( 'tshirt_designer_js', 'tshirt_designer_ajax', array( 'tshirt_designer_ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_style('tshirt_designer_style', tshirt_designer_plugin_url.'css/style.css');

		wp_enqueue_style( 'wp-color-picker' );	
		wp_enqueue_script( 'tshirt_designer_color_picker', plugins_url('/js/color-picker.js', __FILE__ ), false, true );



		//ParaAdmin
		wp_enqueue_style('ParaAdmin', tshirt_designer_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		//wp_enqueue_style('ParaDashboard', tshirt_designer_plugin_url.'ParaAdmin/css/ParaDashboard.css');		
		//wp_enqueue_style('ParaIcons', tshirt_designer_plugin_url.'ParaAdmin/css/ParaIcons.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));

		
		
		
	}
add_action("init","tshirt_designer_init_scripts");


register_activation_hook(__FILE__, 'tshirt_designer_activation');


function tshirt_designer_activation()
	{
		$tshirt_designer_version= "1.0";
		update_option('tshirt_designer_version', $tshirt_designer_version); //update plugin version.
		
		$tshirt_designer_customer_type= "free"; //customer_type "free"
		update_option('tshirt_designer_customer_type', $tshirt_designer_customer_type); //update plugin version.		
	}



add_action('admin_menu', 'tshirt_designer_menu_init');


	
function tshirt_designer_settings(){
	include('tshirt-designer-settings.php');
}

function tshirt_designer_menu_init()
	{
		add_menu_page(__('T-Shirt Designer','tshirt_designer'), __('T-Shirt Designer','tshirt_designer'), 'manage_options', 'tshirt_designer_settings', 'tshirt_designer_settings');
	}