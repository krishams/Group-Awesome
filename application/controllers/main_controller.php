<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('index_view');
	}

        function getHome($id)
	{
		$this->load->view('home_view');
	}

	function getRegistration()
	{
		$this->load->view('registration_view');
	}

        /**
         * Saves the user registration information and sends a confirmation email with a link to log on
         * @param <array> $data the user's registration information
         */
        function submitRegistration($data)
	{
		$this->load->view('checkmail_view');
	}

        function getRequestPassword()
	{
		$this->load->view('request_password_view');
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