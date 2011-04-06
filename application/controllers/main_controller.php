<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

        /**
         * loads the initial log-in screen
         */
	function index()
	{
            $data['main_content'] = 'index_view';
            $this->load->view('/include/template_view', $data);
	}

        /**
         *
         * @param <type> $id
         */
        function getHome()//$id)
	{
            $data['main_content'] = 'home_view';
            $this->load->view('/include/template_view', $data);
	}

	function getRegistration()
	{
            $data['main_content'] = 'registration_view';
            $this->load->view('/include/template_view', $data);
	}

        /**
         * Saves the user registration information and sends a confirmation email with a link to log on
         * @param <array> $data the user's registration information
         */
        function submitRegistration()
	{
            //check if the captha is correct
            //control that all fields have data in them, if not display which is missing
            //check if email already exist, if not then display

            $this->load->library('form_validation');
            //field name, error message, validation rules
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('passw', 'Password', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('confirmPassw', 'Confirm Password', 'trim|required|matches[passw]');

            if($this->form_validation->run() == FALSE)
            {
               $this->getRegistration();
            }
            else if($this->main_model->emailValidation())
            {
                
            }
            else
            {
                if($this->main_model->saveUserdata())
                {
                    $data['main_content'] = 'checkMail_view';
                    $this->load->view('include/template', $data);
                }
                else
                {
                    $this->load->view('registration_view');
                }
            
            }
        }

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
	function submitRequestPassword($email)
	{
	}

        /**
         * Checks the database to see if the email exists
         * @param <string> $email the users email address
         * @return <boolean> whether the email exists
         */
        function emailExistsInDb($email)
        {
            return true;
        }

        /**
         * 
         */
        function activate() {

        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */