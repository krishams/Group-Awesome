<?php
ob_start(); // output buffer start - has to be there else we get a php warning

class Search extends CI_Controller {

  function __construct() {
        parent::__construct();
        session_start();
    }

    /*
     * This function loads the findbuddies view
     */
    function findBuddies()
    {

        $is_logged_in = $this->logged_in->status();

        $data['random'] = $this->search_model->getRandomUsers();
        
        $data['main_content'] = 'findBuddies_view';
		
	if($is_logged_in == "1"){$data['is_logged_in'] = "logged_in";}else{$data['is_logged_in'] = "not_logged_in";}

        $this->load->view('/include/template1_view', $data);

        
          
    }
    
}

?>

