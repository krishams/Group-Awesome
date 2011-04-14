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
        $this->logged_in->status();
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
        $id = $_SESSION['userid'];
        $data['permissions'] = $this->getPermissions();
        $data['admin'] = $this->getAdminPriv($id);
        $data['users'] = $this->user_model->getAllUsers();
        $data['main_content'] = 'admin/adminViewUsers_view';
        $this->load->view('include/admintemplate_view', $data);
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

    function editUser($data){

    }
}