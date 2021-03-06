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
        	$is_logged_in = $this->logged_in->status();
        	if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}
            $data['main_content'] = 'admin/adminhome_view';
            $this->load->view('/include/admintemplate_view', $data);
        }
        else{
        	$is_logged_in = $this->logged_in->status();
        	if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}
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
        $role = $this->user_model->getUserRole($id);
        if($this->role_model->isAdmin($role)){
            $_SESSION['role_id'] = $this->user_model->getUserRole($id);
            return true;
        }
        else
            return false;
    }

    /**
     * This functions displays all users for the admin in a table
     */
    function viewUsers(){
    	$is_logged_in = $this->logged_in->status();
        if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}
        $id = $_SESSION['userid'];
        $data['permissions'] = $this->getPermissions();
        $data['admin'] = $this->getAdminPriv($id);
        $data['users'] = $this->user_model->getAllUsers();
        $data['activeOptions'] = array('0' => 'False', '1' => 'True');
        $data['main_content'] = 'admin/adminViewUsers_view';
        $this->load->view('include/admintemplate_view', $data);
    }

    /**
     * 
     */
    function controlInput(){
        switch($_POST['option']){
            case 'Delete':
                $this->deleteUser();
                break;
            case 'Edit':
                $this->editUser();
                break;
            case 'Change password':
                $this->login->submitRequestPassword();
                break;
        }
    }

    /**
     * returns a data set with all the roles id and name from the roles tabel in the db
     */
    function getPermissions(){
        $data = $this->role_model->getAllRoles();
        return $data;
    }

    /**
     * The function will return an $data set with a specific roles priviliges,
     * basically it returns everything from the roles tabel in the db, with a specifik id.
     */
    function getAdminPriv($id){
        $role = $this->user_model->getUserRole($id);
        $data = $this->role_model->getAdminPrivs($role);
        return $data;
    }

    /**
     * A function that deletes the user
     */
    function deleteUser(){
        $id = $this->input->post('id');
        $Q = $this->user_model->deleteUser($id);
        if($Q){
           $this->viewUsers();
        }
    }

    /**
     * This function will get information from the editUser_view,
     * and edit the user in the db
     */
    function editUser(){
        $id = $this->input->post('id');
        $f_name = $this->input->post('firstname'.$id);
        $l_name = $this->input->post('lastname'.$id);
        $email = $this->input->post('email'.$id);
        $role_id = $this->input->post('roleid'.$id);
        $is_active = $this->input->post('isactive'.$id);
        $user_data = array(
            'userid' => $id,
            'email' => $email,
            'role_id' => $role_id,
            'f_name' => $f_name,
            'l_name' => $l_name,
            'active' => true //this is not correct!!!!! This needs to be $is_active, but that is not coming from the checkbox
        );
        $this->user_model->saveUserdata($user_data);
        $this->viewUsers();
    }
}