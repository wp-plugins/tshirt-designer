jQuery(document).ready(function($)
	{



	$(document).on('click','.sticker-load-more',function(){
		
		$(this).addClass("loading");
		$(this).text("loading..");
		
		var offset = parseInt($(this).attr("offset"));
		var per_page = parseInt($(this).attr("per_page"));		
		
		$.ajax(
			{
		type: 'POST',
		url: tshirt_designer_ajax.tshirt_designer_ajaxurl,
		data: {"action": "tshirt_designer_get_sticker_list_ajax","offset":offset},
		success: function(data)
				{
					
					$(".sticker-list").append(data);
					$('.sticker-load-more').removeClass("loading");
					$('.sticker-load-more').html("Load More...");
					
					var offest_last = parseInt(offset+per_page);
					$(".sticker-load-more").attr("offset",offest_last);
					
					}
			});
		
	})


	$(document).on('click','.product-load-more',function(){
		
		$(this).addClass("loading");
		$(this).text("loading..");
		
		var offset = parseInt($(this).attr("offset"));
		var per_page = parseInt($(this).attr("per_page"));		
		
		$.ajax(
			{
		type: 'POST',
		url: tshirt_designer_ajax.tshirt_designer_ajaxurl,
		data: {"action": "tshirt_designer_get_product_list_ajax","offset":offset},
		success: function(data)
				{
					
					$(".product-list").append(data);
					$('.product-load-more').removeClass("loading");
					$('.product-load-more').html("Load More...");
					
					var offest_last = parseInt(offset+per_page);
					$(".product-load-more").attr("offset",offest_last);
					
					}
			});
		
	})










	$(document).on('click','.preview-save',function(){
		
		
		$('.preview-loading').css('display','inline-block');		
		var side = $(this).attr('side');
		var product_id = $(this).attr('product-id');
		var url = $(this).attr('url');		



		$.ajax(
			{
		type: 'POST',
		url:tshirt_designer_ajax.tshirt_designer_ajaxurl,
		data: {"action": "tshirt_designer_save_session", "side":side,"product_id":product_id ,"url":url},
		success: function(data)
				{	

					$(".preview-holder").fadeOut();
					location.reload();
					

				}
			});

		});



























	$(document).on('click', '.preview-close', function(){
		
		$(".preview-holder").fadeOut();
		})


	$(document).on('click', '.preview', function(){
		
		$(".preview-holder").fadeIn();
		
		
			html2canvas([ document.getElementById('canvas') ],{
			onrendered: function(canvas) {
				
				//alert(canvas.toDataURL());
				$('.preview-holder img').attr('src',canvas.toDataURL());
				$('.preview-save').attr('url',canvas.toDataURL());				
				
			//$('.tshirt-preview a').attr('href',canvas.toDataURL());			
			//$('.tshirt-preview img').attr('src',canvas.toDataURL());
			//$('.tshirt_gift_wrap').val(canvas.toDataURL());

		 	// window.open(canvas.toDataURL());
	
			 }
			});
		
		
		
		})
		
		

    $.fn.rotationDegrees = function () {
         var matrix = this.css("-webkit-transform") ||
    this.css("-moz-transform")    ||
    this.css("-ms-transform")     ||
    this.css("-o-transform")      ||
    this.css("transform");
    if(typeof matrix === 'string' && matrix !== 'none') {
        var values = matrix.split('(')[1].split(')')[0].split(',');
        var a = values[0];
        var b = values[1];
        var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
    } else { var angle = 0; }
    return angle;
   };




	$(document).on('change', '.rotate', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var rotate = $(this).val();	
		// for image
		$('.canvas #sticker-'+stickerid+' img').css('transform', 'rotate('+rotate+'deg)');
		$('.canvas #sticker-'+stickerid+' img').css('-ms-transform', 'rotate('+rotate+'deg)');		
		$('.canvas #sticker-'+stickerid+' img').css('-webkit-transform', 'rotate('+rotate+'deg)');
		
		// for text
		$('.canvas #sticker-'+stickerid+' p').css('transform', 'rotate('+rotate+'deg)');
		$('.canvas #sticker-'+stickerid+' p').css('-ms-transform', 'rotate('+rotate+'deg)');		
		$('.canvas #sticker-'+stickerid+' p').css('-webkit-transform', 'rotate('+rotate+'deg)');		
		
		
			
	
		})





	$(document).on('change', '.opacity', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var opacity = $(this).val();	
		$('.canvas #sticker-'+stickerid).css('opacity',(opacity));
	
		})



	$(document).on('change', '.layer', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var z_index = parseInt($(this).val());	
		$('.canvas #sticker-'+stickerid).css('z-index',(z_index));
	
		})
	
		
		
		
	$(document).on('click', '.remove-sticker', function(){
		
		var stickerid = $('.sticker-option').attr('stickerid');
		if(stickerid == '')
			{
				alert("Please select sticker first!!");
			}
			
		$('.canvas #sticker-'+stickerid).remove();
		
		})			
		
	$(document).on('change', '.sticker-text-font-size', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var font_size = parseInt($(this).val());	
		$('.canvas #sticker-'+stickerid+' p').css('font-size',font_size);
		$('.canvas #sticker-'+stickerid).css('font-size',font_size);
		
		$('.canvas #sticker-'+stickerid+' p').css('line-height',(font_size+5)+'px');
				
		})
		
	$(document).on('change', '.sticker-text-font-name', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var font_name = $(this).val();	
		$('.canvas #sticker-'+stickerid+' p').css('font-family',font_name);
		$('.canvas #sticker-'+stickerid).css('font-family',font_name);		

		})
		
	$(document).on('change', '.sticker-text-font-color', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var font_color = $(this).val();	
		$('.canvas #sticker-'+stickerid+' p').css('color','#'+font_color);
		$('.canvas #sticker-'+stickerid).css('color',font_color);
		})
		
		
	$(document).on('click', '.sticker-text-bold', function(){
		
		var stickerid = $('.sticker-option').attr('stickerid');
		var $this = $(this);
		
		 if($this.hasClass('active')){
		   $this.removeClass('active').addClass('inactive')
		   $('.canvas #sticker-'+stickerid+' p').css('font-weight','normal');
		 }else{
		   $this.removeClass('inactive').addClass('active');
		   $('.canvas #sticker-'+stickerid+' p').css('font-weight','bold');
		 }

		//$('.canvas #sticker-'+stickerid).css('font-weight','bold');
		})
		
		
	$(document).on('click', '.sticker-text-italic', function(){
		
		var stickerid = $('.sticker-option').attr('stickerid');
		var $this = $(this);
		
		 if($this.hasClass('active')){
			 
		   $this.removeClass('active').addClass('inactive')
		   $('.canvas #sticker-'+stickerid+' p').css('font-style','normal');
		 }else{
			 
		   $this.removeClass('inactive').addClass('active');
		   $('.canvas #sticker-'+stickerid+' p').css('font-style','italic');
		 }

		//$('.canvas #sticker-'+stickerid).css('font-weight','bold');
		})		
		
		
		
		
		
		
		
		
		
		
		
		
	$(document).on('change', '.sticker-text-input', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var text = $(this).val();	
		$('.canvas #sticker-'+stickerid+' p').text(text);

		})		
		

	$(document).on('click', '.sticker-text', function(){


		//$('.sticker p').circleType({radius: 384});
		
		//activating text tab
		$(".td-nav.active").removeClass("active");
		$('.td-nav3').addClass("active");
		$(".td-nav-box").css("display","none");
		$(".td-nav-box3").css("display","block");
		
		
		$('.sticker-text-option').fadeIn('slow');
		
		var stickerid = $(this).attr('stickerid');
		var text = $(this).text();
		var font_size = parseInt($(this).css('font-size'));		
		var font_name = $(this).children().css('font-family');
		var font_color = $(this).children().css('color');		
			
		$('.sticker-text-input').val(text);
		$('.sticker-text-id').val(stickerid);
		$('.sticker-text-font-size').val(font_size);
		$('.sticker-text-font-name').val(font_name);
		
		$('.sticker-text-font-color').val(rgb2hex(font_color));
		$('.sticker-text-font-color').css('background-color',font_color);		
		
		
							
		function rgb2hex(rgb) {
				 if (  rgb.search("rgb") == -1 ) {
					  return rgb;
				 } else {
					  rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
					  function hex(x) {
						   return ("0" + parseInt(x).toString(16)).slice(-2);
					  }
					  return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]); 
				 }
			}
			
			
		})

	$(document).on('click', '.sticker-img', function(){
		
		//activating sticker tab
		$(".td-nav.active").removeClass("active");
		$('.td-nav2').addClass("active");
		
		$(".td-nav-box").css("display","none");
		$(".td-nav-box2").css("display","block");
		
		})
		
		
		
		
	$(document).on('click', '.sticker', function(){
		
		
		$('.stickeractive').removeClass("stickeractive");
		$(this).addClass("stickeractive");

	
		
		var stickerid = $(this).attr('stickerid');
		var z_index = parseInt($(this).css('zIndex'));
		var opacity = $(this).css('opacity');
		var rotate = $(this).children().rotationDegrees();
		
		$('.sticker-option').attr('stickerid',stickerid);
		$('.sticker-option .layer').val(z_index);

		$('.sticker-option .opacity').val(opacity);		
		$('.sticker-option .rotate').val(rotate);
			
			
			
			
		$('.sticker-option').fadeIn('slow');		
		})	
		
		
		
		
	$(document).on('click', '.sticker-list img', function(){
		
			var sticker_src = $(this).attr('src');
			var stickerid = $(this).attr('stickerid');
			$(".canvas").prepend('<div class="sticker sticker-img" id="sticker-'+stickerid+'" stickerid="'+stickerid+'" style=" z-index:10;"><img rotate="0" src='+sticker_src+' /></div>');

			$('.sticker').draggable();
			$('.sticker').resizable();
			//$('.sticker img').rotatable();
			
			
		  }); 


	$(document).on('click', '.inserttext', function(){
		
		
		
			var text = $('.sticker-text-input').val();
			var stickerid = $('.sticker-text-id').val();
			var font_size = $('.sticker-text-font-size').val();
			var font_name = $('.sticker-text-font-name').val();
			var font_color = $('.sticker-text-font-color').val();
			
							
			$(".canvas").prepend('<div  class="sticker sticker-text" id="sticker-'+stickerid+'" stickerid="'+stickerid+'" style=" z-index:10;color:#'+font_color+';font-size:'+font_size+'px; font-family:'+font_name+'"><p style="color:#'+font_color+';font-size:'+font_size+'px; font-family:'+font_name+'">'+text+'</p></div>');

			$('.sticker').draggable();
			$('.sticker').resizable();
			//$('.sticker').rotatable();
			
			
			
			
		  }); 












		
		$(document).on('click', '.td-navs li', function()
			{
				$(".active").removeClass("active");
				$(this).addClass("active");
				
				var nav = $(this).attr("nav");
				
				$(".td-nav-boxs li.td-nav-box").css("display","none");
				$(".td-nav-box"+nav).css("display","block");
		
			})
			
			

		
		$(document).on('click', '.product-list img', function()
			{
				var product_id = $(this).attr("product-id");
				var src = $(this).attr("src");
				$('.preview-save').attr('product-id',product_id);
				

				$('.canvas img.main-tshirt').attr('src',src);				
				
				var front_img = $(this).attr("front-img");				
				var back_img = $(this).attr("back-img");					
				
				$('.canvas-menu .front').attr("front-img",front_img);	
				$('.canvas-menu .back').attr("back-img",back_img);				

				
			})

		
		$(document).on('click', '.canvas-menu .front', function()
			{
				
				var front_img = $(this).attr("front-img");		
				$('.canvas img.main-tshirt').attr('src',front_img);		
				//$('.canvas').css('background','url('+front_img+') no-repeat scroll 0 0 rgba(0, 0, 0, 0)');	
				
				
				$('.preview-save').attr('side','front');
				
				
				$('.loading-side').css('display','inline-block');
				$('.main-tshirt').load(function() {
					  $('.loading-side').fadeOut();
					});
				
			})
			
		$(document).on('click', '.canvas-menu .back', function()
			{
				var back_img = $(this).attr("back-img");
				$('.canvas img.main-tshirt').attr('src',back_img);	
				//$('.canvas').css('background','url('+back_img+') no-repeat scroll 0 0 rgba(0, 0, 0, 0)');
				
				$('.preview-save').attr('side','back');
				
				$('.loading-side').css('display','inline-block');
				$('.main-tshirt').load(function() {
					  $('.loading-side').fadeOut();
					});
			})

	});	







