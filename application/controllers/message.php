<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of message
 *
 * @author Kristian
 */
class Message extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    /**
     * This function will make sure to get the user to his inbox, where all his messages are.
     */
    function goToInbox() {
    	$is_logged_in = $this->logged_in->status();

        $id = $_SESSION['userid'];
        $data['messages'] = $this->message_model->getMessages($id);
        $data['main_content'] = 'message_view';
        if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}
        $this->load->view('/include/template1_view', $data);
    }

    /**
     * This function will get som parameters and save them in the db tabel messages
     */
    function sendRepley() {
    	$is_logged_in = $this->logged_in->status();
        $submitter =  $_SESSION['userid'];
        $data['owner_id'] = $_POST['owner_id'];
        $data['message'] = $_POST['messagebody'];
        $data['submit_id'] = $submitter;
        $data['submit_name'] = $this->makeUserName($submitter);
        $data['parent_id'] = $_POST['parent'];
        if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}
        $this->message_model->insertMessage($data);
        redirect('message/goToInbox');
    }

    /*
     * This is the function that is needed to send a message to another
     */
    function sendMessage(){
        $uri = $_POST['uri'];
        if($this->validatInput($uri)){
            $submitter =  $_SESSION['userid'];
            $data['submit_id'] = $submitter;
            $data['submit_name'] = $this->makeUserName($submitter);
            $data['owner_id'] = $_POST['msg_to'];
            $data['msg_sub'] = $_POST['msg_sub'];
            $data['message'] = $_POST['msg_msg'];
            $data['parent_id'] = 0;
            if($is_logged_in == "1"){
                error_log("inde i metode");
                $data['is_logged_in'] = "logged_in";
                }
                else{
                    $data['is_logged_in'] = "not_logged_in";
                }
            $this->message_model->insertMessage($data);
            redirect('message/goToInbox');
        }
    }

    /*
     * Will send a friend request to the other person
     */
    function sendFriendRequest() {
    	$is_logged_in = $this->logged_in->status();
        $data['owner_id'] = $_POST['id'];
        $data['msg_sub'] = 'friend request%&¤';
        $submitter =  $_SESSION['userid'];
        $data['submit_id'] = $submitter;
        $data['submit_name'] = $this->makeUserName($submitter);
        $data['parent_id'] = 0;
        if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}
        $this->message_model->insertMessage($data);
        redirect('user/showprofile/'.$_POST['id']);
    }

    /*
     * simpel function that gets the name of a user
     */
    function makeUserName($submitter){
        $name = $this->user_model->getUserName($submitter); //returns both first and last name
        $first = $name['f_name'];
        $sec = $name['l_name'];
        return $first . ' ' . $sec;
    }

    /*
     * this function will send a private message
     */
    function sendPrivateMessage(){
        $private = true;
        $id = $_POST['msg_to'];
        $uri = 'privateMessage_view';
        if($this->validatInput($uri, $private, $id)){
            $data['submit_id'] = $submitter;
            $submitter =  $_SESSION['userid'];
            $data['submit_name'] = $this->makeUserName($submitter);
            $data['owner_id'] = $_POST['msg_to'];
            $data['msg_sub'] = $_POST['msg_sub'];
            $data['message'] = $_POST['msg_msg'];
            $data['parent_id'] = 0;
            $this->message_model->insertMessage($data);
            redirect('user/showProfile/'.$_POST['msg_to']);
        }
    }

    function getPrivateMsgView($id = false){
        if($id){
            $data['user'] = $id;
        }
        else
            $data['user'] = $_POST['id'];
        $data['main_content'] = 'privateMessage_view';
        error_log('Her er post: '.$_POST['id']);
        $this->load->view('/include/template1_view', $data);
    }

    function validatInput($uri, $private = false, $id = false ){
        $this->form_validation->set_rules('msg_to', 'Message To', 'trim|required');
        $this->form_validation->set_rules('msg_sub', 'Message subject', 'trim|required');
        $this->form_validation->set_rules('msg_msg', 'Message', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            if($private){
                $this->getPrivateMsgView($id);
            }
            else{
                $data['main_content'] = ''.$uri;
                $this->load->view('/include/template1_view', $data);
            }
        }
        else
            return true;
    }
}
?>
