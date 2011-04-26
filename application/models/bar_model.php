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

    function getFavoriteBars() {
        $this->db->select('bar_id')->from('bars')->where('id', $id)->limit(10, 20);

/* NEED VIEW
 *  SELECT favorite_bars.user_id, favorite_bars.bar_id, bars.name
FROM `favorite_bars`, INNER JOIN 'bars'
ON favorite_bars.bar_id = bars.id
 *
 */
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

    function saveBar() {

    }

    function saveFavoriteBar() {

    }

    function deleteBar() {

    }

    function deleteFavoriteBar() {
        
    }
}
?>