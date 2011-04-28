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
    	error_log("ajaxsus");
    	$bars = $this->bar_model->getFavoriteBars($_SESSION['userid']);
    		echo "<ul>";
			foreach ($bars as $bar) {
				echo "<li>" . $bar['name'] . "</li>";
			}
			echo "</ul>";
		
    }
    
    function saveFavoritBars() {
    	error_log("save ajax");
    	$bar['user_id'] = $_SESSION['userid'];
    	$bar['bar_id'] = $this->uri->segment(3);
    	//error_log("userid: " . $bar['user_id'] . " barid: " . $bar['bar_id']);
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