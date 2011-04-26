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

    function getUsersForBar(){
        $this->db->select('*')->from('bars')->where('id', $id)->limit(10, 20);

        $query = $this->db->get();

        $data = array();
        $this->db->order_by('name');
        $Q = $this->db->get('Users');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
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