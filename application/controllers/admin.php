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

    /**
     * The function is called when a user want's to go to the admin menu
     */
    function login() {
        if ($this->controlIsAdmin()) {
            $data['main_content'] = 'admin/adminhome_view';
            $this->load->view('/include/admintemplate_view', $data);
        }
        else{
            $data['main_content'] = 'admin/adminLoginError_view';
            $this->load->view('/include/template1_view', $data);
        }
    }

    /**
     * The function controls if the user is an admin or not,
     * by checking his id in the database.
     * @return <type>
     */
    function controlIsAdmin(){
        $id = $_SESSION['userid'];
        if($this->admin_model->verifyAdmin($id)){
            return true;
        }
        else
            return false;
    }

    /**
     *
     */
    function viewUsers(){
        $data['users'] = $this->user_model->getAllUsers();
        $data['main_content'] = 'admin/adminViewUsers_view';
        $this->load->view('include/admintemplate_view', $data);
    }
}
?>