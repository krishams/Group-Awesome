<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        
    }

    /**
     * loads the registration view page
     */
    function getRegistration() {
        $data['main_content'] = 'registration_view';
        $this->load->view('/include/template_view', $data);
    }

    /**
     *
     * Used when the user clicks on the link, "Forgot your password"
     * User types in his/her email address
     * You put a random key and temporary password in the user table
     * You send an email with a link to activate the password you set. The link has the random key
     * User clicks on link. The link should match the random string
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

        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('passw', 'Password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('confirmPassw', 'Confirm Password', 'trim|required|matches[passw]');

        if ($this->form_validation->run() == FALSE) {
            $this->getRegistration();
        } else if ($this->main_model->getUserforEmail($this->input->post('email'))) {
            redirect('login/getRegistration');
            //print error message
        } else {
        	$passwHash = hash('sha512', $this->input->post('passw'), FALSE);
        	$user_data = array(
                    'email' => $this->input->post('email'),
                    'pass' => $passwHash,
                    'f_name' => $this->input->post('firstname'),
                    'l_name' => $this->input->post('lastname'),
                    'active' => '0'
        	);
            if ($id = $this->user_model->saveUserdata($user_data)) {
                $data['main_content'] = 'checkMail_view';
                $this->load->view('include/template_view', $data);
                $this->load->helper('emailService');

                $linkString = $this->main_model->createLink($id, 1);

                $email = $this->input->post('email');
                send_validation_email($email, $linkString);
            } else {
                $this->load->view('registration_view');
            }
        }
    }

    /**
     * User clicks on link, "Forgot your password"
     * User receives an email with a link
     * user presses the link a gets to a reset password page
     */
    function submitRequestPassword() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
        
            $this->load->view('requestPass_view');
        } else if ($id = $this->main_model->getUserforEmail($this->input->post('email'))) {

            //validation has passed, so send email
            $email = $this->input->post('email');
            $linkString = $this->main_model->createLink($id, 2);

            $this->load->helper('emailService');
            $success = send_password_request_email($email, $linkString);

            if ($success) {
                $data['main_content'] = 'checkMail2_view';
                $this->load->view('include/template_view', $data);
            } else {
                show_error($this->email->print_debugger);
            }
        } else {
                    redirect('login/getRequestPassword');
            //print error message
        }
    }
}
?>
