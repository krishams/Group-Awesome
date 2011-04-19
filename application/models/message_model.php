<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Kristian
 */
class message_model extends CI_Model {

    function message_model() {
        parent::__construct();
    }

    /**
     * inserts a message into the message tabel in the db
     */
    function insertMessage($data){
        $this->db->insert('messages', $data);
    }

    /**
     * Gets all messages for a singel user
     */
    function getMessages($id){
        $data = array();
        $this->db->order_by('msg_date');
        $this->db->where('user_id', $id);
        $Q = $this->db->get('messages');
        if($Q->num_rows() > 0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
                return $data;
            }
        }
        else
            return false;
    }
}
?>
