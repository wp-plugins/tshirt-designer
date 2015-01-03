<?php
/*
Plugin Name: T-Shirt Designer
Plugin URI: http://paratheme.com
Description: Awesome T-Shirt Designer for woocommenrce.
Version: 1.1
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('tshirt_designer_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('tshirt_designer_plugin_dir', plugin_dir_path( __FILE__ ) );
define('tshirt_designer_wp_url', 'https://wordpress.org/plugins/tshirt-designer' );
define('tshirt_designer_wp_reviews_url', 'http://wordpress.org/support/view/plugin-reviews/tshirt-designer' );
define('tshirt_designer_pro_url','http://paratheme.com/items/t-shirt-designer-woocommerce-ready-online-tshirt-designer/' );
define('tshirt_designer_demo_url', 'http://paratheme.com/demo/tshirt-designer/' );
define('tshirt_designer_conatct_url', 'http://paratheme.com/contact' );
define('tshirt_designer_qa_url', 'http://paratheme.com/qa/' );
define('tshirt_designer_plugin_name', 'T-Shirt Designer' );
define('tshirt_designer_share_url', 'https://wordpress.org/plugins/tshirt-designer' );
define('tshirt_designer_tutorial_video_url', '//www.youtube.com/embed/w_2qdMQqNQQ?rel=0' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/tshirt-designer-meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/tshirt-designer-functions.php');
//require_once( plugin_dir_path( __FILE__ ) . 'includes/ajax-upload.php');



function tshirt_designer_init_scripts()
	{
		
		$tshirt_designer_sticker_size = get_option( 'tshirt_designer_sticker_size' );
		if(empty($tshirt_designer_sticker_size))
			{
				$tshirt_designer_sticker_size = intval(2*1000*1000);
			}
		else
			{
				$tshirt_designer_sticker_size = intval($tshirt_designer_sticker_size*1000*1000);
			}

		wp_enqueue_script('jquery');		
    	wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );		
    	wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-resizable' );

		wp_enqueue_style('jquery-ui.css', tshirt_designer_plugin_url.'css/jquery-ui.css');

		wp_enqueue_script( 'html2canvas.js', plugins_url( '/js/html2canvas.js', __FILE__ ), array('jquery'), '1.0', false);
		
		
		//wp_enqueue_script( 'circletype.js', plugins_url( '/js/circletype.js', __FILE__ ), array('jquery'), '1.0', false);	
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

        wp_enqueue_script('plupload-handlers');
        wp_enqueue_script('sticker_upload', tshirt_designer_plugin_url . 'js/upload-sticker.js', array('jquery'));

        wp_localize_script('sticker_upload', 'sticker_upload', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sticker_upload'),
            'remove' => wp_create_nonce('sticker_remove'),
            'number' => 5,
            'upload_enabled' => true,
            'confirmMsg' => __('Are you sure you want to delete this?'),
            'plupload' => array(
                'runtimes' => 'html5,flash,html4',
                'browse_button' => 'sticker-uploader',
                'container' => 'sticker-upload-container',
                'file_data_name' => 'sticker_upload_file',
                'max_file_size' => $tshirt_designer_sticker_size.'b',
                'url' => admin_url('admin-ajax.php') . '?action=sticker_upload&nonce=' . wp_create_nonce('sticker_allow'),
                'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
                'filters' => array(array('title' => __('Allowed Files'), 'extensions' => 'gif,png')),
                'multipart' => true,
                'urlstream_upload' => true,
            )
        ));
		
	}
add_action("init","tshirt_designer_init_scripts");


register_activation_hook(__FILE__, 'tshirt_designer_activation');


function tshirt_designer_activation()
	{
		$tshirt_designer_version= "1.1";
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
	
	
	
	
	
	
//////////////

