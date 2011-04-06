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
class User_controller extends CI_Controller {


        /**
         * Saves the user registration information and sends a confirmation email with a link to log on
         * @param <array> $data the user's registration information
         */
        function submitRegistration($data)
	{
            $data['main_content'] = 'checkMail_view';
            $this->load->view('/include/template_view', $data);
	}

}

?>

