<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_controller
 *
 * @author Kristian
 */
class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    /**
     * Will pass the users id to the db, and gets all the users data back, and
     * forwards it to the users profilpage
     */
    function showProfile() {

        $userid = 0;

        if ($this->uri->segment(3)) {
            $userid = $this->uri->segment(3);
        }
        $data['profile'] = $this->main_model->getUserById($userid);

        $data['main_content'] = 'profile_view';
        $this->load->view('/include/template1_view', $data);
    }
    
     /**
     * Will pass the users id to the db, and gets all the users data back, and
     * forwards it to the users editProfile page.
     */
    
    function showEditProfile() {

        $userid = $_SESSION['userid'];

		$data['profile'] = $this->main_model->getUserById($userid);

        $data['main_content'] = 'showEditProfile_view';
        $this->load->view('/include/template1_view', $data);
    }
    
    /**
    *Will save the editet tjeck the userdata and then save it to the DB.
    */
    
    function editProfile() {
    	
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('Oldpsw', 'Old Password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('passw', 'Password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('confirmPassw', 'Confirm Password', 'trim|required|matches[passw]');
        
        if ($this->form_validation->run() == FALSE) {
        	error_log("false");
        	$this->showEditProfile();
        } else if($this->form_validation->run() == TRUE) {
        	error_log("true");
        } 
       
    
    }


    /**
     * This method is called when a user clicks on a link in an email they have been sent.
     * The method receives a string parameter, and checks the database for the string, If the
     * link type is 1 (activate), the method to activate the user is called and if type is
     * 2 (reset password), the user is sent to a screen to create a new password
     * @param <type> $linkVal
     */
    function activate($linkVal) {
        list($user_id, $type) = $this->main_model->getUserForLink($linkVal);
        if ($type == 1) { //link type == activate
            $this->main_model->activateUser($user_id);
            $this->load->view('activateSuccess_view');
        }
        else if ($type == 2) { //link type == reset pasword
            $data['linkval'] = $linkVal;
            $this->load->view('resetPass_view', $data);
        }
    }
}
?>
