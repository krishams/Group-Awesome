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
    	
    	$bars = $this->bar_model->getFavoriteBars($_SESSION['userid']);
    		echo "<ul id='favoritebarlist'>";
			foreach ($bars as $bar) {
				echo "<li>" . "<img id='" . $bar['bar_id'] . "'src='" . base_url() . "assets/img/cross_icon.png" . "' width='10' height='10' alt='some_text'/>" . $bar['name'] . "</li>";
			}
			echo "</ul>";
			echo "<script>removefavorite()</script>";
		
    }
    
    function saveFavoritBars() {
    	
    	$bar['user_id'] = $_SESSION['userid'];
    	$bar['bar_id'] = urldecode($this->uri->segment(3));
    	
    	$this->bar_model->saveFavoriteBar($bar);
    }
    
    function saveBar() {
    	$bar['name'] = urldecode($this->uri->segment(3));
    	$this->bar_model->saveBar($bar);
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
    
    function removeFavoritBar() {
    	
    	$bar['bar_id'] = $this->uri->segment(3);
    	$bar['user_id'] = $_SESSION['userid'];
    	$this->bar_model->removeFavoritBar($bar);
    }
}
?>