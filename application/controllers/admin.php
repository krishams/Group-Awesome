<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Kristian
 */
class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    function login() {
        if ($this->controlIsAdmin()) {
            $data['main_content'] = 'admin/adminlogin_view';
            $this->load->view('/include/admintemplate_view', $data);
        }
        else{
            $data['main_content'] = 'admin/adminLoginError_view';
            $this->load->view('/include/template1_view', $data);
        }
    }


    function controlIsAdmin(){
        $id = $_SESSION['userid'];
        if($this->admin_model->verifyAdmin($id)){
            return true;
        }
        else
            return false;
    }

}

?>
