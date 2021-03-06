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
        if (isset($user_data['userid'])) {
            $this->db->where('id', $user_data['userid']);
            unset($user_data['userid']);
            $this->db->update('users', $user_data);

            return TRUE;
        } else if (empty($user_data['userid'])) {

            $this->db->insert('users', $user_data);
            return $this->db->insert_id();
        }
    }

    /* This function tjecks if the password matches the password in DB
     */

    function tjeckPass($userid, $pass) {
        $this->db->select('id');
        $this->db->where('id', $userid);
        $this->db->where('pass', $pass);
        $this->db->limit(1);
        $Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
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
    function deleteUser($id) {
        $this->db->where('id', $id);
        $Q = $this->db->delete('users');
        if ($Q)
            return true;
        else
            return false;
    }

    /**
     * The function gets the users role_id
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
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {

                $data = $row;
            }
        }
        return $data;
    }

    /**
     * gets the name of the user
     */
    function getUserName($id) {
        $data = array();
        $this->db->select('f_name, l_name');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $T = $this->db->get('users');
        if ($T->num_rows() > 0) {
            foreach ($T->result_array() as $row) {
                $data = $row;
            }
        }
        return $data;
    }

    /*
     * Will get the user on behaf of the id given
     */
    function getUserByid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data = $row;
            }
        }
        return $data;
    }

}

?>
