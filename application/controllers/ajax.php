<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax_controller
 *
 * @author Kristian
 */
class Ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }
    
    function loadFavoritBars() {
    	error_log("ajaxsus");
    	$data['bars'] = $this->bar_model->getFavoriteBars($_SESSION['userid']);
    	$this->load->view('/ajax/favoritbars_view', $data);
    }
    
    function saveFavoritBars() {
    	error_log("save ajax");
    	error_log($_GET['name']);
    	$this->bar_model->saveFavoriteBar($bar);
    }
}
    
?>