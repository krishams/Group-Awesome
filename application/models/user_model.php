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

}

?>
