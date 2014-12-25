<?php



class Alchimest__Ajax_Image_Upload
{




    public function display($atts = null)
    {
        if (isset($atts)) {
            if ($atts['theme'] == true) {
                $this->enquee(true);
            }
        }
       // include_once (tshirt_designer_plugin_dir . 'includes/html.php');

    }

    public function validate_options($input)
    {
        return $input;
    }

    public function enquee($theme = false)
    {
        if ($theme) {
            $this->add_script();
        } elseif ($this->has_shortcode('sticker')) {
            $this->add_script();

        }
    }

    public function add_script()
    {
        $this->options = get_option('sticker-options');

        wp_enqueue_script('jquery');


    }

    public function upload()
    {
		update_option('tshirt_designer_file_name', 'hello');
		
        check_ajax_referer('sticker_allow', 'nonce');

        $file = array(
            'name' => $_FILES['sticker_upload_file']['name'],
            'type' => $_FILES['sticker_upload_file']['type'],
            'tmp_name' => $_FILES['sticker_upload_file']['tmp_name'],
            'error' => $_FILES['sticker_upload_file']['error'],
            'size' => $_FILES['sticker_upload_file']['size']
        );
        $file = $this->fileupload_process($file);
	

	
	
	

    }

    public function fileupload_process($file)
    {
		
		
		
		
        $attachment = $this->handle_file($file);

        if (is_array($attachment)) {
            $html = $this->getHTML($attachment);

            $response = array(
                'success' => true,
                'html' => $html,
            );

            echo json_encode($response);
            exit;
        }

        $response = array('success' => false);
        echo json_encode($response);
        exit;
    }

    function handle_file($upload_data)
    {

        $return = false;
        $uploaded_file = wp_handle_upload($upload_data, array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            $file_loc = $uploaded_file['file'];
            $file_name = basename($upload_data['name']);
            $file_type = wp_check_filetype($file_name);

            $attachment = array(
                'post_mime_type' => $file_type['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_name)),
                'post_content' => '',
                'post_status' => 'inherit'
            );



            $attach_id = wp_insert_attachment($attachment, $file_loc);
            $attach_data = wp_generate_attachment_metadata($attach_id, $file_loc);
            wp_update_attachment_metadata($attach_id, $attach_data);

            $return = array('data' => $attach_data, 'id' => $attach_id);

            return $return;
        }

        return $return;
    }

    function getHTML($attachment)
    {

        $attach_id = $attachment['id'];
        $file = explode('/', $attachment['data']['file']);
        $file = array_slice($file, 0, count($file) - 1);
        $path = implode('/', $file);
        $image = $attachment['data']['sizes']['thumbnail']['file'];
        $post = get_post($attach_id);
        $dir = wp_upload_dir();
        $path = $dir['baseurl'] . '/' . $path;

        $html = '';
        $html .= '';
        $html .= sprintf('<img stickerid="'.$attach_id.'" src="%s" title="' . $post->post_title . '" />', $path . '/' . $image);

        return $html;
    }


    function has_shortcode($shortcode = '', $post_id = false)
    {
        global $post;

        if (!$post) {
            return false;
        }

        $post_to_check = ($post_id == false) ? get_post(get_the_ID()) : get_post($post_id);

        if (!$post_to_check) {
            return false;
        }
        $return = false;

        if (!$shortcode) {
            return $return;
        }

        if (stripos($post_to_check->post_content, '[' . $shortcode) !== false) {
            $return = true;
        }

        return $return;
    }

    public function delete_file()
    {
        $attach_id = $_POST['attach_id'];
        wp_delete_attachment($attach_id, true);
        exit;
    }

}




$stickerfile = WP_CONTENT_DIR . '/plugins/' . basename(dirname(__FILE__)) . '/' . basename(__FILE__);

$aaui = new Alchimest__Ajax_Image_Upload();

register_activation_hook($stickerfile, array($aaui, 'initialize_default_options'));
add_action('wp_enqueue_scripts', array($aaui, 'enquee'));
add_shortcode('sticker', array($aaui, 'display'));
add_action('wp_ajax_sticker_upload', array($aaui, 'upload'));
add_action('wp_ajax_sticker_delete', array($aaui, 'delete_file'));

/* For non logged-in user */
add_action('wp_ajax_nopriv_sticker_upload', array($aaui, 'upload'));
add_action('wp_ajax_nopriv_sticker_delete', array($aaui, 'delete_file'));

