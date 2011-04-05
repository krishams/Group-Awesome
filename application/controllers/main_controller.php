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
         * loads the home page once the user is logged in
         * @param <type> $id
         */
        function getHome($id)
	{
            $data['main_content'] = 'home_view';
            $this->load->view('/include/template_view', $data);
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
         * Saves the user registration information and sends a confirmation email with a link to log on
         * @param <array> $data the user's registration information
         */
        function submitRegistration($data)
	{
            $data['main_content'] = 'checkMail_view';
            $this->load->view('/include/template_view', $data);
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
	function submitRequestPassword()
	{
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