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

    function login() {
        $status = $_SESSION['userid'];
        // if user already logged in, redirect to user index
        if ($this->logged_in()) {
            redirect('/include/profile_view');
        } else {
            $this->load->view('/include/index_view');
        }
    }

    /**
     * Will pass the users id to the db, and gets all the users data back, and
     * forwards it to the users profilpage
     */
    function showProfile() {
        $this->logged_in->status();
        $userid = 0;

        if ($this->uri->segment(3)) {
            $userid = $this->uri->segment(3);
        }
        if($userid == $_SESSION['userid']){
            $data['isUser'] = true;
        }
        else
            $data['isUser'] = false;

        $data['profile'] = $this->user_model->getUserById($userid);

        $data['pic_path'] = $this->user_model->getProfilePic($userid);

        $data['main_content'] = 'profile_view';

        $this->load->view('/include/template1_view', $data);
    }

    /**
     * Will pass the users id to the db, and gets all the users data back, and
     * forwards it to the users editProfile page.
     */
    function showEditProfile() {

        $userid = $_SESSION['userid'];
        //if(isset($user_data))
        $data['profile'] = $this->user_model->getUserById($userid);

        $data['pic_path'] = $this->user_model->getProfilePic($userid);

        $data['main_content'] = 'showEditProfile_view';
        $this->load->view('/include/template1_view', $data);
        //Print_r ($_SESSION);
        //print_r($this->session->all_userdata());
    }

    /**
     * Will save the editet tjeck the userdata and then save it to the DB.
     */
    function editProfile() {
        $userid = $_SESSION['userid'];
        //$email = $this->input->post('email');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('Oldpsw', 'Old Password', 'trim|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('passw', 'Password', 'trim|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('confirmPassw', 'Confirm Password', 'trim|matches[passw]');
        $oldpassw = $this->input->post('Oldpsw');
        $passw = $this->input->post('passw');
        $oldpasswHash = hash('sha512', $oldpassw, FALSE);
        $passwHash = hash('sha512', $passw, FALSE);
        $user_data = array(
            'userid' => $userid,
            'f_name' => $this->input->post('firstname'),
            'l_name' => $this->input->post('lastname'),
        );

        if ($this->form_validation->run() == FALSE) {

        	error_log("validation false");
        	$this->showEditProfile();
        	//redirect(base_url() . "user/showEditProfile");
        } else {
        	if(strlen($oldpassw) >= 6 || strlen($passw) >= 6){
        		if($this->user_model->tjeckPass($userid, $oldpasswHash)){
        			$user_data['pass'] = $passwHash;
        			//$this->showEditProfile($user_data);
        		} else {
        			$this->session->set_flashdata('error', 'Old password is not correct');
        			
        			//redirect(base_url() . "user/showEditProfile");
        		}
        		
        	}
        	
        	if($this->user_model->saveUserdata($user_data)){
        		$this->session->set_flashdata('error', 'Account data have been saved');
        		$this->showEditProfile();
        	}
        	
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
        } else if ($type == 2) { //link type == reset pasword
            $data['linkval'] = $linkVal;
            $this->load->view('resetPass_view', $data);
        }
    }

    function test() {
        $this->friend_model->get_friends(134, true);
//        $bar = array("id" => 3, "name" => "Byens Kro");
//        $data = $this->bar_model->saveBar($bar);
//        error_log(print_r($data, true));
    }

    /**
     * Will create a relation between 2 users, passing the users id to the model
     */
    function createRelation() {
        $user_data = array();
        $id = $_POST['msg_id'];
        $id1 = $_POST['owner_id'];
        $id2 = $_POST['submit_id'];
        if($id1<$id2){
            $user_data['id1'] = $id1;
            $user_data['id2'] = $id2;
        }
        else{
            $user_data['id1'] = $id2;
            $user_data['id2'] = $id1;
        }
        $this->friend_model->approve_friend($user_data);
        $this->message_model->deleteMessage($id);
        redirect();
    }

    /**
     * This function will make sure to get the user to his inbox, where all his messages are.
     */
    function goToInbox() {
        $id = $_SESSION['userid'];
        $data['messages'] = $this->message_model->getMessages($id);
        $data['main_content'] = 'message_view';
        $this->load->view('/include/template1_view', $data);
    }

    /**
     * This function will get som parameters and save them in the db tabel messages
     */
    function sendRepley() {
        $submitter =  $_SESSION['userid'];
        $data['owner_id'] = $_POST['owner_id'];
        $data['message'] = $_POST['messagebody'];
        $data['submit_id'] = $submitter;
        $data['submit_name'] = $this->makeUserName($submitter);
        $data['parent_id'] = $_POST['parent'];
        $this->message_model->insertMessage($data);
        redirect('user/goToInbox');
    }

    /*
     * This is the function that is needed to send a message to another
     */
    function sendMessage(){
        $submitter =  $_SESSION['userid'];
        $data['submit_id'] = $submitter;
        $data['submit_name'] = $this->makeUserName($submitter);
        $data['owner_id'] = $_POST['msg_to'];
        $data['msg_sub'] = $_POST['msg_sub'];
        $data['message'] = $_POST['msg_msg'];
        $data['parent_id'] = 0;
        $this->message_model->insertMessage($data);
        redirect('user/goToInbox');
    }

    /*
     * Will send a friend request to the other person
     */
    function sendFriendRequest() {
        $data['owner_id'] = $_POST['id'];
        $data['msg_sub'] = 'friend request%&¤';
        $submitter =  $_SESSION['userid'];
        $data['submit_id'] = $submitter;
        $data['submit_name'] = $this->makeUserName($submitter);
        $data['parent_id'] = 0;
        $this->message_model->insertMessage($data);
        redirect();
    }

    /*
     * simpel function that gets the name of a user
     */
    function makeUserName($id){
        $name = $this->user_model->getUserName($submitter); //returns both first and last name
        $first = $name['f_name'];
        $sec = $name['l_name'];
        return $first . ' ' . $sec;
    }
}

?>
