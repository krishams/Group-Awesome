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
    function emailValidation() {
        $validemail = $this->input->post('email');
        $validate = true;
        $this->db->select('email');
        $Q = $this->db->get('users');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                if ($row == $validemail) {
                    $validate = false;
                    return $validate;
                };
            };
        };
        $validate =true;
        return $validate;
    }
}
?>
