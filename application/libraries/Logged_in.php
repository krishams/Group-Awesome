<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logged_in{

	function status(){
		if(isset($_SESSION['userid'])){
			//error_log("true");
			return true;
		}else{
			//error_log("false");
			redirect(base_url());
		}
	}
}

?>
