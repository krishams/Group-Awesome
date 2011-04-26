<?php
/* 
 * To handle data transactions with the following tables:
 * - FRIEND_REQUESTS
 * - RELATIONS
 */

/**
 * Description of friend_model
 *
 * @author oliverkinzl
 */
class friend_model extends CI_Model {

    function friend_model() {
        parent::__construct();
    }

    function request_friend($requester_id, $receiver_id) {

    }

    function approve_friend($requester_id, $receiver_id) {

    }

    function remove_friend($id1, $id2) {

    }

    function get_friends($id) {
        
    }

    function get_friend_requests($id) {

    }

}
?>
