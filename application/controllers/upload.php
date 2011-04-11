<?php

class Upload extends CI_Controller {

    function  __construct() {
        parent::__construct();
        session_start();
        $this->logged_in->status();
    }

      function getUpload() {
        $data['main_content'] = 'upload_view';
        $this->load->view('/include/template1_view', $data);
    }


    /**
     * This function is called when a user is uploading a profile picture
     */
    function do_upload()
	{
		$config['upload_path'] = './assets/img/profilePics/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_view', $error);

                      

		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('showEditProfile_view', $data);

                
		}
	}

}

?>
