<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logged_in{
	function status(){
		if(isset($_SESSION['userid'])){
			return true;
		}else{
			redirect(base_url() . "main/login");
		}
	}
}

?>
