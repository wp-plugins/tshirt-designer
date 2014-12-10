<div class="wrap">
	<?php echo "<h2>".__(tshirt_designer_plugin_name.' Settings')."</h2>";
	
    $tshirt_designer_customer_type = get_option('tshirt_designer_customer_type');
    $tshirt_designer_version = get_option('tshirt_designer_version');
	
	
	?>
    <br />



    <div class="para-settings">
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Help</li>
        </ul> <!-- tab-nav end -->  
        
		<ul class="box">
        
            <li style="display: block;" class="box1 tab-box active">

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

        
</div> <!-- wrap end -->