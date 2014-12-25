jQuery(document).ready(function ($) {
	

	
    var STICKER_Upload = {
        init:function () {

            this.attach();
            
        },
        attach:function () {
				
				

            if (sticker_upload.upload_enabled !== '1') {
                return
            }

            var uploader = new plupload.Uploader(sticker_upload.plupload);

            $('#sticker-uploader').click(function (e) {
				
				$('#sticker-upload-container .loading').css('display','block');
                uploader.start();
				
                // To prevent default behavior of a tag
                e.preventDefault();
            });

            //initilize  wp plupload
            uploader.init();

            uploader.bind('FilesAdded', function (up, files) {
                $.each(files, function (i, file) {
					
					$('#sticker-upload-container .loading').html(file.name+', Size: '+plupload.formatSize(file.size));
					
							
                });

               
			   
                uploader.start();
            });


            // On erro occur
            uploader.bind('Error', function (up, err) {
				
				$('#sticker-upload-container .loading').html('Error: '+err.code+', Message: '+err.message+'File:'+err.file.name);


                
            });

            uploader.bind('FileUploaded', function (up, file, response) {
                var result = $.parseJSON(response.response);
				
				
				
           
                if (result.success) {
					$('#sticker-upload-container .loading').fadeOut();
					
                    $('.sticker-list').prepend(result.html);
                    
                }
            });


        },

       


    };

    STICKER_Upload.init();
});