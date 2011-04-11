<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Kristian
 */
class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }
}
?>
