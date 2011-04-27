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
    	error_log("ajaxs");
    	//$data['bars'] = $this->bar_model->getFavoriteBars();
    	$this->load->view('/ajax/favoritbars_view');
    }
    
    function saveFavoritBars($bar) {
    	$this->bar_model->saveFavoriteBar($bar);
    }
}
    
?>