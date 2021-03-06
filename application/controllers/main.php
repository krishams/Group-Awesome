<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    /**
     * loads the initial log-in screen
     */
    function index() {
        $is_logged_in = $this->logged_in->status();
        $data['main_content'] = 'home_view';
        if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}
        $this->load->view('/include/template1_view', $data);
    }

    /**
     * This methode calls another method to verify the login informations,
     * if true it directs the user to the home_view, otherwise it reloads the
     * page with an error message.
     */
    function login() {//$id)
    	if ($this->verifyLogin()) {
    		redirect(base_url());
    	} else {
        $data = l(array('mail' => "", 'password' => "", 'sign_in' => "", 'sign_up' => "", 'forgot_pw' => ""));

      	$data['error'] = $this->session->flashdata('error');
        $data['main_content'] = 'index_view';
        $data['email'] = $this->lang->line('email');
        $this->load->view('/include/template_view', $data);
        }
    
    }

    /**
     * This function will open the home_view, if the user is already logged in
     */
/*
    function goHome() {
        $data['main_content'] = 'home_view';
        $this->load->view('/include/template1_view', $data);
    }
*/

    /**
     * Used after a user has entered a new password from the reset password screen. This checks
     * that the passwords are the same and meet the minimum length. If so, it will call the
     * resetPassword method from the model and send the user to a new screen.
     */
    function resetPassSuccess() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('passw', 'Password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('confirmPassw', 'Confirm Password', 'trim|required|matches[passw]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('resetPass_view');
        } else {
            list($user_id, ) = $this->main_model->getUserForLink($this->input->post('linkVal'));
            $newPass = $this->input->post('passw');
            $this->main_model->resetPassword(array($user_id, $newPass));
            $this->load->view('resetPassSuccess_view');
        }
    }

    /**
     * This method will get a string with a search criteria and forward it to
     * a method in the main_model, then it will load a new page where the search
     * results will be displayed
     */
    function searchUser() {
        if ($this->input->get('search')) {
            $search = $this->uri->segment(3);
            $data['searchdata'] = $this->main_model->searchUser($search);
            if($is_logged_in == "1"){
                $data['is_logged_in'] = "logged_in";}
                else{$data['is_logged_in'] = "not_logged_in";}
            $this->load->view('searchUser_view', $data);
        }
    }

    /**
     * It will work together with the ajax code on the home_view page
     * !!!!!!!!!!!    This function is currently not working !!!!!!!!!!!!!!!!
     */
    function searchUserButton() {
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $data['searchdata'] = $this->main_model->searchUser($search);
            $data['main_content'] = 'searchUser_view';
            $this->load->view('/include/template1_view', $data);
        }
    }

    /**
     * This method helps to verify the user that is trying to log into our web-
     * page. It verifies that the user has a session.
     */
    function verifyLogin() {
        if ($this->input->post('email')) {
            $mail = $this->input->post('email');
            $pw = $this->input->post('passw');
            $data = $this->main_model->verifyUser($mail, $pw);
            if ($data != null) {
                $_SESSION['userid'] = $data['id'];
                $_SESSION['username'] = $data['email'];
                return true;
            }
            else
                return false;
        }
    }

    /**
     * This function is needed when the user wants to log out of the webpage
     */
    function logOut() {
        session_destroy();
        redirect(base_url());
    }

}
