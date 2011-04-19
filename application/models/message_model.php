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
}
?>
