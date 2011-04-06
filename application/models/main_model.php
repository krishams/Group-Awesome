<?php
/**
 * Description of main_model
 *
 * @author Kristian
 */
class main_model extends CI_Model {

    function main_model(){
        parent::__construct();
    }

    function saveUserdata() {
        $new_user_data = array(
            'email' => $this->input->post('email'),
            'pass' => $this->input->post('passw'),
            'f_name' => $this->input->post('firstname'),
            'l_name' => $this->input->post('lastname'),
            'is_admin' => '0'
        );
        $this->db->insert('users', $new_user_data);
    }

}
?>
