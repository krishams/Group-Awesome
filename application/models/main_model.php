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
     */
    function saveUserdata() {
        $new_user_data = array(
            'email' => $this->input->post('email'),
            'pass' => $this->input->post('passw'),
            'f_name' => $this->input->post('firstname'),
            'l_name' => $this->input->post('lastname'),
            'is_admin' => '0'
        );
        $this->db->insert('users', $new_user_data);
        return true;
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
     * can be identifyed
     * @param <type> $user
     * @param <type> $pw
     */
    function verifyUser($email, $pw){
        $this->db->select('id, email');
        $this->db->where('email', $email);
        $this->db->where('pass', $pw);
        $this->db->limit(1);
        $Q = $this->db->get('users');
        if($Q->num_rows() > 0){
            $row = $Q->row_array();
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['email'];
            return true;
        }
        else{
           $this->session->set_flashdata('error', 'Sorry, your email or password is incorrect!');
           return false;
        }
    }
}
?>
