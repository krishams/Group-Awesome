<?php

class Upload_model extends CI_Model {
    
    function User_model() {
        parent::__construct();
    }

    /**
     * This function is used for saving an path and filename with userid
     * for the specific user, when he uploads an image
     */
    function saveProfilePic($data)
    {
        //check first if the user has an image in table profile_pics
        $Q = mysql_query("SELECT user_id FROM profile_pics WHERE user_id =" . $data['user_id']);
        
        if(mysql_num_rows($Q) > 0) //image exist
        {
                $this->db->where('user_id', $data['user_id']);
                $this->db->update('profile_pics', $data);
        }
        else //insert new profile image path and name to db
        {
              $this->db->insert('profile_pics', $data);
        }
    }

  
     /**
     * This function is for getting a specific users path to his profile image from db
     */
        function getProfilePic($id) {
    	$data = array();
    	$this->db->where('user_id', $id);
    	$Q = $this->db->get('profile_pics');
    	if($Q->num_rows()>0){
    		foreach($Q->result_array() as $row){

                    $data = $row;

                    print_r($data);
            }
    	}
    	return $data;
    }

}

?>
