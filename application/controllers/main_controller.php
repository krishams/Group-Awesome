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
     */
    function getHome() {//$id)
        if ($this->verifyLogin()) {
            $data['main_content'] = 'home_view';
            $this->load->view('/include/template1_view', $data);
        } else {
            redirect();
        }
    }

    /**
     * This function will open the home_view, if the user is already logged in
     */
    function goHome() {
        $data['main_content'] = 'home_view';
        $this->load->view('/include/template1_view', $data);
    }

    /**
     * loads the registration view page
     */
    function getRegistration() {
        $data['main_content'] = 'registration_view';
        $this->load->view('/include/template_view', $data);
    }

    /**
     * loads the page to request a password
     */
    function getRequestPassword() {
        $data['main_content'] = 'requestPass_view';
        $this->load->view('/include/template_view', $data);
    }

    /**
     * Saves the user registration information and sends a confirmation email with a link to log on.
     * First we load the helper form_validation, which makes it possible to set rules for our form.
     * In the rules we 3 parameters, 1: the fieldname, 2: errormessage and 3: the validation rule.
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
        $this->form_validation->set_rules('passw', 'Password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('confirmPassw', 'Confirm Password', 'trim|required|matches[passw]');

        if ($this->form_validation->run() == FALSE) {
            $this->getRegistration();
        } else if ($this->main_model->emailValidation()) {
            redirect('main_controller/getRegistration');
            //print error message
        } else {
            if ($id = $this->main_model->saveUserdata()) {
                $data['main_content'] = 'checkMail_view';
                $this->load->view('include/template_view', $data);

                $linkString = $this->main_model->createLink($id, 1);

                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'awesome.pubcrawl2011@gmail.com',
                    'smtp_pass' => 'group.awesome'
                );

                $email = $this->input->post('email');
                $this->load->library('email', $config);

                $this->email->set_newline("\r\n"); //just has to be there

                $this->email->from('The Pub Crawl Team');
                $this->email->to($email);
                $this->email->subject('Activate account');
                $this->email->message("Click the following link to activate your account:\n\n" .
                        base_url() . "index.php/main_controller/activate/" . $linkString);
                $this->email->send();
            } else {
                $this->load->view('registration_view');
            }
        }
    }

    /**
     * 
     * Used when the user clicks on the link, "Forgot your password"
     * User types in his/her email address
     * You put a random key and temporary password in the user table
     * You send an email with a link to activate the password you set. The link has the random key
     * User clicks on link. The link should match the random string
     */
    function submitRequestPassword() {
        //make random key as a temp password in usertabel:
        //2. call to model to generate a random string
        //send email with an activation link and a temp password - ½done
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'awesome.pubcrawl2011@gmail.com',
            'smtp_pass' => 'group.awesome'
        );

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('requestPass_view');
        } else if ($id = $this->main_model->emailValidation()) {
            //validation has passed, so send email
            $linkString = $this->main_model->createLink($id, 2);

            $email = $this->input->post('email');
            $this->load->library('email', $config);

            $this->email->set_newline("\r\n"); //just has to be there

            $this->email->from('The Pub Crawl Team');
            $this->email->to($email);
            $this->email->subject('Reset password');
            $this->email->message("Click the following link to reset your password:\n\n" .
                    base_url() . "index.php/main_controller/activate/" . $linkString);

            if ($this->email->send()) {
                $data['main_content'] = 'checkMail2_view';
                $this->load->view('include/template_view', $data);
            } else {
                show_error($this->email->print_debugger);
            }
        } else {
                    redirect('main_controller/getRequestPassword');
            //print error message
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
     * This method will get a string with a search criteria and forward it to
     * a method in the main_model, then it will load a new page where the search
     * results will be displayed
     */
    function searchUser() {
        if ($this->input->get('search')) {
            $search = $this->uri->segment(3);
            $data['searchdata'] = $this->main_model->searchUser($search);
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
     * This function is needed when the user wants to log out of the webpage
     */
    function logOut() {
        session_destroy();
        redirect('');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */