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

    /**
     * This function will create the relation between 2 users
     * Is called from User controller, function createRelation
     */
    function approve_friend($user_data) {
        $this->db->insert('relations', $user_data);
    }

    function remove_friend($id1, $id2) {

    }

    /**
     *
     * @param <type> $id
     * @param boolean $getProfileData to also get the first name, last name and profile pic path
     * @return <type>
     */
    function get_friends($id, $getProfileData = false) {
        if ($getProfileData) {
            $sql = "SELECT id, l_name, f_name, profile_pics.path FROM `users`, profile_pics WHERE
                    users.id = profile_pics.user_id AND users.id in (SELECT id1 FROM `relations` WHERE id2 = $id)
                    UNION
                    SELECT id, l_name, f_name, profile_pics.path FROM `users`, profile_pics WHERE
                    users.id = profile_pics.user_id AND users.id in (SELECT id2 FROM `relations` WHERE id1 = $id)";

        }
        else {
            $sql = "(SELECT id1 as id FROM `relations` WHERE id2 = $id)
                    UNION
                    (SELECT id2 FROM `relations` WHERE id1 = $id)";
        }

        $Q = $this->db->query($sql);

        $data = array();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                if ($getProfileData) {
                    $data[] = $row;
                }
                else {
                    $data[] = $row['id'];
                }
            }
        }
        error_log(print_r($data, true));
        return $data;

    }

    function get_friend_requests($id) {

    }

}
?>
