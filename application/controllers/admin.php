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
        if (controlIsAdmin) {
            $data['main_content'] = 'admin/adminlogin_view';
            $this->load->view('/include/admintemplate_view', $data);
        }
    }


    function controlIsAdmin(){
        if($this->admin_model->controlAdmin){
        return true;
        }
        else
        return false;
    }

}

?>
