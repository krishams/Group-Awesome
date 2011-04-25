<?php

/**
 * Description of main_model
 *
 */
class main_model extends CI_Model {

    function main_model() {
        parent::__construct();
    }


    /**
     * Creates a link that can be emailed and saves to the database
     * @param int $type 0 for activate link
     *                  1 for reset link
     * @return string   the link we created
     */
    function createLink($userid, $type) {
    	$this->load->helper('string');
        $link_string = random_string('alnum', 32);

        $new_link_data = array(
            'user_id' => $userid,
            'type' => $type,
            'link_string' => $link_string
        );
        $this->db->insert('email_links', $new_link_data);
        return $link_string;
    }

    /**
     * Get the user_id and type for a link string received from an email link. The type
     * is 1 for activate and 2 for reset password
     * @param <string> $linkString
     * @return <type> an array with the user_id and type
     */
    function getUserForLink($linkString){
        $this->db->select('user_id, type');
        $this->db->where('link_string', $linkString);
        $Q = $this->db->get('email_links');
        if($Q->num_rows() > 0){
            $row = $Q->row_array();
            $data = array($row['user_id'], $row['type']);
            return $data;
        }
        return false;
    }

    function activateUser($id){
        $data = array('active' => 1);
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        //now delete the user from the email_links table
        $this->db->where('user_id', $id);
        $this->db->delete('email_links');
    }

    function resetPassword($data){
        list($id, $pw) = $data;
    	$passwHash = hash('sha512', $pw, FALSE);

        $data = array('pass' => $passwHash);
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        //now delete the user from the email_links table
        $this->db->where('user_id', $id);
        $this->db->delete('email_links');
    }

    /**
     * This function is to validate if an email is already used by another user.
     * It gets the email from the view, and selects all emails in the database.
     * Then it checks to see if the email is the same as anyone of those in the
     * database. It returns a true or false boolean depending on the outcome.
     * @return the id of the user with that email or false if none exist
     */
    function getUserforEmail($email){
    	
    	//$this->db->select('id, email');
    	//$this->db->where('email', $email);
       	$Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
        	error_log("if");
            foreach ($Q->result_array() as $row) {
                if($email == $row['email']){
                    //$this->session->set_flashdata('error', 'This email is already in use.');
                    error_log("row" . $row['id']);
                    
                    return $row['id'];
                }
            }
        }
        return false;
    }
    
    /**
     * This methode selects an user by finding him with the help of his email and
     * password. It then sets some settings in the session data, so the user
     * can be identifyed.
     * If the login informations are incorrect it returns an error message.
     * @param <type> $user
     * @param <type> $pw
     */
    function verifyUser($email, $pw){
    	$passwHash = hash('sha512', $pw, FALSE);
    	error_log("verify" . $passwHash);
        $this->db->select('id, email, active');
        $this->db->where('email', $email);
        $this->db->where('pass', $passwHash);
        $this->db->limit(1);
        $Q = $this->db->get('users');
        error_log($Q->num_rows . ", pw: " . $pw . " pwhash: " . $passwHash . " email: " .$email);
        if($Q->num_rows() > 0){
            $row = $Q->row_array();
            error_log("array verify" . print_r($row,true));
            if($row['active'] != 1){
                $this->session->set_flashdata('errorVerify', 'You need to activate your account');
                return null;
            }
            return $row;
        }
        else{
           $this->session->set_flashdata('errorVerify', 'Sorry, your email or password is incorrect! Please try again.');
           return null;
        }
    }

    /**
     * This methode is ment to control the hole database and return an array of
     * data, with the a persons name, if it contains the search criteria.
     * @param <type> $search
     */
    function searchUser($search){
        $data = array();
        $this->db->like('f_name', $search);
        $this->db->or_like('l_name', $search);
        $Q = $this->db->get('users');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                    $data[] = $row;
            }
        }
        return $data;
    }
}
?>
