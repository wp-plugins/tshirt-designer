<?php





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tshirt_designer_add_images() {

    $screens = array( 'product');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'tshirt_designer_add_images',
            __( 'T-shirt Designer Options', 'tshirt_designer_textdomain' ),
            'tshirt_designer_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'tshirt_designer_add_images' );


function tshirt_designer_inner_custom_box( $post ) {


  wp_nonce_field( 'tshirt_designer_inner_custom_box', 'tshirt_designer_inner_custom_box_nonce' );


  $tshirt_designer_front_img = get_post_meta( $post->ID, 'tshirt_designer_front_img', true );
  $tshirt_designer_back_img = get_post_meta( $post->ID, 'tshirt_designer_back_img', true );
  

?>

<style type="text/css">
.tshirt-hint{
	font-size:12px;
	color:#696969;
	margin-top:10px;
	display:block;}
</style>

    <div class="para-settings">
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Front & Back</li>
  
        </ul> <!-- tab-nav end -->  
        
		<ul class="box">
        
            <li style="display: block;" class="box1 tab-box active">
				<div class="option-box">
                    <p class="option-title">Tshirt Front Image</p>
                    <p class="option-info">Image url for front side of tshirt, <br />Image Dimenssion: 500px:500px or any square size.</p>
                    <?php   echo '<input type="text" id="tshirt_designer_front_img" name="tshirt_designer_front_img" value="' . esc_attr( $tshirt_designer_front_img ) . '" size="25" />'; ?>
                    <br />
                    <?php   echo '<input type="button" id="tshirt_designer_front_img_upload" value="upload" class="button"/>'; ?>
                    <br />
					<?php
                    if(!empty( $tshirt_designer_front_img))
                        {
                    ?>
                    <img id="tshirt_designer_front_img_preview" src="<?php echo $tshirt_designer_front_img; ?>" width="150px"/>
                    
                    <?php
                        }
                        
                    else
                        {
                    ?>
                    <img id="tshirt_designer_front_img_preview" src="<?php echo tshirt_designer_plugin_url; ?>css/demo-tshirt-front.png" width="150px"/>
                    
                    <?php
                        }
                    ?>
                </div>
                
				<div class="option-box">
                    <p class="option-title">Tshirt Back Image</p>
                    <p class="option-info">Image url for back side of tshirt, <br />Image Dimenssion: 500px:500px or any square size.</p>
					<?php echo '<input type="text" id="tshirt_designer_back_img" name="tshirt_designer_back_img" value="' . esc_attr( $tshirt_designer_back_img ) . '" size="25" />'; ?>
					<br />
					<?php	echo '<input type="button" id="ttshirt_designer_back_img_upload" name="ttshirt_designer_back_img_upload" value="upload" class="button"/>'; ?>
                    <br />
					<?php
                    if(!empty( $tshirt_designer_back_img))
                        {
                    ?>
                    
                    <img id="tshirt_designer_back_img_preview" src="<?php echo $tshirt_designer_back_img; ?>" width="150px"/>
                    
                    <?php
                        }
                        
                    else
                        {
                    ?>
                    
                    <img  id="tshirt_designer_back_img_preview" src="<?php echo tshirt_designer_plugin_url; ?>css/demo-tshirt-back.png" width="150px" />
                    
                    <?php
                        }
                    ?>

                </div>
                
                
                
                
                
                
            
            </li>

		</ul>
	</div>



















<script>



  var custom_uploader_front;
	jQuery('#tshirt_designer_front_img_upload').click(function(e) {
 	
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_front) {
            custom_uploader_front.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader_front = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader_front.on('select', function() {
            attachment = custom_uploader_front.state().get('selection').first().toJSON();
            jQuery('#tshirt_designer_front_img').val(attachment.url);
			jQuery('#tshirt_designer_front_img_preview').attr("src",attachment.url);
        });
		
 
        //Open the uploader dialog
        custom_uploader_front.open();
 
    });
  
  
  
  
  
 
 
 
 
 
 var custom_uploader_back;
	jQuery('#ttshirt_designer_back_img_upload').click(function(e) {
 	
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader_back) {
            custom_uploader_back.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader_back = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader_back.on('select', function() {
            attachment = custom_uploader_back.state().get('selection').first().toJSON();
            jQuery('#tshirt_designer_back_img').val(attachment.url);
			jQuery('#tshirt_designer_back_img_preview').attr("src",attachment.url);			
        });
		
 
        //Open the uploader dialog
        custom_uploader_back.open();
 
    });
   
   
   
</script>

<?php


}


function tshirt_designer_save_postdata( $post_id ) {



  if ( ! isset( $_POST['tshirt_designer_inner_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['tshirt_designer_inner_custom_box_nonce'];

  if ( ! wp_verify_nonce( $nonce, 'tshirt_designer_inner_custom_box' ) )
      return $post_id;


  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;


  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  $tshirt_designer_front_img = sanitize_text_field( $_POST['tshirt_designer_front_img'] );
  $tshirt_designer_back_img = sanitize_text_field( $_POST['tshirt_designer_back_img'] );
  

  update_post_meta( $post_id, 'tshirt_designer_front_img', $tshirt_designer_front_img );
  update_post_meta( $post_id, 'tshirt_designer_back_img', $tshirt_designer_back_img );
   
}
add_action( 'save_post', 'tshirt_designer_save_postdata' );




























function td_sticker_register() {
 
        $labels = array(
                'name' => _x('Sticker', 'post type general name'),
                'singular_name' => _x('Sticker', 'post type singular name'),
                'add_new' => _x('Add Sticker', 't-shirt'),
                'add_new_item' => __('Add Sticker'),
                'edit_item' => __('Edit Sticker'),
                'new_item' => __('New Sticker'),
                'view_item' => __('View Sticker'),
                'search_items' => __('Search Sticker'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-nametag',
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title','thumbnail'),
				

          );
 
        register_post_type( 'td_sticker' , $args );

}


add_action('init', 'td_sticker_register');


// Custom Taxonomy
 
function td_sticker_cat_taxonomies() {
 
        register_taxonomy('td_sticker_cat', 'td_sticker', array(
                // Hierarchical taxonomy (like categories)
                'hierarchical' => true,
                'show_admin_column' => true,
                // This array of options controls the labels displayed in the WordPress Admin UI
                'labels' => array(
                        'name' => _x( 'Sticker Categories', 'taxonomy general name' ),
                        'singular_name' => _x( 'Sticker Categories', 'taxonomy singular name' ),
                        'search_items' =>  __( 'Search Sticker Categories' ),
                        'all_items' => __( 'All Sticker Categories' ),
                        'parent_item' => __( 'Parent Sticker Categories' ),
                        'parent_item_colon' => __( 'Parent Sticker Categories:' ),
                        'edit_item' => __( 'Edit Sticker Categories' ),
                        'update_item' => __( 'Update Sticker Categories' ),
                        'add_new_item' => __( 'Add Sticker Categories' ),
                        'new_item_name' => __( 'New Sticker Categories Name' ),
                        'menu_name' => __( 'Sticker Categories' ),
						
                ),
                // Control the slugs used for this taxonomy
                'rewrite' => array(
                        'slug' => 'td_sticker_cat', // This controls the base slug that will display before each term
                        'with_front' => false, // Don't display the category base before "/locations/"
                        'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
                ),
        ));
}
add_action( 'init', 'td_sticker_cat_taxonomies', 0 );
