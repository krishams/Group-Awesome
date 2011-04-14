<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Kristian
 */
class user_model extends CI_Model {

    function user_model() {
        parent::__construct();
    }

    /**
     * The function returns an array which contains all users orderby user id
     */
    function getAllUsers() {
        $data = array();
        $this->db->order_by('id');
        $Q = $this->db->get('Users');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * Delete an user, but so far only in the User table
     */
    function deleteUser($id){
        $this->db->where('id', $id);
        $Q = $this->db->delete('users');
        if($Q)
            return true;
        else
            return false;
    }

    /**
     * The function gets the users role
     * @param <type> $id
     * @return <type>
     */
    function getUserRole($id) {
        $this->db->select('role_id');
        $this->db->where('id', $id);
        $Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
            $row = $Q->row_array();
            return $row['role_id'];
        } else {
            return false;
        }
    }

      /**
     * This function is for getting a specific users path to his profile image from db
     */
        function getProfilePic($id) {
    	$data = array();
    	$this->db->where('user_id', $id);
    	$Q = $this->db->get('profile_pics');
    	if($Q->num_rows()>0){
    		foreach($Q->result_array() as $row){

                    $data = $row;
            }
    	}
    	return $data;
    }
}

?>
