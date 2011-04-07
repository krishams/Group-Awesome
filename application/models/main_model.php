<?php

/**
 * Description of main_model
 *
 * @author Kristian
 */
class main_model extends CI_Model {

    function main_model() {
        parent::__construct();
    }

    /**
     * This methode saves the userdate. It creates a array which contains all the
     * informations that we need about the user, it gets the information directly
     * from the view that are displayed for the user. Lastly it inserts the data
     * into our tabel called users.
     * @return the id of the newly created user
     */
    function saveUserdata() {
    	$passwHash = hash('sha512', $this->input->post('passw'), FALSE);
        $new_user_data = array(
            'email' => $this->input->post('email'),
            'pass' => $passwHash,
            'f_name' => $this->input->post('firstname'),
            'l_name' => $this->input->post('lastname'),
            'is_admin' => '0',
            'active' => '0'
        );
        $this->db->insert('users', $new_user_data);
        return $this->db->insert_id();
    }

    /**
     *
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

    /**
     * This function is to validate if an email is already used by another user.
     * It gets the email from the view, and selects all emails in the database.
     * Then it checks to see if the email is the same as anyone of those in the
     * database. It returns a true or false boolean depending on the outcome.
     * @return boolean
     */
    function emailValidation(){
        $validemail = $this->input->post('email');
        $validate = false;
        $this->db->select('email');
        $Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                if ($row['email'] == $validemail) {
                    $this->session->set_flashdata('error', 'This email is already in use.');
                    $validate = true;
                    return $validate;
                }
            }
        }
        return $validate;
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
        $this->db->select('id, email, active');
        $this->db->where('email', $email);
        $this->db->where('pass', $passwHash);
        $this->db->limit(1);
        $Q = $this->db->get('users');
        if($Q->num_rows() > 0){
            $row = $Q->row_array();
            if ($row['active'] != 1) {
               $this->session->set_flashdata('errorVerify', 'Sorry, your account has not been activated yet! Please click the link you were sent by email.');
               return false;
            }
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['email'];
            return true;
        }
        else{
           $this->session->set_flashdata('errorVerify', 'Sorry, your email or password is incorrect! Please try again.');
           return false;
        }
    }

    /**
     * This methode is ment to control the hole database and return an array of
     * data, with the a persons name, if it contains the search criteria.
     * @param <type> $searh
     */
    function searchUser($searh){
        $data = array();
        $this->db->select('f_name', 'l_name');
        $Q = $this->db->get('users');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                if($row['f_name'].contains($searh)||$row['l_name'].contains($searh)){
                    $data[] = $row;
                }
            }
        }
    }
}
?>
