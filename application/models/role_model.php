<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of role_model
 *
 * @author Kristian
 */
class role_model extends CI_Model {

    function role_model() {
        parent::__construct();
    }

    /**
     * Get all the roles in the database from the roles table
     */
    function getAllRoles(){
        $data = array();
        $this->db->order_by('role_id');
        $Q = $this->db->get('roles');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
?>
