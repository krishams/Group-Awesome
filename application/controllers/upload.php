<?php

class Upload extends CI_Controller {

    function  __construct() {
        parent::__construct();
        session_start();
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
                //defining a path to folder with same name as userid
                $pathname = './assets/img/profilePics/' . $_SESSION['userid'] . '/';
                //a permission or rights to create a folder
                $mode = 0777;
                
                //if path exist, don't create a folder
                if(file_exists($pathname))
                {
                    //folder exist..
                }
                else
                {
                    //create a new folder for the profilepics
                    mkdir($pathname, $mode);
                }

                $config['upload_path'] = $pathname;
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '1024';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
                    //If something goes wrong..
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata($error);
                    
                    redirect('upload/getUpload');
		}
		else
		{
                    //if everything is ok upload image and store path and filename in db
                    $image_data = $this->upload->data();

                    $data = array (
                      'user_id' => $_SESSION['userid'],
                      'path' => $image_data['full_path'],
                      'name' => $image_data['file_name']
             
                    );

                    //call to model to set the path and name in profile tabel
                    $this->upload_model->saveProfilePic($data);
                    
                    redirect('user/showEditProfile');

		}
	}

}

?>
