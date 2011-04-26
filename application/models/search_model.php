<?php

class Search_model extends CI_Model {
    function Search_model()
    {
        parent::__construct();
    }

    /**
     * This function gets some random users from the db everytime a user clicks 'find buddies'
     */
    function getRandomUsers()
    {
        $query = $this->db->where('user_id >= (SELECT FLOOR(MAX(user_id) * RAND()) FROM profile_pics )')->order_by('user_id')->limit(50)->get('profile_pics');

            if ($query->num_rows() > 0)
            {

                foreach ($query->result_array() as $row){

                        $data[] = $row;
                 }
            }

    return $data;
  }






}

?>
