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
            redirect($uri = 'registration_view');
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
     */
    function submitRequestPassword() {
        $email = $this->input->post('email');
        error_log($email);
        if ($this->emailExistsInDb($email)) {
            $this->email->from('donotreply@pubcrawl.com');
            $this->email->to($email);

            $this->email->subject('log-in to Pub Crawl');
            $this->email->message('Testing');

            $this->email->send();
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */