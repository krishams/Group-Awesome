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
//        $Q = $this->db->select('user_id');
//             $this->db->from('profile_pics');
//             $this->db->where('user_id', $data['user_id']);

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
//    function getProfilePic($id)
//    {
//       $this->db->select('path');
//       $this->db->where('user_id', $user_id);
//       $Q = $this->db->get('profile_pics');
//
//       if ($Q->num_rows() > 0) {
//            $row = $Q->row_array();
//            return $row['path'];
//        } else {
//            return false;
//            //and display default profilepic
//        }
//    }

        function getProfilePic($id) {
    	$data = array();
            error_log($id);
    	$this->db->where('user_id', $id);
    	$Q = $this->db->get('profile_pics');
    	if($Q->num_rows()>0){
                error_log('Dette er inde  i if lokken');
    		foreach($Q->result_array() as $row){
                    error_log('der er data');
                    $data = $row;
            }
    	}
    	return $data;
        print_r($data);
    }

}

?>
