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
class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
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
    
    */
    
    function editProfile() {

        $userid = 0;

        if ($this->uri->segment(3)) {
            $userid = $this->uri->segment(3);
        }
        $data['profile'] = $this->main_model->getUserById($userid);

        $data['main_content'] = 'profile_view';
        $this->load->view('/include/template1_view', $data);
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
}
?>
