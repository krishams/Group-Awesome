<?php

class admin_model extends CI_Model {

    function admin_model() {
        parent::__construct();
    }

    /**
     * The function controlls to see if the user has admin privileges
     * @param <type> $id
     * @return <type>
     */
    function verifyAdmin($id) {
        $role = $this->user_model->getUserRole($id);
        return $this->role_model->isAdmin($role);
    }
    
}
?>