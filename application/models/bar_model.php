<?php
/**
 *
 * To handle data transactions with the following tables:
 * - BARS
 * - FAVORITE_BARS
 *
 */
class bar_model extends CI_Model {

    function user_model() {
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
    function getUsersForBar($bar_id, $offset = 0){
        $this->db->select('user_id')->from('favorite_bars')->where('bar_id', $bar_id)->limit(100, $offset);
        $Q = $this->db->get();

        $data = array();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['user_id'];
            }
        }
        return $data;
    }

    function createBar() {

    }

    function saveFavoriteBar($user_id, $bar_id) {

    }

    function deleteBar() {

    }

    function deleteFavoriteBar() {
        
    }
}
?>