<?php






function tshirt_designer_display($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",
				), $atts);

	$html = '';
	
	if(!empty($_SESSION['product_id'])){
		
		$product_id = $_SESSION['product_id'];


		};


	$html .= '<div class="tshirt-designer-container">';
	
	if(!empty($_SESSION['product_id']))
		{
	
	$html .= '<div class="preview-images">';
	
	if(!empty($_SESSION['tshirt_designer_front_img'])){
		
		$tshirt_designer_front_img = $_SESSION['tshirt_designer_front_img'];
		$html .= '<div ><span class="front-image-info">Front</span><img class="front-image" src="'.$tshirt_designer_front_img.'" /></div>';
	
	};
	
	if(!empty($_SESSION['tshirt_designer_back_img'])){
		
		$tshirt_designer_back_img = $_SESSION['tshirt_designer_back_img'];
		$html .= '<div><span class="back-image-info">Back</span><img class="back-image" src="'.$tshirt_designer_back_img.'" /></div>';	
		};
		
	global $woocommerce;
	
	$html.= '<form class="cart" enctype="multipart/form-data" method="post">
	<input class="input-text qty text" type="number" size="4" title="Qty" value="1" name="quantity" min="1" step="1">
	<input type="hidden" value="'.$product_id.'" name="add-to-cart">
	<input type="hidden" value="'.$tshirt_designer_front_img.'" name="tshirt_designer_front_img" size="3">
	<input type="hidden" value="'.$tshirt_designer_back_img.'" name="tshirt_designer_back_img" size="3">
	<input type="hidden" value="cart" name="tshirt_designer_cart" size="3">
	<button class="single_add_to_cart_button button alt" type="submit">Add to cart</button>
	
	</form>'; 
	
	
	if(isset($_POST['tshirt_designer_cart']) )
		{
			$html.= '<a href="'.$woocommerce->cart->get_cart_url().'"><strong>View Cart</strong></a>';
		}
		
	$html .= '</div>';
	}
	


	
	$html .= '<div class="preview-holder"><img src="" />
	<span class="preview-close"></span>
	<span class="preview-save" side="front" product-id="0" url=""></span>	
	<span class="preview-loading" ></span>	
	</div>';
	$html .= '<div class="tools-input">';
	$html .= '<ul class="td-navs"> 
					<li nav="1" class="td-nav td-nav1 active">Product</li>
					<li nav="2" class="td-nav td-nav2">Sticker</li>
					<li nav="3" class="td-nav td-nav3">Text</li>

				</ul> <!-- tab-nav end -->
				 
				<ul class="td-nav-boxs">
				<li style="display: block;" class="td-nav-box1 td-nav-box active">
				<div class="td-option-box">'.tshirt_designer_get_product_list().'
                </div>
				</li>
				<li style="display: none;" class="td-nav-box2 td-nav-box">
                <div class="sticker-option" stickerid="" z-index="">
					
					<label >Remove <span title="Remove Selected Sticker." class="remove-sticker" ></span></label>
					<label >Z-Index  <input title="Z-index for Selected Sticker." size="10" class="layer" type="number" min="0" max="9999"></label>
					<label >Opacity  <input title="Opacity for Selected Sticker." size="10" class="opacity" type="number" min="0" max="1" step="0.01"></label>
					<label >Rotation <input title="Rotate for Selected Sticker." size="10" class="rotate" type="number" min="-360" max="360" step="1"></label>
				</div>
				<div class="td-option-box">'.tshirt_designer_get_sticker_list().'</div>

				</li>
				<li style="display: none;" class="td-nav-box3 td-nav-box">
				<div class="td-option-box">
					<div class="sticker-text-option">
					<label >Remove <span title="Remove Selected Sticker." class="remove-sticker" ></span></label><br/>
					
						<input placeholder="text font size. ex: 18" size="5" type="number" min="0" max="9999" class="sticker-text-font-size" />
						<input  placeholder="text font color. ex: #66ff00" size="10" value="66ff00" class="sticker-text-font-color color" />

					</div>
					<textarea placeholder="Text Here" class="sticker-text-input" style="width:90%;" role="" rows="2" ></textarea>
					<input placeholder="Sticker ID" type="text" class="sticker-text-id" />
					<span class="inserttext">Insert</span>
				
				
                </div>
				</li>
				
			';	
	$html .= '</div>';
	$html .= '<div class="playground">';
	$html .= '<div class="canvas-menu">';
	$html .= '<span class="front" front-img="">Front</span>';
	$html .= '<span class="back" back-img="">Back</span>';
	$html .= '<span class="preview">Preview</span>';
	$html .= '<span class="loading-side">&nbsp;</span>';
	$html .= '</div>';
	
	$html .= '<div class="canvas" id="canvas"><img alt="Please select tshirt first." class="main-tshirt" src="'.tshirt_designer_plugin_url.'/css/demo-tshirt-front.png" /></div>';

	$html .= '</div>';

	$html .= '</div>';
	
	return $html;



	}
	
add_shortcode('tshirt_designer', 'tshirt_designer_display');






function tshirt_designer_get_product_list()
	{
		
		$tshirt_designer_posts_per_page = get_option('tshirt_designer_posts_per_page');
		if(empty($tshirt_designer_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $tshirt_designer_posts_per_page;
			}
		
		
		$args_tshirt = array(
			
			'post_type' => 'product',
			'post_status' => 'publish',		
			'meta_key' => 'tshirt_designer_front_img',
			'meta_value' => '',
			'meta_compare' => '!=',
			
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var( 'paged' ),
			
			);
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	

		$html = '';
		//$html .= tshirt_designer_get_product_cat();
		$html.='<div class="product-list">';

		if($tshirt_query->have_posts()): while($tshirt_query->have_posts()): $tshirt_query->the_post();
		
			$tshirt_designer_front_img = get_post_meta(get_the_ID(),'tshirt_designer_front_img',true);
			$tshirt_designer_back_img = get_post_meta(get_the_ID(),'tshirt_designer_back_img',true);

			if(!empty($tshirt_designer_front_img))
				{
				$html.= '<img front-img="'.$tshirt_designer_front_img.'" back-img="'.$tshirt_designer_back_img.'" product-id="'.get_the_ID().'" src="'.$tshirt_designer_front_img.'"/>';

				}
		
		endwhile; 
		wp_reset_postdata();
		endif;
		$html.='</div>';
		

		return $html;

	}

function tshirt_designer_get_product_list_ajax()
	{
		if(isset($_POST['offset'])) $offset = (int)$_POST['offset'];
		
		$tshirt_designer_posts_per_page = get_option('tshirt_designer_posts_per_page');
		if(empty($tshirt_designer_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $tshirt_designer_posts_per_page;
			}
		
		$args_tshirt = array(
			
			'post_type' => 'product',
			'post_status' => 'publish',
			'meta_key' => 'tshirt_designer_front_img',
			'meta_value' => '',
			'meta_compare' => '!=',
			
			'posts_per_page' => $posts_per_page,
			'offset' => $offset,
			
			);
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	
		
		$html = '';
if($tshirt_query->have_posts()){
	 while($tshirt_query->have_posts()): $tshirt_query->the_post();
		
			$tshirt_designer_front_img = get_post_meta(get_the_ID(),'tshirt_designer_front_img',true);
			$tshirt_designer_back_img = get_post_meta(get_the_ID(),'tshirt_designer_back_img',true);

			if(!empty($tshirt_designer_front_img))
				{
				$html.= '<img front-img="'.$tshirt_designer_front_img.'" back-img="'.$tshirt_designer_back_img.'" product-id="'.get_the_ID().'" src="'.$tshirt_designer_front_img.'"/>';

				}
		
		endwhile; 
		wp_reset_postdata();
		
		}
		else{ ?>
<script>
jQuery(document).ready(function($)
	{
		
		$('.product-load-more').css('background','#ff5337');
		$('.product-load-more').prop('disabled', true);
		$('.product-load-more').css('cursor', 'not-allowed');

	})
</script>
<?php
		}
		echo $html;
		die();
		
	
	}
add_action('wp_ajax_tshirt_designer_get_product_list_ajax', 'tshirt_designer_get_product_list_ajax');
add_action('wp_ajax_nopriv_tshirt_designer_get_product_list_ajax', 'tshirt_designer_get_product_list_ajax');













function tshirt_designer_get_product_cat()
	{
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => 'product_cat',
		  );
		$html = '';
		$html .= 'Categories: <select class="product-cat">';
		$categories = get_categories($args);
		foreach($categories as $category){
			
			$html .= '<option class='.$category->cat_ID.'>'.$category->cat_name.'</option>';	
		
		}
				
		$html .= '</select>';
		
		return $html;
	
	}
	
	

function tshirt_designer_get_sticker_cat()
	{
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => 'td_sticker_cat',
		  );
		$html = '';
		$html .= 'Categories: <select class="sticker_cat">';
		
		$categories = get_categories($args);
		
		foreach($categories as $category){
			
			$html .= '<option class='.$category->cat_ID.'>'.$category->cat_name.'</option>';	
		
		}
				
		$html .= '</select>';
		
		return $html;
	
	}
	
function tshirt_designer_get_sticker_list_ajax()
	{
		if(isset($_POST['offset'])) $offset = (int)$_POST['offset'];
		
		$tshirt_designer_posts_per_page = get_option('tshirt_designer_posts_per_page');
		if(empty($tshirt_designer_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $tshirt_designer_posts_per_page;
			}
		
		$args_tshirt = array(
			
			'post_type' => 'td_sticker',
			'post_status' => 'publish',
			'meta_key' => '_thumbnail_id',
			'meta_value' => '',
			'meta_compare' => '!=',
			'posts_per_page' => $posts_per_page,
			'offset' => $offset,
			);
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	

		$html = '';


		if($tshirt_query->have_posts()){ while($tshirt_query->have_posts()): $tshirt_query->the_post();
		

			$sticker_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

			if(!empty($sticker_url))
				{
					$html.= '<img stickerid="'.get_the_ID().'" src="'.$sticker_url.'"/>';

				}
		
		endwhile;
		wp_reset_postdata();
		}
		else
			{

     
			}
		echo $html;
		die();
	
	}	
add_action('wp_ajax_tshirt_designer_get_sticker_list_ajax', 'tshirt_designer_get_sticker_list_ajax');
add_action('wp_ajax_nopriv_tshirt_designer_get_sticker_list_ajax', 'tshirt_designer_get_sticker_list_ajax');


function tshirt_designer_get_sticker_list()
	{
		$tshirt_designer_posts_per_page = get_option('tshirt_designer_posts_per_page');
		if(empty($tshirt_designer_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $tshirt_designer_posts_per_page;
			}
		
		$args_tshirt = array(
			
			'post_type' => 'td_sticker',
			'post_status' => 'publish',
			'meta_key' => '_thumbnail_id',
			'meta_value' => '',
			'meta_compare' => '!=',
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var( 'paged' ),
			);
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	

		$html = '';

		$html .='<div class="sticker-list">';

		if($tshirt_query->have_posts()): while($tshirt_query->have_posts()): $tshirt_query->the_post();
		

			$sticker_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

			if(!empty($sticker_url))
				{
					$html.= '<img stickerid="'.get_the_ID().'" src="'.$sticker_url.'"/>';

				}
		
		endwhile;
		wp_reset_postdata();
		endif;
		$html.='</div>';
		
		
		

		

		return $html;

	}






function tshirt_designer_is_user_logged()
{
	if(is_user_logged_in())
		{
			return true;
		}
	else
		{
			return false;
		}
	
}


function tshirt_designer_init_session()
	{
	  session_start();
	}

add_action('init', 'tshirt_designer_init_session', 1);




function tshirt_designer_save_session() {
	
	
	$side = $_POST['side'];
	$product_id = $_POST['product_id'];
	$url = $_POST['url'];
	
	$_SESSION['product_id'] = $product_id;
	
	
	
	 if($side == "front")
		{
			$_SESSION['tshirt_designer_front'] = $url;
		}
	else if($side == "back")
		{
			$_SESSION['tshirt_designer_back'] = $url;
		}

			
			
	$uniqid = uniqid();
	$img = $url;
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = tshirt_designer_plugin_dir.'tshirt/'. $uniqid . '.png';
	$success = file_put_contents($file, $data); 	

	$img_url = tshirt_designer_plugin_url.'tshirt/'.$uniqid.'.png';
		
	 if($side == "front")
		{
			$_SESSION['tshirt_designer_front_img'] = $img_url;
		}
	else if($side == "back")
		{
			$_SESSION['tshirt_designer_back_img'] = $img_url;
		}
		
		
		
		
			
	die();
	
	}

add_action('wp_ajax_tshirt_designer_save_session', 'tshirt_designer_save_session');
add_action('wp_ajax_nopriv_tshirt_designer_save_session', 'tshirt_designer_save_session');





//cart_item_data

	add_filter( 'woocommerce_add_cart_item_data', 'tshirt_designer_add_cart_item_data', 10, 2 );
	function tshirt_designer_add_cart_item_data( $cart_item_meta, $product_id ) {
		global $woocommerce;



		if ( (!empty( $_POST['tshirt_designer_front_img'] )) || (!empty( $_POST['tshirt_designer_back_img'] )) )
		
			$cart_item_meta['tshirt_designer_front_img'] = $_POST['tshirt_designer_front_img'];
			$cart_item_meta['tshirt_designer_back_img'] = $_POST['tshirt_designer_back_img'];			
			

		return $cart_item_meta;
	}

	add_filter( 'woocommerce_get_cart_item_from_session', 'tshirt_designer_get_cart_item_from_session' , 10, 2 );
	function tshirt_designer_get_cart_item_from_session( $cart_item, $values ) {

		if ( (!empty( $values['tshirt_designer_front_img'] )) || (!empty( $values['tshirt_designer_back_img'] )) ) {
			
			$cart_item['tshirt_designer_front_img'] = $values['tshirt_designer_front_img'];
			$cart_item['tshirt_designer_back_img'] = $values['tshirt_designer_back_img'];
		}
		

		return $cart_item;
	}
	
	
	
	
	
	add_filter( 'woocommerce_get_item_data',  'tshirt_designer_get_item_data' , 10, 2 );
	function tshirt_designer_get_item_data( $item_data, $cart_item ) {
		
	// at cart page, checkout page
		if ( (!empty( $cart_item['tshirt_designer_front_img']) ) || (!empty( $cart_item['tshirt_designer_back_img']) ))
		{
		
			$item_data[] = array(
				'name'    => __( 'tshirt_designer_front_img', 'tshirt_designer_front_img' ),
				'value'   => __( $cart_item['tshirt_designer_front_img'], 'tshirt_designer_front_img' ),
				'display' => __( $cart_item['tshirt_designer_front_img'], 'tshirt_designer_front_img' )
			);
			
			$item_data[] = array(
				'name'    => __( 'tshirt_designer_back_img', 'tshirt_designer_back_img' ),
				'value'   => __( $cart_item['tshirt_designer_back_img'], 'tshirt_designer_back_img' ),
				'display' => __( $cart_item['tshirt_designer_back_img'], 'tshirt_designer_back_img' )
			);	
		}		

		return $item_data;
	}
	
	
	
	
	
	add_filter( 'woocommerce_add_cart_item', 'tshirt_designer_add_cart_item' , 10, 1 );
	function tshirt_designer_add_cart_item( $cart_item ) {
		if ( (!empty( $cart_item['tshirt_designer_front_img'] )) || (!empty( $cart_item['tshirt_designer_back_img'] ))) 
		{

		}

		return $cart_item;
	}
	
	
	
	
	add_action( 'woocommerce_add_order_item_meta',  'tshirt_designer_add_order_item_meta' , 10, 2 );
	function tshirt_designer_add_order_item_meta( $item_id, $cart_item ) {
	 
	 //order completed page. & admin
	 
		if ( (!empty( $cart_item['tshirt_designer_front_img'] )) ||  (!empty( $cart_item['tshirt_designer_back_img'] )))
			{
				 woocommerce_add_order_item_meta( $item_id, 'tshirt_designer_front_img', $cart_item['tshirt_designer_front_img'] );
				 woocommerce_add_order_item_meta( $item_id, 'tshirt_designer_back_img', $cart_item['tshirt_designer_back_img'] ); 
			}		 
			 
	}
	
	
	
	
	
	
	
	
	
	
	
	function tshirt_designer_share_plugin()
		{
			
			?>
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwordpress.org%2Fplugins%2Ftshirt-designer%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo tshirt_designer_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo tshirt_designer_share_url; ?>" data-text="<?php echo tshirt_designer_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php
			
			
			
		
		
		}
	
	
	
	

/////////////////////////////

