<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    /**
     * loads the initial log-in screen
     */
    function index() {
        $data['error'] = $this->session->flashdata('error');
        $data['main_content'] = 'index_view';
        $this->load->view('/include/template_view', $data);
    }

    /**
     * This methode calls another method to verify the login informations,
     * if true it directs the user to the home_view, otherwise it reloads the
     * page with an error message.
     * @param <type> $id
     */
    function getHome() {//$id)
        if($this->verifyLogin()){
            $data['main_content'] = 'home_view';
            $this->load->view('/include/template1_view', $data);
        }
        else {
        	redirect();
        }
    }

    /**
     * loads the registration view page
     */
    function getRegistration()
    {
        $data['main_content'] = 'registration_view';
        $this->load->view('/include/template_view', $data);
    }

    /**
     * Saves the user registration information and sends a confirmation email with a link to log on.
     * First we load the helper form_validation, which makes it possible to set som rules for our form.
     * in the rules we 3 parameters, 1: the fieldname, 2: errormessage and 3: the validation rule.
     * trim means removing malicious code.
     */
    function submitRegistration() {
        //check if the captha is correct
        //control that all fields have data in them, if not display which is missing - done
        //check if email already exist in db, if not then display error - ½ done

        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('passw', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('confirmPassw', 'Confirm Password', 'trim|required|matches[passw]');

        if ($this->form_validation->run() == FALSE) {
            $this->getRegistration();
        } else if ($this->main_model->emailValidation()) {
            redirect('main_controller/getRegistration');
            //print error message
        } else {
            if ($this->main_model->saveUserdata()) {
                $data['main_content'] = 'checkMail_view';
                $this->load->view('include/template_view', $data);
            } else {
                $this->load->view('registration_view');
            }
        }
    }

    /**
     * loads the page to request a password
     */
    function getRequestPassword()
    {
        $data['main_content'] = 'requestPass_view';
        $this->load->view('/include/template_view', $data);
    }

    /**
     * Checks if the email exists and if so, sends a reset link.
     * If not, the user is alerted so they can re-type the password.
     * @param <string> $email
     * 
     * User clicks on link, "Forgot your password"
     * User types in his/her email address
     * You put a random key and temporary password in the user table
     * You send an email with a link to activate the password you set. The link has the random key
     * User clicks on link. The link should match the random string
     * You activate the password and clear the temporary password and the random string
     * User logs in and changes his password to something he wants
     */
    function submitRequestPassword() {

        //1. first email validation - done

        //make random key as a temp password in usertabel:
        //2. call to model to generate a random string

        //send email with an activation link and a temp password - ½done
        //3. call email function

            $config = Array(

                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'awesome.pubcrawl2011@gmail.com',
                    'smtp_pass' => 'group.awesome'
            );

        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('requestPass_view');
        }
        else
        {
                //validation has passed, so send email
                $email = $this->input->post('email');
                $this->load->library('email', $config);

                $this->email->set_newline("\r\n"); //just has to be there

                $this->email->from('The Pub Crawl Team');
                $this->email->to($email);
                $this->email->subject('Reset password');
                $this->email->message('Test mail');

                    if($this->email->send())
                    {
                        $data['main_content'] = 'checkMail2_view';
                        $this->load->view('include/template_view', $data);
                    }
                    else
                    {
                        show_error($this->email->print_debugger);
                    }
        }

    }

    /**
     * Checks the database to see if the email exists
     * @param <string> $email the users email address
     * @return <boolean> whether the email exists
     */
    function emailExistsInDb($email) {
        return true;
    }
//        else
//            redirect();


    /**
     *
     */
    function activate() {

    }

    /**
     * This methode helps to verify the user that is trying to log into our web-
     * page. It controls to see if the user has a session.
     */
    function verifyLogin() {
        if ($this->input->post('email')) {
            $mail = $this->input->post('email');
            $pw = $this->input->post('passw');
            if($this->main_model->verifyUser($mail, $pw)){
                if($_SESSION['userid'] > 0) {
                    return true;
                }
                else
                    return false;
            }
            else
                return false;
        }
    }

    function searchUser(){
        if($this->input->post('search')){
            $search = $this->input->post('search');
            $data['searchdata'] = $this->main_model->searchUser($search);
            $data['main_content'] = 'searchUser_view';
            $this->load->view('/include/template1_view', $data);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */