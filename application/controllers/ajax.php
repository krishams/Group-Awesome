<?php

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

    function showUsersForBar($bar_id) {
        $user_to_exclude = $_SESSION['userid'];
        $data = $this->bar_model->getUsersForBar($bar_id, $user_to_exclude);
        echo '<ul>';
        foreach ($data as $row) {
            echo '<li>' . anchor('user/showProfile/'.$row['id'],$row['f_name'] ." ". $row['l_name']) . '</li>';
        }
        echo '</ul>';
    }

    function showUsersByName($searchString) {
        $data = $this->main_model->searchUser($searchString);
        echo '<ul>';
        foreach ($data as $row) {
            echo '<li>' . anchor('user/showProfile/'.$row['id'],$row['f_name'] ." ". $row['l_name']) . '</li>';
        }
        echo '</ul>';
    }
}
?>