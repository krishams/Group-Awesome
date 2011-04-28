<?php
/**
 *
 * To handle data transactions with the following tables:
 * - BARS
 * - FAVORITE_BARS
 *
 */
class bar_model extends CI_Model {

    function bar_model() {
        parent::__construct();
    }

    /**
     * Gets a list of bars in the database
     * @return Array of bars. Each array element has [id] and [name]
     */
    function getListOfBars() {
        $this->db->order_by('name');
        $Q = $this->db->get('bars');

        $data = array();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * Gets a user's favorite bars
     * @param int $id the user's id #
     * @return Array a list of the favorite bars. Each array element has [bar_id] and [name]
     */
    function getFavoriteBars($id) {
        $this->db->select('bar_id, name')->from('bar_view')->where('user_id', $id);
        $Q = $this->db->get();

        $data = array();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * Get a list of the first 100 user_ids for a specific bar. To get the next 100 and so on, use
     * the second parameter and set it in increments of 100
     * @param int $bar_id the id for the bar
     * @param int $offset OPTIONAL where to start searching. Default = 0 which searches from the start
     * @return Array all user_ids for users that have this as a favorite bar
     */
    function getUsersForBar($bar_id, $user_to_exclude = 0){
        $sql = "SELECT users.id, l_name, f_name FROM users, favorite_bars WHERE
                users.id = favorite_bars.user_id AND favorite_bars.bar_id = $bar_id";
        if ($user_to_exclude > 0) {
             $sql .= " AND users.id <> $user_to_exclude";

        }
        error_log($sql);

        $Q = $this->db->query($sql);

        $data = array();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * saves a new or existing bar
     * @param array $bar an array containing ['id'] and ['name']
     * @return int/boolean the id of the newly created bar, TRUE if an existing bar has been saved or FALSE if it can
     * not be saved
     */
    function saveBar($bar) {
        if (!isset($bar['name'])) {                 //no bar name = can't save!
            return false;
        }

        if (isset($bar['id']) && $bar['id'] > 0) {  //existing bar
            $this->db->where('id', $bar['id']);
            $this->db->update('bars', $bar);
            return true;
        } else {                                    //create new bar
            $this->db->insert('bars', $bar);
            return $this->db->insert_id();
        }
    }

    /**
     * saves a new or existing favorite bar
     * @param array $bar an array containing ['user_id'] and ['bar_id']
     * @return int/boolean the id of the newly created bar, TRUE if an existing bar has been saved or FALSE if it can
     * not be saved
     */
    function saveFavoriteBar($bar) {
        if (!isset($bar['name'])) {
            return false;
        }

        if (isset($bar['id']) && $bar['id'] > 0) { //existing bar
            $this->db->where('id', $bar['id']);
            $this->db->update('bars', $bar);
            error_log("query Userdata" . $this->db->last_query());

            return true;
        } else { //create new bar
            $this->db->insert('bars', $bar);
            return $this->db->insert_id();
        }
    }

    function deleteBar() {

    }

    function deleteFavoriteBar() {
        
    }
}
?>