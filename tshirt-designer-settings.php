<?php	


if ( ! defined('ABSPATH')) exit; // if direct access 



if(empty($_POST['tshirt_designer_hidden']))
	{
		$tshirt_designer_posts_per_page = get_option( 'tshirt_designer_posts_per_page' );
		$tshirt_designer_allow_sticker_upload = get_option( 'tshirt_designer_allow_sticker_upload' );		
		$tshirt_designer_sticker_size = get_option( 'tshirt_designer_sticker_size' );
		
		
		
		
	}
else
	{	
		if($_POST['tshirt_designer_hidden'] == 'Y') {
			//Form data sent
			$tshirt_designer_posts_per_page = stripslashes_deep($_POST['tshirt_designer_posts_per_page']);
			update_option('tshirt_designer_posts_per_page', $tshirt_designer_posts_per_page);
	
			$tshirt_designer_allow_sticker_upload = stripslashes_deep($_POST['tshirt_designer_allow_sticker_upload']);
			update_option('tshirt_designer_allow_sticker_upload', $tshirt_designer_allow_sticker_upload);	
			
			$tshirt_designer_sticker_size = stripslashes_deep($_POST['tshirt_designer_sticker_size']);
			update_option('tshirt_designer_sticker_size', $tshirt_designer_sticker_size);				
			
			
			
			
			
	
			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.', 'tshirt_designer' ); ?></strong></p></div>
	
			<?php
			} 
	}
?>

<div class="wrap">
	<?php echo "<h2>".__(tshirt_designer_plugin_name.' Settings')."</h2>";
	
    $tshirt_designer_customer_type = get_option('tshirt_designer_customer_type');
    $tshirt_designer_version = get_option('tshirt_designer_version');
	
	
	?>
    <br />
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="tshirt_designer_hidden" value="Y">
        <?php settings_fields( 'tshirt_designer_plugin_options' );
				do_settings_sections( 'tshirt_designer_plugin_options' );
			
		?>

    <div class="para-settings">
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Options</li>
            <li nav="2" class="nav2">Help</li>
        </ul> <!-- tab-nav end -->  
        
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
            
				<div class="option-box">
                    <p class="option-title">Number of items on list</p>
                    <p class="option-info"></p>
                	<input size="15" type="text" name="tshirt_designer_posts_per_page" value="<?php if(!empty($tshirt_designer_posts_per_page)) echo $tshirt_designer_posts_per_page; else echo 10; ?>" />
                </div>
            
				<div class="option-box">
                    <p class="option-title">Allow Upload Custom Sticker.</p>
                    <p class="option-info">**Only for premium version.</p>
                    <select name="tshirt_designer_allow_sticker_upload" >
                        <option value="no" <?php if($tshirt_designer_allow_sticker_upload == 'no') echo 'selected'?> >No</option>
                        <option value="user" <?php if($tshirt_designer_allow_sticker_upload == 'user') echo 'selected'?> >User Only</option>
                        <option value="visitor" <?php if($tshirt_designer_allow_sticker_upload == 'visitor') echo 'selected'?> >Visitors</option>
                        
                    </select>
                	
                </div>     
				<div class="option-box">
                    <p class="option-title">Sticker file size.</p>
                    <p class="option-info">size in Mb. **Only for premium version</p>
                	<input size="15" type="text" name="tshirt_designer_sticker_size" value="<?php if(!empty($tshirt_designer_sticker_size)) echo $tshirt_designer_sticker_size; else echo 2; ?>" />Mb
                </div>
            
            
            
            </li>
            <li style="display: none;" class="box2 tab-box">
<div class="option-box">
                    <p class="option-title">Need Help ?</p>
                    <p class="option-info">Feel free to contact with any issue for this plugin, Ask any question via forum <a href="<?php echo tshirt_designer_qa_url; ?>"><?php echo tshirt_designer_qa_url; ?></a> <strong style="color:#139b50;">(free)</strong><br />

    <?php

    if($tshirt_designer_customer_type=="free")
        {
    
            echo 'You are using <strong> '.$tshirt_designer_customer_type.' version  '.$tshirt_designer_version.'</strong> of <strong>'.tshirt_designer_plugin_name.'</strong>, To get more feature you could try our premium version. ';
            
            echo '<br /><a href="'.tshirt_designer_pro_url.'">'.tshirt_designer_pro_url.'</a>';
            
        }
    else
        {
    
            echo 'Thanks for using <strong> premium version  '.$tshirt_designer_version.'</strong> of <strong>'.tshirt_designer_plugin_name.'</strong> ';	
            
            
        }
    
     ?>       

                    
                    </p>

                </div>
				<div class="option-box">
                    <p class="option-title">Please Share</p>
                    <p class="option-info">If you like this plugin please share with your social share network.</p>
					<?php echo tshirt_designer_share_plugin(); ?>
                </div>
				<div class="option-box">
                    <p class="option-title">Video Tutorial</p>
                    <p class="option-info">Please watch this video tutorial.</p>
                	<iframe width="640" height="480" src="<?php echo tshirt_designer_tutorial_video_url; ?>" frameborder="0" allowfullscreen></iframe>
                </div>




            </li>        
        
        
    
    </div>
<p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','team' ); ?>" />
                </p>
		</form>
        
</div> <!-- wrap end -->