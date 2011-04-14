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
     * This methode saves the userdate. It creates a array which contains all the
     * informations that we need about the user, it gets the information directly
     * from the view that are displayed for the user. Lastly it inserts the data
     * into our table called users.
     * @return the id of the newly created user
     */
    function saveUserdata($user_data) {
    	if(isset($user_data['userid'])){
    	
    	error_log("isset");
    	$this->db->where('id', $user_data['userid']);
    	unset($user_data['userid']);
        $this->db->update('users', $user_data);
        error_log("query Userdata" . $this->db->last_query());
        
        return TRUE;
    	
    	
    	}else if (empty($user_data['userid'])){
    	
    	$this->db->insert('users', $user_data);
        return $this->db->insert_id();
        }
    }
    /*This function tjecks if the password matches the password in DB
    */
    
    function tjeckPass($userid,$pass) {
    	$this->db->select('id');
    	$this->db->where('id', $userid);
    	$this->db->where('pass', $pass);
    	$this->db->limit(1);
    	$Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
        	error_log("if");
            foreach ($Q->result_array() as $row) {
       			return $row['id'];
                
            }
        }
        return false;

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
}

?>
