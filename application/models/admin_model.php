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
        $this->db->select('is_admin');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
            $row = $Q->row_array();
            return $row['is_admin'];
        } else {
            return false;
        }
    }
    
}
?>