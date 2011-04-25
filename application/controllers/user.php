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
        $data['profile'] = $this->main_model->getUserById($userid);

        $data['pic_path'] = $this->user_model->getProfilePic($userid);

        $data['main_content'] = 'showEditProfile_view';
        $this->load->view('/include/template1_view', $data);
        //Print_r ($_SESSION);
        print_r($this->session->all_userdata());
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
            //$this->session->set_flashdata('error', 'Old password is not correct');
            redirect(base_url() . "user/showEditProfile");
        } else {
            if (isset($oldpassw, $passw)) {
                if ($this->user_model->tjeckPass($userid, $oldpasswHash)) {
                    $user_data['pass'] = $passwHash;
                    //$this->showEditProfile($user_data);
                } else {
                    $this->session->set_flashdata('error', 'Old password is not correct');
                    redirect(base_url() . "user/showEditProfile");
                }
            }

            if ($this->user_model->saveUserdata($user_data)) {
                redirect('user/showEditProfile');
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

    /**
     * Will create a relation between 2 users, passing the users id to the model
     */
    function createRelation() {
        $user_data = array(//needs to contain user_id1 and user_id2
        );
        $this->user_model->createFriend($user_data);
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
        $name = $this->user_model->getUserName($submitter); //returns both first and last name
        $first = $name['f_name'];
        $sec = $name['l_name'];
        $data['submit_name'] = $first . ' ' . $sec;
        $data['parent'] = $_POST['parent'];
        $this->message_model->insertMessage($data);
        redirect('user/goToInbox');
    }

    /*
     * This is the function that is needed to send a message to another
     */
    function sendMessage(){
        $submitter =  $_SESSION['userid'];
        $data['submit_id'] = $submitter;
        $name = $this->user_model->getUserName($submitter); //returns both first and last name
        $first = $name['f_name'];
        $sec = $name['l_name'];
        $data['submit_name'] = $first . ' ' . $sec;
        $data['owner_id'] = $_POST['msg_to'];
        $data['msg_sub'] = $_POST['msg_sub'];
        $data['message'] = $_POST['msg_msg'];
        $data['parent'] = 0;
        $this->message_model->insertMessage($data);
        redirect('user/goToInbox');
    }

    /*
     * Will send a friend request to the other person
     */
    function sendFriendRequest() {
        
    }
}

?>
