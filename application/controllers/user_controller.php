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
class User_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
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
        $this->load->view('include/template1_view', $data);
    }
    
     function editProfile() {

        $userid = 0;

        if ($this->uri->segment(3)) {
            $userid = $this->uri->segment(3);
        }
        $data['profile'] = $this->main_model->getUserById($userid);

        $data['main_content'] = 'editProfile_view';
        $this->load->view('/include/template1_view', $data);
    }
}
?>
